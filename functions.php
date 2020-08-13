<?php

function avalontheme_support() {
	add_theme_support( "title-tag" );
	add_theme_support( 'post-thumbnails' );
	register_nav_menus(
		[
			'header' => 'Haut de page',
			'footer' => 'Pied de page'
		] );
	add_image_size( 'custom-card-header', 350, 215, true );
}

function avalontheme_register_assets() {
	wp_register_style( "bootstrap", "https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" );
	wp_register_script( "bootstrapjs", "https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js", [
		"popper",
		"jquery"
	], false, true );
	wp_register_script( "popper", "https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js", [], false, true );
	wp_deregister_script( "jquery" );
	wp_register_script( "jquery", "https://code.jquery.com/jquery-3.5.1.slim.min.js", [], false, true );
	wp_enqueue_style( "bootstrap" );
	wp_enqueue_script( "bootstrapjs" );
}

function avalontheme_document_title_separator() {
	return '|';
}

function avalontheme_menu_class( array $classes ): array {
	$classes[] = 'nav-item';

	return $classes;
}

function avalontheme_menu_link_class( array $classes ): array {
	$classes['class'] = 'nav-link';

	return $classes;
}

function avalontheme_pagination_post(): void {
	$pages = paginate_links( [ 'type' => 'array' ] );
	if ( ! is_null( $pages ) ) {
		echo '<nav aria-label="Navigation" class="mt-4">';
		echo '<ul class="pagination">';
		foreach ( $pages as $lien ) {
			$class = "page-item";
			if ( strpos( $lien, 'current' ) ) {
				$class .= " active";
			}
			echo '<li class="' . $class . '">';
			echo str_replace( "page-numbers", "page-link", $lien );
			echo '</li>';
		}
		echo '</ul>';
		echo '</nav>';
	}
}

function avalontheme_sport_taxonomy() {
	$labels = [
		'name'          => 'Sport' ,
		'singular_name' => 'Sport' ,
		'search_items'  => 'Rechercher un sport' ,
		'all_items'     => 'Tout les sports' ,
		'edit_item'     => 'modifier le sport' ,
		'update_item'   => 'mettre à jours le sport',
		'add_new_item'  => 'Ajouter un nouveau sport',
		'new_item_name' => 'Ajouter un nouveau sport',
		'menu_name'     => 'Sports',
	];
	$args   = [
		'show_in_rest' => true,
		'hierarchical'      => true, // make it hierarchical (like categories)
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => [ 'slug' => 'sport' ],
	];
	register_taxonomy( 'sport', 'post', $args );
}

add_action( 'init', 'avalontheme_sport_taxonomy' );
add_action( 'after_setup_theme', 'avalontheme_support' );
add_action( 'wp_enqueue_scripts', 'avalontheme_register_assets' );
add_filter( 'document_title_separator', 'avalontheme_document_title_separator' );
add_filter( 'nav_menu_css_class', 'avalontheme_menu_class' );
add_filter( 'nav_menu_link_attributes', 'avalontheme_menu_link_class' );

require_once( 'metaboxes/Sponso.php' );
Sponso::register();
