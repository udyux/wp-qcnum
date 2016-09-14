<?php # custom post types #

## Register custom post types
function _udyux_custom_post_types() {

  // articles
	$labelsArticle = array(
		'name' => 'Chroniques',
		'singular_name' => 'Chronique',
		'add_new' => 'Ajouter une chronique',
		'add_new_item' => 'Ajouter une chronique',
		'edit_item' => 'Modifier la chronique',
		'new_item' => 'Nouvelle chronique',
		'all_items' => 'Toutes les chroniques',
		'view_item' => 'Voir la chronique',
		'search_items' => 'Chercher une chronique',
		'not_found' =>  'Aucune chronique trouvé',
		'not_found_in_trash' => 'Rien de trouvé dans la corbeille',
		'parent_item_colon' => '',
		'menu_name' => 'Chroniques'
	);
	$argsArticle = array(
		'labels' => $labelsArticle,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => true,
		'menu_position' => 20,
		'menu_icon' => 'dashicons-media-document',
		'supports' => array('author', 'title', 'thumbnail', 'editor', 'revisions', 'trackbacks')
	);
  register_post_type('article', $argsArticle);

	// events
	$labelsEvent = array(
		'name' => 'Événements',
		'singular_name' => 'Événement',
		'add_new' => 'Ajouter un événement',
		'add_new_item' => 'Ajouter un événement',
		'edit_item' => 'Modifier l\'événement',
		'new_item' => 'Nouvel événement',
		'all_items' => 'Tous les événement',
		'view_item' => 'Voir l\'événement',
		'search_items' => 'Chercher un événement',
		'not_found' =>  'Aucun événement trouvé',
		'not_found_in_trash' => 'Rien de trouvé dans la corbeille',
		'parent_item_colon' => '',
		'menu_name' => 'Événements'
	);
	$argsEvent = array(
		'labels' => $labelsEvent,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => true,
		'menu_position' => 20,
		'menu_icon' => 'dashicons-calendar-alt',
		'supports' => array('author', 'title', 'thumbnail', 'editor', 'revisions', 'trackbacks')
	);
	register_post_type('event', $argsEvent);
}
add_action( 'init', '_udyux_custom_post_types' );
#/
