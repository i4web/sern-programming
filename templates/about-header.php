<?php 

//Grab the users Avatar URL from Github

$gitUser = i4web_get_git_avatar();

$avatarUrl = $gitUser->avatar_url;

$gitName = $gitUser->name;

$gitLocation = $gitUser->location;

?> 

<div class="about-header">
  <div class="sern-gravatar">    
    <img src="<?php echo $avatarUrl;?>" height="150" width="150" class="img-circle"/>
    <h4 class="text-center"><?php echo $gitName;?> <small><?php echo $gitLocation;?></small></h4>
  </div> 
  
</div>


  
