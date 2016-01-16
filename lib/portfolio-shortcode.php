<?php
/**
 * The isotope based portfolio shortcode
 *
 */

/**
 * Setup the i4web_portfolio Shortcode
 *
 */
function i4web_portfolio_shortcode(){

   ob_start();
   i4web_portfolio();
   return ob_get_clean();

}

/**
 * Displays the Portfolio for the i4web_portfolio shortcode
 *
 */
function i4web_portfolio(){
  printf(__('<div class="i4web-portfolio-wrapper col-sm-12">'));

  //Args for the Categories query
  $args = array(
	'type'					 => 'i4web_portfolio',
	'child_of'				 => 0,
	'parent'				   => '',
	'orderby'				  => 'name',
	'order'					=> 'ASC',
	'hide_empty'			   => 1,
	'hierarchical'			 => 1,
	'exclude'				  => '',
	'include'				  => '',
	'number'				   => '',
	'taxonomy'				 => 'type',
	'pad_counts'			   => false

);

    $categories = get_categories( $args );

    echo '<div class="button-group filters-button-group">
    <a href="#" class="btn btn-orange" data-filter="*">show all</a>';

    foreach($categories as $category){
        $sanitizedCatName = sanitize_title($category->name);
      echo '<a href="#" class="btn btn-orange" data-filter=".'.$sanitizedCatName.'">'. $category->name. '</a>';
    }
    echo '</div>'; //end .button-group

    //Args to query the portfolio posts
    $args = array(
	'post_type' => 'i4web_portfolio'
    );

    $query = new WP_Query( $args );

    echo '<div class="grid">';

    // The Portfolio Loop
    while ( $query->have_posts() ) {
    	$query->the_post();

        $terms = wp_get_post_terms( get_the_ID(), 'type' );

        //store the name of the first taxonomy type assigned to the portofolio item
        $portfolioTerm = sanitize_title($terms[0]->name);

        echo '<div class="col-md-6 col-lg-4 element-item '.$portfolioTerm.'">'.get_the_title().'</div>';
    }

    echo '</div>'; //end .grid

    /* Restore original Post Data
     * NB: Because we are using new WP_Query we aren't stomping on the
     * original $wp_query and it does not need to be reset with
     * wp_reset_query(). We just need to set the post data back up with
     * wp_reset_postdata().
     */
    wp_reset_postdata();

    printf(__('</div>')); //end .i4web-portfolio-wrapper

}

add_shortcode( 'i4web_portfolio', 'i4web_portfolio_shortcode' );
