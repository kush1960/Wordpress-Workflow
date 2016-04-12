<?php

/**
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

