<?php get_header(); ?>
<?php if ( have_posts() ): while ( have_posts() ): the_post() ?>
	<?php if ( get_post_meta( $post->ID, Sponso::META_KEY, true ) === '1' ): ?>
        <div class="alert alert-info">
            Cet article est sponsorisé
        </div>
	<?php endif; ?>
    <p>
        <img src="<?php the_post_thumbnail_url(); ?>" alt="" style="width: 100%; height: auto; margin-top: 2px">
    </p>
    <h1><?php the_title(); ?></h1>
    <p><?php the_content(); ?> </p>
<?php endwhile; ?>
<?php endif; ?>
<div class="row">
	<?php
	// display related articles with the same taxonomy/terms using wp_query object
	// used array_map callback to extract the term_id needed from the wp_term object
	$sportsID = array_map( function ( $callback ) {
		return $callback->term_id;
	}, get_the_terms( get_post(), 'sport' ) );
	$query    = new WP_Query( [
		'post_type'     => 'post',
		'post__not_in'  => [ get_the_ID() ], // exclude the initial post from result
		'post_per_page' => 3, // pagination
		'orderby'       => 'rand', // display random articles each time
		'tax_query'     => [
			[
				'taxonomy' => 'sport',
				'terms'    => $sportsID
			]
		]
	] );
	?>
	<?php while ( $query->have_posts() ): $query->the_post() ?>
        <div class="col-sm-4">
			<?php get_template_part( 'parts/card' ); ?>
        </div>
	<?php endwhile;
	wp_reset_postdata(); ?>
</div>
<?php get_footer(); ?>
