<?php get_header(); ?>
<div class="jumbotron mt-2"><h1 style="text-align: center">Homemade theme creation</h1></div>
<h1>Home</h1>
<?php if ( have_posts() ): ?>
    <div class="row">
	<?php while ( have_posts() ): the_post() ?>
        <div class="col-sm-4">
            <div class="card">
				<?php the_post_thumbnail( 'meduim', [
					'class' => 'card-img-top',
					'alt'   => '',
					'style' => 'height:auto'
				] ); ?>
                <div class="card-body">
                    <h5 class="card-title">
						<?php the_title(); ?>
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        Author : <?php the_author(); ?>
                    </h6>
                    <p class="card-text">
						<?php the_excerpt(); ?>
                    </p>
                    <a href="<?php the_permalink(); ?>" class="card-link">Voir l'article</a>
                </div>
            </div>
        </div>
	<?php endwhile; ?>
<?php else: ?>
    <h1>Pas d'articles</h1>
    </div>
<?php endif; ?>
<?php get_footer(); ?>
