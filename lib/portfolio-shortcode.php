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
  printf(__('<div class="i4web-portfolio-wrapper">'));

  echo '<div class="button-group filter-button-group">
  <a href="#" class="btn btn-orange" data-filter="*">show all</a>
  <a href="#" class="btn btn-orange" data-filter=".category1">Category 1</a>
  <a href="#" class="btn btn-orange" data-filter=".category2">Category 2</a>
  <a href="#" class="btn btn-orange" data-filter=".category3">Category 3</a>
  <a href="#" class="btn btn-orange" data-filter=".category4">Category 4</a>
</div>';

  echo '<div class="grid">
  <div class="element-item category1">Category 1</div>
  <div class="element-item category2">Category 2</div>
  <div class="element-item category3">Category 3</div>
  <div class="element-item category4">Category 4</div>
  <div class="element-item category3">Category 3</div>
  <div class="element-item category1">Category 1</div>
  <div class="element-item category2">Category 2</div>
  ...
</div>
      ';
  printf(__('</div>'));

}

add_shortcode( 'i4web_portfolio', 'i4web_portfolio_shortcode' );
