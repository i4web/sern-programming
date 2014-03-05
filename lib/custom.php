<?php
/**
 * Custom functions
 */
 
 //Automatically add Bootstrap responsive image class to images uploaded in the WP Editor
 
add_filter( 'image_send_to_editor', 'responsive_images', 10, 7);
   function responsive_images($html, $id, $alt, $title, $align, $url, $size ) {
	   $url = wp_get_attachment_url($id); // Grab the current image URL
	   $html = '<a href="' . $url .  '" class="img-responsive" rel="your-rel"><img src="..." /></a>';
	   return $html;
   }
?>
