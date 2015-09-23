<?php
/**
 * Widget for displaying an unordered list with progress bars. Custom created for Sernprogramming.com
 */

/**
 * Progress Bar Widget Class
 */
class I4web_Radials_Widget extends WP_Widget{
  private $fields = array(

    'radial_title1'        => 'The title of your first radial progress bar',  
    'radial_val1'        => 'The value of your first radial progress bar',  
    'radial_title2'     => 'The title of your second radial progress bar',
    'radial_val2' => 'The value of your second radial progress bar',
    'radial_title3'     => 'The title of your third radial progress bar',
    'radial_val3' => 'The value of your third radial progress bar'	  	    
     
  );
  
  /**
  * Define the constructor 
  */
  function __construct() {
	  
    $widget_ops = array('classname' => 'widget_i4web_radials', 'description' => __('Use this widget your radial progress bars', 'i4web'));

    $this->WP_Widget('widget_i4web_radials', __('i4Web: Radials Widget', 'i4web'), $widget_ops);
    $this->alt_option_name = 'widget_i4web_radials';

	
    add_action('save_post', array(&$this, 'flush_widget_cache'));
    add_action('deleted_post', array(&$this, 'flush_widget_cache'));
    add_action('switch_theme', array(&$this, 'flush_widget_cache'));	  
	  
  }
  
  function widget($args, $instance) {
    $cache = wp_cache_get('widget_i4web_radials', 'widget');

    if (!is_array($cache)) {
      $cache = array();
    }

    if (!isset($args['widget_id'])) {
      $args['widget_id'] = null;
    }

    if (isset($cache[$args['widget_id']])) {
      echo $cache[$args['widget_id']];
      return;
    }

    ob_start();
    extract($args, EXTR_SKIP);

    $title = apply_filters('widget_title', empty($instance['title']) ? __('Radials Widget', 'i4web') : $instance['title'], $instance, $this->id_base);

    foreach($this->fields as $name => $label) {
      if (!isset($instance[$name])) { $instance[$name] = ''; }
    }
	
	
   // echo $before_widget;		//Display the html before the widget

	
   // if ($title) { 
   //   echo $before_title, $title, $after_title;
   // }
  ?>
  
  
<section class="sern-strengths-area grey-bg" id="sern-scroll">

  <?php $this->i4web_radials($instance);?> 

    <div class="strengths-cta-wrap text-center">
      <a href="<?php get_bloginfo('url');?>/who-i-am" class="btn btn-blue">Learn More</a>
    </div>  
                
</section><!-- end sern-widget-content -->  
  
                         
    
  <?php
    echo $after_widget; //Display the html after the widget

    $cache[$args['widget_id']] = ob_get_flush();
    wp_cache_set('widget_i4web_radials', $cache, 'widget');	  
	
  } //end widget()
  
  /*
   * Update the Radials Widget
   */
  function update($new_instance, $old_instance){
    $instance = array_map('strip_tags', $new_instance);

    $this->flush_widget_cache();

    $alloptions = wp_cache_get('alloptions', 'options');

    if (isset($alloptions['widget_i4web_radials'])) {
      delete_option('widget_i4web_radials');
    }

    return $instance;	 
	 
  } //end update()
  
  function flush_widget_cache() {
    wp_cache_delete('widget_i4web_radials', 'widget');
  }
  
  function form($instance){
    foreach($this->fields as $name => $label) {
      ${$name} = isset($instance[$name]) ? esc_attr($instance[$name]) : '';
    ?>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id($name)); ?>"><?php _e("{$label}:", 'i4web'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id($name)); ?>" name="<?php echo esc_attr($this->get_field_name($name)); ?>" type="text" value="<?php echo ${$name}; ?>">
    </p>
    <?php
    }
		  
  } // end form()
  
  /*
  * Display the unordered list with the progress bars
  */
function i4web_radials($instance){
  
  $radials_info = $instance; 
?>

<!-- Begin Radials HTML -->
  <h2 class="text-center">my.Strengths();</h2>

  <p class="lead text-center">I have a thing! It's like a plan, but with more greatness.</p>

  <div class="container">  <!-- Begin container -->
    <div class="col-sm-4 col-lg-4 sern-strengths-wrapper">  <!-- Begin sern-strengths-wrapper -->

      <div class="radial-progress radial-a" data-strength="<?php echo $radials_info['radial_val1'];?>" data-progress="0">  <!-- Begin Progress Bar -->
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
       <p><?php echo $radials_info['radial_title1'];?><p>
     </div>

    </div> <!-- end sern-strengths-wrapper -->

    <div class="col-sm-4 col-lg-4 sern-strengths-wrapper">  <!-- Begin sern-strengths-wrapper -->

      <div class="radial-progress radial-b" data-strength="<?php echo $radials_info['radial_val2'];?>" data-progress="0">  <!-- Begin Progress Bar -->
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
       <p><?php echo $radials_info['radial_title2'];?><p>
     </div>

    </div>  <!-- end sern-strengths-wrapper -->
    <div class="col-sm-4 col-lg-4 sern-strengths-wrapper">  <!-- Begin sern-strengths-wrapper -->
      <div class="radial-progress radial-c" data-strength="<?php echo $radials_info['radial_val3'];?>" data-progress="0">  <!-- Begin Progress Bar -->
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
       <p><?php echo $radials_info['radial_title3'];?><p>
     </div>
    </div>   <!-- end sern-strengths-wrapper -->
  </div>  <!-- end container -->
  <strong></strong>

<!-- end Radials -->

                 
   
	  
<?php  }
	
}  // End I4web_Radials_Widget class

?>
