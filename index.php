<?php get_header(); ?>
<?php if ( have_posts() ): ?>
	<?php get_template_part( 'parts/taxonomy-nav' ); ?>
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
