<?php

// Stick anything verbose in here to keep this file nice and clean
include_once('includes/customFunctions.php');

/*************************************************************************
* Image sizes and config
/*************************************************************************

/* Enable featured image */
add_theme_support( 'post-thumbnails' );


/* custom images sizes */
//add_image_size( 'test', 333, 333, true );



/*************************************************************************
* Enque Javascript
*************************************************************************/

/**
 * Optional - Add additional js include files on a per page basis
 *
 * e.g.
 *
 *  Find the name of the template we're on
 *  $template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );
 *  if ( $template_name == 'homepage.php' )
 *  {
 *    wp_enqueue_script('homepage', get_template_directory_uri() .'/js/homepage.js');   
 *  }
 *
 * @uses wp_query
*/
function javascript()
{
    // Check that we are viewing a frontend page
    if( !is_admin() )
    { 
        // Deregister then re-register script to enque jquery at bottom of page
        // This is better for performance but could break some plugins
        wp_deregister_script( 'jquery' );
        wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, NULL, true );
        wp_enqueue_script( 'jquery' );

        wp_enqueue_script('main', get_template_directory_uri() .'/js/main.js', array('jquery'), '', true); // all scripts are combined in a single JS
    }
}
add_action('wp_enqueue_scripts', 'javascript');




/*************************************************************************
* Register Custom Post Types
*************************************************************************/

function create_caseStudy_cpt() 
{
    $labels = array(
        'name'                  => 'Case Studies',
        'singular_name'         => 'Case Study',
        'add_new'               => 'Add Case Study',
        'add_new_item'          => 'Add New Case Study',
        'edit_item'             => 'Edit Case Study',
        'new_item'              => 'New Case Study',
        'all_items'             => 'View all Case Studies',
        'view_item'             => 'View Case Studies',
        'search_items'          => 'Search Case Studies',
        'not_found'             => 'No Case Studies found',
        'not_found_in_trash'    => 'No Case Studies found in Trash',
        'parent_item_colon'     => '',
        'hierarchical'          => false,
        'menu_name'             => 'Case Studies'
    );

    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'exclude_from_search'   => false,
        'show_in_admin_bar'     => false,
        'show_in_nav_menus'     => false,
        'has_archive'           => true,
        'publicly_queryable'    => true,
        'query_var'             => false,
        'taxonomies'            => array() , 
        'supports'              => array( 'title' , 'editor', 'page-attributes'),
        'rewrite'               => array(
                                    'slug' => 'other-information/case-studies',
                                    'with_front' => false
                                   )        
    );

    register_post_type('casestudies-cpt', $args);
}
add_action('init', 'create_caseStudy_cpt');




/*************************************************************************
* Rename Posts to News (or whatever is best for the project)
*************************************************************************/

function revcon_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'News';
    $submenu['edit.php'][5][0] = 'News';
    $submenu['edit.php'][10][0] = 'Add News';
    $submenu['edit.php'][16][0] = 'News Tags';
    echo '';
}
function revcon_change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'News';
    $labels->singular_name = 'News';
    $labels->add_new = 'Add News';
    $labels->add_new_item = 'Add News';
    $labels->edit_item = 'Edit News';
    $labels->new_item = 'News';
    $labels->view_item = 'View News';
    $labels->search_items = 'Search News';
    $labels->not_found = 'No News found';
    $labels->not_found_in_trash = 'No News found in Trash';
    $labels->all_items = 'All News';
    $labels->menu_name = 'News';
    $labels->name_admin_bar = 'News';
}
 
add_action( 'admin_menu', 'revcon_change_post_label' );
add_action( 'init', 'revcon_change_post_object' );


/*************************************************************************
* YOAST tweaks
*************************************************************************/

// Remove YOAST sidebar - it's annoying and not that useful
function remove_yoast_metabox_sidebar(){
    remove_meta_box('wpseo_meta', 'sidebar-banners-cpt', 'normal');
}
add_action( 'add_meta_boxes', 'remove_yoast_metabox_sidebar',11 );

// Move Yoast metabox to bottom in admin
function yoasttobottom() {
    return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');


/*************************************************************************
* WYSIWYG stuff
*************************************************************************/

// add custom front end styles to WYSIWYG - this adds main Stylesheet. Possibly too much bloat?
add_editor_style('style.css');

// add custom classes to WYSIWYG editor
/*
function wpb_mce_buttons_2($buttons) {
    array_unshift($buttons, 'styleselect');
    return $buttons;
}
add_filter('mce_buttons_2', 'wpb_mce_buttons_2');


// Callback function to filter the MCE settings
function my_mce_before_init_insert_formats( $init_array ) {  

// Define the style_formats array

    $style_formats = array(  
        // Each array child is a format with it's own settings
        array(  
          //  'title' => 'Small Paragraph',  
          //  'block' => 'p',  
          //  'classes' => 'small'
        )
    );  
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );  
    
    return $init_array;  
  
} 
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' ); 
*/

/*************************************************************************
* Register custom menus
*************************************************************************/

/*
function register_my_menus() {
  register_nav_menus(
    array(
      'mainNav' => __( 'Main Navigation' ),
      'sideBar' => __( 'Sidebar Navigation' ),
    )
  );
}
add_action( 'init', 'register_my_menus' );
*/



/*************************************************************************
* Remove 'Posts' and 'Comments' from admin
*************************************************************************/

function remove_stuff ()      //creating functions post_remove for removing menu item
{ 
 //  remove_menu_page('edit.php');
   remove_menu_page('edit-comments.php');
}

add_action('admin_menu', 'remove_stuff');   //adding action for triggering function call


/*************************************************************************
* Utility functions
*************************************************************************/

/**
 * Utility function to detect if current page is an ancestor of specifed 
 * post id.
 *
 * @param int post_id used to test ancestorship against.
 * @return bool true/false depending on weather or not the current page is an ancestor. 
*/
function is_ancestor( $post_id ) 
{
    global $wp_query;
    $ancestors = $wp_query->post->ancestors;

    if ( $post_id && $ancestors )
    {
        if ( in_array($post_id, $ancestors) ) 
        {
            return true;
        } 
        else 
        {
            return false;
        }
    }
    else
    {
        return false;
    }
}



/*************************************************************************
* Misc settings
*************************************************************************/

/* Disabled WP version number from showing - makes it harder for hackers to find version number */
function complete_version_removal() {
    return '';
}
add_filter('the_generator', 'complete_version_removal');

show_admin_bar(false);
 

/* Hide admin bar */
add_filter('show_admin_bar', '__return_false');


