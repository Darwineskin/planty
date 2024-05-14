<?php /*

  This file is part of a child theme called Rubik_blank.
  Functions in this file will be loaded before the parent theme's functions.
  For more information, please read
  https://developer.wordpress.org/themes/advanced-topics/child-themes/

*/

// this code loads the parent's stylesheet (leave it in place unless you know what you're doing)

function your_theme_enqueue_styles()
{

    $parent_style = 'parent-style';

    wp_enqueue_style($parent_style,
        get_template_directory_uri() . '/style.css');

    wp_enqueue_style('child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array($parent_style),
        wp_get_theme()->get('Version')
    );
}

add_action('wp_enqueue_scripts', 'your_theme_enqueue_styles');

/*  Add your own functions below this line.
    ======================================== */
// ajoute un lien admin dans le menu navigation à la deuxième place
function add_admin_link_to_menu($items, $args) {
    if (is_user_logged_in() && $args->theme_location == 'main-menu') {
        // Créer le lien admin
        $admin_link = '<li class="menu-item admin-link"><a href="' . admin_url() . '">Admin</a></li>';

        // Convertir la chaîne d'éléments de menu en tableau
        $menu_items = explode('</li>', $items);

        // Déterminer la position pour insérer le lien Admin
        // Puisque 3 éléments et  le lien au milieu, insérez après le premier élément
        $position = 1;  // Insérer après le premier élément du menu

        // Insérer le lien admin à la position souhaitée
        array_splice($menu_items, $position, 0, $admin_link);

        // Reconstruire la chaîne d'éléments de menu
        $items = implode('</li>', $menu_items);
    }
    return $items . '</li>'; // Ajouter </li> pour fermer le dernier élément correctement
}

add_filter('wp_nav_menu_items', 'add_admin_link_to_menu', 10, 2);

// ajoute un logo//
function rubik_setup() {
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    ));
}

add_action( 'after_setup_theme', 'rubik_setup' );
