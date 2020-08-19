</div>
<footer>
	<?php wp_nav_menu(
		[
			'theme_location' => 'footer',
			'container' => false,
			'menu_class' => 'navbar-nav mr-auto'
		]);
	?>
	<?php wp_footer(); ?>
    Horaires d'ouverture : <?= get_option('agence_horaire'); ?>
</footer>
</body>
</html>
