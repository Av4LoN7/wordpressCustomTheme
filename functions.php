<?php

function avalontheme_support() {
	add_theme_support("title-tag");
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

add_action('after_setup_theme', 'avalontheme_support');
add_action('wp_enqueue_scripts', 'avalontheme_register_assets');
