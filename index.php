<?php get_header(); ?>
<?php if ( have_posts() ): ?>
    <h1><?= esc_html( get_queried_object()->name ); ?></h1>
	<?php $terms = get_terms( 'sport' );
	if ( ! empty( $terms ) ) {
		?>
        <ul class="nav nav-pills my-4">
			<?php foreach ( $terms as $sport ): ?>
                <li class="nav-item">
                    <a class="nav-link <?= is_tax( "sport", $sport ) ? "active" : " "; ?>"
                       href="<?= get_term_link( $sport ); ?>"> <?= $sport->name; ?></a>
                </li>
			<?php endforeach; ?>
        </ul>
		<?php
	}
	?>
    <div class="row">
		<?php while ( have_posts() ): the_post() ?>
            <div class="col-sm-4">
				<?php get_template_part( 'parts/card' ); ?>
            </div>
		<?php endwhile; ?>
    </div>
<?php else: ?>
    <h1>Pas d'articles</h1>
<?php endif; ?>
<?php avalontheme_pagination_post(); ?>
<?php get_footer(); ?>
