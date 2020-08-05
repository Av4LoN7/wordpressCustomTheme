<?php

function avalontheme_support() {
	add_theme_support("title-tag");
	add_theme_support('post-thumbnails');
	add_theme_support('menus');
	register_nav_menus(
	[
		'header' => 'Haut de page',
		'footer' => 'Pied de page'
	]);
}

function avalontheme_register_assets() {
	wp_register_style("bootstrap", "https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css");
	wp_register_script("bootstrapjs", "https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js", ["popper", "jquery"], false, true);
	wp_register_script("popper", "https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js", [], false, true);
	wp_deregister_script("jquery");
	wp_register_script("jquery", "https://code.jquery.com/jquery-3.5.1.slim.min.js", [], false, true);
	wp_enqueue_style("bootstrap");
	wp_enqueue_script("bootstrapjs");
}

function avalontheme_document_title_separator() {
	return '|';
}

function avalontheme_menu_class(array $classes) : array {
	$classes[] = 'nav-item';
	return $classes;
}
function avalontheme_menu_link_class(array $classes) : array {
	$classes['class'] = 'nav-link';
	return $classes;
}
add_action('after_setup_theme', 'avalontheme_support');
add_action('wp_enqueue_scripts', 'avalontheme_register_assets');
add_filter('document_title_separator', 'avalontheme_document_title_separator');
add_filter('nav_menu_css_class', 'avalontheme_menu_class');
add_filter('nav_menu_link_attributes', 'avalontheme_menu_link_class');
