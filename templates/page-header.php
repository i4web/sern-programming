<div class="page-header">
  <h2 class="text-center text-orange">
   <?php echo i4web_title(); ?> 
  </h2>
  
  <?php  

  if (!get_post_type( 'i4web_portfolio' ) && !is_tax()){ //If the page displayed is the portfolio archive and not a taxonomy archive
    echo '<p class="text-center">Here you will find examples of my work past, present, and maybe even the future!</p>';
  }
  elseif(is_tax()){  //Taxonomy archive pages
    
	$description = term_description(); // grab the term description
	
    echo '<p class="text-center">'.$description .'</p>';
  }?>
  
  <div class="header-chevron text-center">
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/down-chevron.png">
  </div>
  
  
</div> <!-- end page-header -->
