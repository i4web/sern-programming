<? 
/**
 * Display the Strengths Area
 */
?>

<section class="sern-strengths-area grey-bg" id="sern-scroll">
  
  <h2 class="text-center">my.Strengths();</h2>
 
  <p class="lead text-center">Knight Rider, a shadowy flight into the dangerous world of a man who does not exist. </p>
  
  <div class="container">  <!-- Begin container -->
    <div class="col-sm-4 col-lg-4 sern-strengths-wrapper">  <!-- Begin sern-strengths-wrapper -->
     
      <div class="radial-progress radial-a" data-strength="50" data-progress="0">  <!-- Begin Progress Bar -->
        <div class="circle">
          <div class="mask full">
            <div class="fill"></div>
          </div>
            <div class="mask half">
              <div class="fill"></div>
              <div class="fill fix"></div>
            </div>
            <div class="shadow"></div>
        </div>
	  <div class="inset">
		<div class="percentage"></div>
	  </div>
	  </div>  <!-- end Progress Bar -->  
     
     <div class="sern-strengths-title"> 
       <p>Software Development<p>
     </div> 
     
    </div> <!-- end sern-strengths-wrapper -->
    
    <div class="col-sm-4 col-lg-4 sern-strengths-wrapper">  <!-- Begin sern-strengths-wrapper -->
    
      <div class="radial-progress radial-b" data-strength="60" data-progress="0">  <!-- Begin Progress Bar -->
        <div class="circle">
          <div class="mask full">
            <div class="fill"></div>
          </div>
            <div class="mask half">
              <div class="fill"></div>
              <div class="fill fix"></div>
            </div>
            <div class="shadow"></div>
        </div>
	  <div class="inset">
		<div class="percentage"></div>
	  </div>
	  </div>  <!-- end Progress Bar -->  
     
     <div class="sern-strengths-title"> 
       <p>Web Development<p>
     </div>     
    
    </div>  <!-- end sern-strengths-wrapper -->
    <div class="col-sm-4 col-lg-4 sern-strengths-wrapper">  <!-- Begin sern-strengths-wrapper -->
      <div class="radial-progress radial-c" data-strength="80" data-progress="0">  <!-- Begin Progress Bar -->
        <div class="circle">
          <div class="mask full">
            <div class="fill"></div>
          </div>
            <div class="mask half">
              <div class="fill"></div>
              <div class="fill fix"></div>
            </div>
            <div class="shadow"></div>
        </div>
	  <div class="inset">
		<div class="percentage"></div>
	  </div>
	  </div>  <!-- end Progress Bar -->  
     
     <div class="sern-strengths-title"> 
       <p>Game Development<p>
     </div> 
    </div>   <!-- end sern-strengths-wrapper -->     
  </div>  <!-- end container -->
  <strong></strong>
  <div class="strengths-cta-wrap text-center">
  <a href="<?php echo get_bloginfo();?>/who-i-am" class="btn btn-blue">Learn More</a>
  </div>
  
  <div class="wrap">
  
<script type="text/javascript">


//Function to store the Strengths Pct into Data Progress. Effectively Changes the data-progress value enabling the 0 to *num* effect
window.sernStrengths = function() {
	$('.radial-a').attr('data-progress', strengths[0]);
	$('.radial-b').attr('data-progress', strengths[1]);
	$('.radial-c').attr('data-progress', strengths[2]);
}

//Declare the Strengths Array. Will hold the data-strength attributes input via WordPress Admin area and collected from the HTML data-strength attribute
var strengths = [];

$("[data-progress]").each(function() {
  
  	 var strength = $(this).attr('data-strength');
	 strengths.push(strength);
	
$('.radial-progress').click(window.sernStrengths);
  
});

setTimeout(window.sernStrengths, 300);

  






</script> 
  

  
</div>
  

</section>