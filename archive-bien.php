<?php get_header(); ?>
	<h1>Voir tout nos biens </h1>
<?php if ( have_posts() ): ?>
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
<?php get_footer(); ?><?php
