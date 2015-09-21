<?php
$repoName = get_post_meta( get_the_ID(), 'i4_git_repo_title', true );  //retrieve the repo name set in the CPT
$repoURL = '';
?>


<div class="col-md-6 col-lg-4 sern-widget-wrapper">
  <div class="sern-widget">
<article <?php post_class(); ?>>
  <header>
  <div class="sern-widget-header">

    <h4 class="entry-title"><span class="glyphicon glyphicon-usd text-orange"></span> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span></h4>
  </div>

  </header>
  <div class="sern-widget-content">
    <div class="sern-project-desc-wrap">

  <?php  get_template_part('templates/entry-meta');

	$gitMatch = false;  //Initial the trigger to false

   	foreach ( $sern_repos as $repo ) { // loop through repos

      if ($repo->name == $repoName){  // we found a match now lets store some the HTML URL and set the trigger to true
	    $gitMatch = true;
	    $repoURL = $repo->html_url;

		if($repo->description != ''){  //use the github description when available

				  $repoTrimmed =  substr($repo->description, 0,50);  //trim the description to 50 chars
				  $repoTrimmed .= '&hellip;'; //append an ellipse to the end of the description when it's cut off

		?>

          <p><?php echo $repoTrimmed; ?></p>
  <?php }
		 else{ ?>
              <p><?php  the_excerpt(); //no github description available so use the_excerpt ?></p>
 <?php  }   ?>
    </div> <!-- end sern-project-desc-wrap <?php // this closing tag is inside the for loop so we need to add it to the condition that checks for if $github == false ?> -->

      <div class="sern-stats-wrap">
        <ul class="sern-stats">
          <li><h2><?php echo $repo->open_issues; ?><br><small>Issues</small></h2></li>
          <li><h2><?php echo $repo->forks; ?><br><small>Forks</small></h2></li>
          <li><h2><?php echo $repo->watchers; ?><br><small>Watchers</small></h2></li>
        </ul>
      </div>

<?php } //end if
      else{
	     // do nothing
	  }
	} //end foreach

  	  if($gitMatch == false){  // If we did not find a repo for this project or if it was not set we'll display the_excerpt ?>
		 <p><?php the_excerpt(); ?></p>
    </div> <!-- end sern-project-desc-wrap --><?php // the opening tag is before the for loop so this tag is included here too  ?>

     <?php // Since the Project is not on Github lets rab the Project custom stats as a fallback
	   $statOne = get_post_meta( get_the_ID(), 'i4_stat_one', true );
	   $statTitleOne = get_post_meta( get_the_ID(), 'i4_stat_one_title', true );
	   $statTwo = get_post_meta( get_the_ID(), 'i4_stat_two', true );
	   $statTitleTwo = get_post_meta( get_the_ID(), 'i4_stat_two_title', true );
	   $statThree = get_post_meta( get_the_ID(), 'i4_stat_three', true );
	   $statTitleThree = get_post_meta( get_the_ID(), 'i4_stat_three_title', true );
	 ?>

     <div>
        <ul class="sern-stats">
          <li><h2><?php echo $statOne;?><br><small><?php echo $statTitleOne; ?></small></h2></li>
          <li><h2><?php echo $statTwo;?><br><small><?php echo $statTitleTwo; ?></small></h2></li>
          <li><h2><?php echo $statThree;?><br><small><?php echo $statTitleThree; ?></small></h2></li>
        </ul>
      </div>

<?php } ?>


  </div>

	<?php if ($gitMatch){  //If the project being displayed is found on Github lets display an extra button?>
    <div class="sern-widget-btn text-center">
      <a href="<?php the_permalink();?>" class="btn btn-orange">View Project</a>
      <a href="<?php echo $repoURL;?>" class="btn btn-blue" target="_blank">View Code</a>
    </div>
	<?php }
    	   else{ //If the project is not on Github we'll only display the View Project button?>
    <div class="sern-widget-btn text-center">
      <a href="<?php the_permalink();?>" class="btn btn-orange">View Project</a>
    </div>
       <? } ?>

</article>


  </div>
</div>
