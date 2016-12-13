<?php


/*************************************************************************
* Image sizes and config
/*************************************************************************

/* Enable featured image */
add_theme_support( 'post-thumbnails' );


/* custom images sizes */
//add_image_size( 'test', 333, 333, true );


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
* Disable WP version number from showing
* makes it harder for hackers to find version number
*************************************************************************/

function complete_version_removal() {
    return '';
}
add_filter('the_generator', 'complete_version_removal');

show_admin_bar(false);


 
/*************************************************************************
* Hide WP admin bar 
*************************************************************************/

add_filter('show_admin_bar', '__return_false');


