<?php get_header(); ?>
<h1>Resultat de recherche pour : "<?= esc_html(get_search_query()); ?>" </h1>
<form>
	<div class="form-row align-items-center">
		<div class="col-auto">
			<label class="sr-only" for="inlineFormInput">Name</label>
			<input type="search" name="s" class="form-control mb-2" id="inlineFormInput" placeholder="...">
		</div>
		<div class="col-auto">
			<div class="form-check mb-2">
				<input class="form-check-input" type="checkbox" id="autoSizingCheck" name="sponso" value="1" <?php checked('1', get_query_var('sponso')) ?>>
				<label class="form-check-label" for="autoSizingCheck">
					Article sponsorisé ?
				</label>
			</div>
		</div>
		<div class="col-auto">
			<button type="submit" class="btn btn-primary mb-2">Rechercher</button>
		</div>
	</div>
</form>
<?php if ( have_posts() ): ?>
	<div class="row">
		<?php while ( have_posts() ): the_post() ?>
			<div class="col-sm-4">
				<?php get_template_part( 'parts/card' ); ?>
			</div>
		<?php endwhile; ?>
	</div>
<?php else: ?>
	<h1>Pas d'articles trouvé</h1>
<?php endif; ?>
<?php avalontheme_pagination_post(); ?>
<?php get_footer(); ?>
