<?php





/*************************************************************************
* Find out the top most page's ID
* Pass the Post Object, not the ID! 
*
*/
function get_top_parent_id($post){

  if($post->post_type != 'page'){
    $post = archivePageInfo();
  }
  if ($post->post_parent)   {
    $ancestors=get_post_ancestors($post->ID);
    $root=count($ancestors)-1;
    $parent = $ancestors[$root];
  } else {
    $parent = $post->ID;
  }
  return $parent;
}


/*************************************************************************
* Returns object for the current page. 
* Only useful for archive.php pages that return the first CPT info in $post
* and not the details of the 'dummy' placeholder page defined in Admin Pages.
*/

function archivePageInfo() {
	
	global $post;

	// get object of the current CPT
	$postTypeInfo = get_post_type_object( $post->post_type );
	
	// if it's a post (not CPT) 
	if( $postTypeInfo->name == 'post'){

		return get_post(get_option( 'page_for_posts' ));

	// if it's the search results page
	}elseif(is_search()){
		return get_post('2213'); // the url could change in different languages, so use the ID.

	// it's a CPT
	}else{
		
		// lookup the slug defined in the rewrite rules for the CPT
	    $path = $postTypeInfo->rewrite['slug'];

	    // check the slug isn't invalid ie. events/%event-type% for the rewrite rules, and correct.
	    if(strpos($path, '%') !== FALSE){
	    	$path = strstr($path, '%', true);
	    }

	    // create an object of the CPT's archive page by looking it up using it's path set in WP admin Pages section
	    $archivePage = get_page_by_path($path);

	    return $archivePage; 		
	}



}





/*************************************************************************
* Highlight current page in wp_list_pages
* CPT archive pages doesn't have current_page_item class - this adds it in
*/

function wp_list_pages_filter($output) {

	// hook in to wp_list_pages and add a .current_page_item class to CPT archive pages
	// WP doesn't do this by default :(
		global $post;
		$archivePage = archivePageInfo(); // get archive page info
		
		if($archivePage){
			// search menu for start position archive page ID
			$insertPos = strpos($output, "$archivePage->ID"); 

			//get the length (in chars) of archive page ID
			$stringLength = strlen($archivePage->ID); 

			// offset the start pos of archive page ID with length of the archive page ID 
			// this will ensure our inserted class appears after the ID class
			$insertPos = $insertPos + $stringLength; 

			// insert the current page class into the string
			$modifiedOutput = substr_replace($output, ' current_page_item', $insertPos, 0);

			return $modifiedOutput;
		}else{
			return $output;
		}
	}

add_filter('wp_list_pages', 'wp_list_pages_filter');






/*************************************************************************
 *
 * Flickity compatible custom galleries using the built in WP shortcode (inserted via media library)
 *
 * As used on BSHF.org
 *
 * CODE BELOW TAKEN FROM /wp-includes/media.php AND BUTCHERED FOR STRIPPED DOWN SHORTCODE OUTPUT
 * OVERRIDING gallery_shortcode() 
 * BY DUNCAN KENDRICK
 *
 * Builds the Gallery shortcode output.
 *
 * This implements the functionality of the Gallery Shortcode for displaying
 * WordPress images on a post.
 *

 */
function gallery_shortcode_flickity( $attr ) {
	$post = get_post();

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) ) {
			$attr['orderby'] = 'post__in';
		}
		$attr['include'] = $attr['ids'];
	}


	$atts = shortcode_atts( array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post ? $post->ID : 0,
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => '',
		'link'       => ''
	), $attr, 'gallery' );

	$id = intval( $atts['id'] );

	if ( ! empty( $atts['include'] ) ) {
		$_attachments = get_posts( array( 'include' => $atts['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( ! empty( $atts['exclude'] ) ) {
		$attachments = get_children( array( 'post_parent' => $id, 'exclude' => $atts['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
	} else {
		$attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
	}



	// start main gallery wrap
	$output = "<div id='gallery-{$instance}-main' class='gallery gallery-{$id} gallery-main'>";
	
		// loop through the thumbs	
		foreach ( $attachments as $id => $attachment ) {
			$output .= "<figure class='gallery-item'>";
			$output .= wp_get_attachment_image( $id, 'galleryImage', false, $attr );
			if ( trim($attachment->post_excerpt) ) {
				$output .= "
					<figcaption id='$selector-$id'>
					" . wptexturize($attachment->post_excerpt) . "
					</figcaption>";
			}
			$output .= "</figure>";
		}

	$output .= "</div>\n\n\n";
	// end main gallery wrap


	// start thumbnail wrap
	$output .= "<div id='gallery-{$instance}-nav' class='gallery gallery-{$id} gallery-nav'>";
	
		// loop through the thumbs	
		foreach ( $attachments as $id => $attachment ) {
			$output .= "<div class='gallery-item'>";
			$output .= wp_get_attachment_image( $id, 'galleryThumb', false, $attr );
			$output .= "</div>";
		}

	$output .= "</div>\n";
	// end thumbnail wrap

	return $output;
}

remove_shortcode('gallery', 'gallery_shortcode');
add_shortcode('gallery', 'gallery_shortcode_flickity');







/*************************************************************************
*
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


