<?php
/**
 * Widget for displaying an unordered list with progress bars. Custom created for Sernprogramming.com
 */

/**
 * Progress Bar Widget Class
 */
class I4web_ToolBox_Widget extends WP_Widget{
  private $fields = array(
    'title'            => 'Widget Title',
	'toolbox_lead_txt' => 'The Lead Text',
    'toolbox_arr1'        => 'Your first toolbox array',  
    'toolbox_arr2'     => 'Your second toolbox array',
    'toolbox_arr3' => 'Your third toolbox array',
    'toolbox_arr4'     => 'Your fourth toolbox array'  	    
     
  );
  
  /**
  * Define the constructor 
  */
  function __construct() {
	  
    $widget_ops = array('classname' => 'widget_i4web_toolbox', 'description' => __('Use this widget to add your Github Repo Listing', 'i4web'));

    $this->WP_Widget('widget_i4web_toolbox', __('i4Web: Toolbox Widget', 'i4web'), $widget_ops);
    $this->alt_option_name = 'widget_i4web_toolbox';

	
    add_action('save_post', array(&$this, 'flush_widget_cache'));
    add_action('deleted_post', array(&$this, 'flush_widget_cache'));
    add_action('switch_theme', array(&$this, 'flush_widget_cache'));	  
	  
  }
  
  function widget($args, $instance) {
    $cache = wp_cache_get('widget_i4web_toolbox', 'widget');

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

    $title = apply_filters('widget_title', empty($instance['title']) ? __('Github Repo', 'i4web') : $instance['title'], $instance, $this->id_base);

    foreach($this->fields as $name => $label) {
      if (!isset($instance[$name])) { $instance[$name] = ''; }
    }
	
	
    echo $before_widget;		//Display the html before the widget

	
    if ($title) { 
      echo $before_title, $title, $after_title;
    }
  ?>
  
  
  <div class="sern-widget-content">

  <?php $this->i4web_toolbox($instance);?> 
                
  </div><!-- end sern-widget-content -->                     
    
  <?php
    echo $after_widget; //Display the html after the widget

    $cache[$args['widget_id']] = ob_get_flush();
    wp_cache_set('widget_i4web_toolbox', $cache, 'widget');	  
	
  } //end widget()
  
  /*
   * Update the Github Repo Widget
   */
  function update($new_instance, $old_instance){
    $instance = array_map('strip_tags', $new_instance);

    $this->flush_widget_cache();

    $alloptions = wp_cache_get('alloptions', 'options');

    if (isset($alloptions['widget_i4web_toolbox'])) {
      delete_option('widget_i4web_toolbox');
    }

    return $instance;	 
	 
  } //end update()
  
  function flush_widget_cache() {
    wp_cache_delete('widget_i4web_toolbox', 'widget');
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
  function i4web_toolbox($instance){
  
  $toolbox_info = $instance; 
?>
    <p><?php echo $toolbox_info['toolbox_lead_txt'];?></p>
    <ul class="sern-languages-list">
      <li><kbd><?php echo $toolbox_info['toolbox_arr1'];?></kbd></li>
      <li><kbd><?php echo $toolbox_info['toolbox_arr2'];?></kbd></li>
      <li><kbd><?php echo $toolbox_info['toolbox_arr3'];?></kbd></li>
      <li><kbd><?php echo $toolbox_info['toolbox_arr4'];?></kbd></li>      
    </ul>
       
    <div class="sern-widget-btn text-center">
      <a href="<?php get_bloginfo('url');?>/who-i-am" class="btn btn-orange" target="_blank">View Portfolio</a>
    </div>                
    
	
	  
<?php  }
	
}  // End I4web_ToolBox_Widget class

?>