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
        <h6>Catégorie :</h6>
		<?php
		echo get_the_term_list(
			get_the_ID(),
			'sport',
			'<ul class="my-2"><li>',
			'</li><li>',
			'</li></ul>'
		);
		?>
        <h6 class="card-subtitle mb-2 text-muted">
            Author : <?php the_author(); ?>
        </h6>
        <p class="card-text">
			<?php the_excerpt(); ?>
        </p>
        <a href="<?php the_permalink(); ?>" class="card-link">Voir l'article</a>
    </div>
</div>
