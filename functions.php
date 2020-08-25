<?php
// unlock theme support functionality
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

function avalontheme_init() {
	$labels = [
		'name'          => 'Sport',
		'singular_name' => 'Sport',
		'search_items'  => 'Rechercher un sport',
		'all_items'     => 'Tout les sports',
		'edit_item'     => 'modifier le sport',
		'update_item'   => 'mettre à jours le sport',
		'add_new_item'  => 'Ajouter un nouveau sport',
		'new_item_name' => 'Ajouter un nouveau sport',
		'menu_name'     => 'Sports',
	];
	$args   = [
		'show_in_rest'      => true,
		'hierarchical'      => true, // make it hierarchical (like categories)
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => [ 'slug' => 'sport' ],
	];
	// add taxonomy
	register_taxonomy( 'sport', 'post', $args );

	// add custom post type
	register_post_type( 'bien', [
		'label'         => 'Bien Immobillier',
		'public'        => true,
		'show_in_rest'  => true,
		'menu_position' => 3,
		'menu_icon'     => 'dashicons-building',
		'supports'      => [ 'title', 'editor', 'thumbnail' ],
		'has_archive'   => true
	] );
}

add_action( 'init', 'avalontheme_init' );
add_action( 'after_setup_theme', 'avalontheme_support' );
add_action( 'wp_enqueue_scripts', 'avalontheme_register_assets' );
add_filter( 'document_title_separator', 'avalontheme_document_title_separator' );
add_filter( 'nav_menu_css_class', 'avalontheme_menu_class' );
add_filter( 'nav_menu_link_attributes', 'avalontheme_menu_link_class' );

require_once( 'metaboxes/Sponso.php' );
require_once( 'options/agence.php' );
Sponso::register();
AgenceMenu::register();

// modify custom post type display in admin + adding thumbnail column
add_filter( 'manage_bien_posts_columns', function ( $column ) {
	return [
		'cb'        => $column['cb'],
		'thumbnail' => 'miniature', // this
		'title'     => $column['title'],
		'date'      => $column['date']
	];
} );

// display the thumbnail inside admin bar display for the custom post type 'bien'
add_filter( 'manage_bien_posts_custom_column', function ( $columnName, $postId ) {
	if ( $columnName === 'thumbnail' ) {
		the_post_thumbnail( 'post-thumbnails', $postId );
	}
}, 10, 2 ); // 10 for priority, 2 for number of parameters needed by the method

// inject css for admin
add_action( 'admin_enqueue_scripts', function () {
	wp_enqueue_style( 'avalontheme_admin_style', get_template_directory_uri() . "/assets/admin.css" );
} );

// modify display of article in admin view + add sponsoring column
add_action( 'manage_post_posts_columns', function ( $column ) {
	$newColumn = null;
	foreach ( $column as $k => $v ) {
		if ( $k === 'tags' ) {
			$newColumn['sponsoring'] = "Sponsorisé";
		}
		$newColumn[ $k ] = $v;
	}

	return $newColumn;
} );
// display value of the meta in admin view
add_filter( 'manage_post_posts_custom_column', function ( $columnName, $postId ) {
	if ( $columnName === 'sponsoring' ) {
		echo get_post_meta( $postId, 'article_sponso', true ) === '1' ? "Oui" : "Non";
	}
}, 10, 2 ); // 10 for priority, 2 for number of parameters needed by the method

// alterate search filter with a new parameter to display sponsoring article only
// alterate wp_query object before action with pre_get_posts
function avalontheme_pre_get_post($query) {
	if(is_admin() || !is_search() || !is_main_query()) {
		return;
	}
	// sponso is a custom parameter added with query_vars filter
	if(get_query_var('sponso') === '1') {
		// extract and modify meta_query parameters
		$meta_query = $query->get('meta_query', []);
		$meta_query[] = [
			'key' => Sponso::META_KEY,
			'compare' => 'EXISTS',
		];
		$query->set('meta_query', $meta_query);
	}
}

// adding custom parameter name into query object
function avalontheme_query_vars(array $param) : array {
	$param[] = 'sponso';
	return $param;
}

add_action('pre_get_posts', 'avalontheme_pre_get_post');
add_filter('query_vars', 'avalontheme_query_vars');
