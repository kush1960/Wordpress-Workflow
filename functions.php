<?php
/*************************************************************************
* General settings
*************************************************************************/

/* Disabled WP version number from showing */
function complete_version_removal() {
    return '';
}
add_filter('the_generator', 'complete_version_removal');

show_admin_bar(false);
 
// Required for IE9 to play nice with ACF with the WordPress admin area.
//add_theme_support( 'post-thumbnails');

/* Custom logo on admin login */
function custom_login_logo() {
    echo '<style>h1 a { background-image:url('.get_bloginfo('template_directory').'/images/logo-admin.jpg) !important; background-size: 320px 100px !important; height: 100px !important; width: 320px !important; }</style>';
}
add_action('login_head', 'custom_login_logo');

/* Override link for custom wp-login image */
function wp_login_logo_link() {
    return get_site_url();
}
add_filter( 'login_headerurl', 'wp_login_logo_link' );

/* Hide admin bar */
add_filter('show_admin_bar', '__return_false');


/*************************************************************************
* Include Files
*************************************************************************/

include_once 'includes/form_helper.php';

/*************************************************************************
* Add page specific js
*************************************************************************/

/**
 * Adds additional js include files on a per page basis
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
        global $wp_query;


        wp_enqueue_script('main', get_template_directory_uri() .'/js/main.js','','',true); // all scripts are combined in a single JS



   }
}
add_action('wp_enqueue_scripts', 'javascript');



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
* Register Custom Post Types
*************************************************************************/

function create_example_cpt() 
{
    $labels = array(
        'name'                  => 'Example CPT',
        'singular_name'         => 'Example CPT',
        'add_new'               => 'Add Example CPT',
        'add_new_item'          => 'Add New Example CPT',
        'edit_item'             => 'Edit Example CPT',
        'new_item'              => 'New Example CPT',
        'all_items'             => 'All Example CPTs',
        'view_item'             => 'View Example CPTs',
        'search_items'          => 'Search Example CPTs',
        'not_found'             => 'No Example CPTs found',
        'not_found_in_trash'    => 'No Example CPTs found in Trash',
        'parent_item_colon'     => '',
        'menu_name'             => 'Example CPT'
    );

    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'exclude_from_search'   => false,
        'show_in_admin_bar'     => false,
        'show_in_nav_menus'     => false,
        'publicly_queryable'    => true,
        'query_var'             => false,
        'taxonomies'            => array('category', 'post_tag') , 
        'supports'              => array( 'title' , 'editor' )
    );

    register_post_type('example-cpt', $args);
}
add_action('init', 'create_example_cpt');




/*************************************************************************
* Add custom image sizes
*************************************************************************/


//add_image_size( 'sample', 200, 200, true );


/*************************************************************************
* WYSIWYG stuff
*************************************************************************/


// add custom editor styles - adding main Stylesheet. Possibly too much bloat?
add_editor_style('style.css');





// add  custom classes to WYSIWYG editor
function wpb_mce_buttons_2($buttons) {
    array_unshift($buttons, 'styleselect');
    return $buttons;
}
add_filter('mce_buttons_2', 'wpb_mce_buttons_2');



/*
* Callback function to filter the MCE settings
*/

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


/*************************************************************************
* Remove 'Posts' and 'Comments' from admin
*************************************************************************/

function remove_stuff ()      //creating functions post_remove for removing menu item
{ 
 //  remove_menu_page('edit.php');
 //  remove_menu_page('edit-comments.php');
}

// add_action('admin_menu', 'remove_stuff');   //adding action for triggering function call


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