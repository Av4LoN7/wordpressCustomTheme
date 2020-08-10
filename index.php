<?php get_header(); ?>
<?php if ( have_posts() ): ?>
    <div class="row">
		<?php while ( have_posts() ): the_post() ?>
            <div class="col-sm-4">
                <div class="card">
                <?php the_post_thumbnail( 'custom-card-header', [
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
    </div>
<?php else: ?>
    <h1>Pas d'articles</h1>
<?php endif; ?>
<?php avalontheme_pagination_post(); ?>
<?php get_footer(); ?>
