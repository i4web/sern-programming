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

    //Set the paged parameter
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    //Args to query the portfolio posts
    $args = array(
	'post_type'         => 'i4web_portfolio',
    'posts_per_page'    => 20,
    'paged'             => $paged
    );

    $query = new WP_Query( $args );

    echo '<div class="grid">';

    // The Portfolio Loop
    while ( $query->have_posts() ) : the_post();
        $query->the_post();

        $terms = wp_get_post_terms( get_the_ID(), 'type' );

        //store the name of the first taxonomy type assigned to the portofolio item
        $portfolioTerm = sanitize_title($terms[0]->name);

        echo '<div class="col-md-6 col-lg-4 element-item '.$portfolioTerm.'">';
        echo '<div class="portfolio-item-wrapper">';
        echo '<figure class="thumbnail_portfolio">';
        echo '<a href="'.get_the_permalink().'">';
        //display the post thumbnail if available
        if ( has_post_thumbnail() ){
            the_post_thumbnail( array(600, 350), array( 'class' => 'img-responsive sern-feat-img' ) );
        }
        else{ //display the default featured image if a featured image has not been set
            echo '<img src="'.get_stylesheet_directory_uri().'/assets/img/source-code.jpg" class="img-responsive sern-feat-img wp-post-image"/>';
        }
        echo '</a>';
        echo '</figure>';
        echo '<h4 class="portfolio-link"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h4>';
        echo '</div>'; //end .portfolio-item-wrapper
        echo '<div class="portfolio-spacer"></div>';
        echo '</div>';
    endwhile; // End of the loop.


    echo '</div>'; //end .grid

    // next_posts_link() usage with max_num_pages
    echo '<div class="pagination">
            <ul>';
    echo '<li>';
    next_posts_link( 'Older Projects', $query->max_num_pages );
    echo '</li>';
    echo '<li>';
    previous_posts_link( 'Newer Projects' );
    echo '</li>';
    echo '  </ul>
          </div>'; //end .pagination

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
