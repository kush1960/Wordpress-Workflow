<?php



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
