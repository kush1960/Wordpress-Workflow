<?php

// Wordpress config and tweaks in here
include_once('includes/config.php');

// Register Custom Post Types in here as it gets verbose
include_once('includes/registerCPTs.php');

// Stick anything verbose in here to keep this file nice and clean
include_once('includes/customFunctions.php');



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



