<?php
/**
 * Widget for displaying an unordered list with progress bars. Custom created for Sernprogramming.com
 */

/**
 * Progress Bar Widget Class
 */
class I4web_ProgressBar_Widget extends WP_Widget{
  private $fields = array(
    'title'            => 'Widget Title',
    'lead_text'        => 'Lead Text',  
    'language_one'     => 'Language One',
    'language_one_pct' => 'Language One &#37;',
    'language_two'     => 'Language Two',
    'language_two_pct' => 'Language two &#37;',
    'language_three'   => 'Language Three',
    'language_three_pct' => 'Language Three &#37;',
    'language_four'   => 'Language Three',
    'language_four_pct' => 'Language Three &#37;'  	    
     
  );
  
  /**
  * Define the constructor 
  */
  function __construct() {
	  
    $widget_ops = array('classname' => 'widget_i4web_progressbars', 'description' => __('Use this widget to add your Github Repo Listing', 'i4web'));

    $this->WP_Widget('widget_i4web_progressbars', __('i4Web: Progress Bars', 'i4web'), $widget_ops);
    $this->alt_option_name = 'widget_i4web_progressbars';

	
    add_action('save_post', array(&$this, 'flush_widget_cache'));
    add_action('deleted_post', array(&$this, 'flush_widget_cache'));
    add_action('switch_theme', array(&$this, 'flush_widget_cache'));	  
	  
  }
  
  function widget($args, $instance) {
    $cache = wp_cache_get('widget_i4web_progressbars', 'widget');

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

  <?php $this->i4web_progress_bars($instance);?> 
                
  </div><!-- end sern-widget-content -->                     
    
  <?php
    echo $after_widget; //Display the html after the widget

    $cache[$args['widget_id']] = ob_get_flush();
    wp_cache_set('widget_i4web_progressbars', $cache, 'widget');	  
	
  } //end widget()
  
  /*
   * Update the Github Repo Widget
   */
  function update($new_instance, $old_instance){
    $instance = array_map('strip_tags', $new_instance);

    $this->flush_widget_cache();

    $alloptions = wp_cache_get('alloptions', 'options');

    if (isset($alloptions['widget_i4web_progressbars'])) {
      delete_option('widget_i4web_progressbars');
    }

    return $instance;	 
	 
  } //end update()
  
  function flush_widget_cache() {
    wp_cache_delete('widget_i4web_progressbars', 'widget');
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
  function i4web_progress_bars($instance){
  
  $progress_info = $instance; 
?>
    <p><?php echo $progress_info['lead_text'];?></p>
    <ul class="sern-languages-list">
      <li><?php echo $progress_info['language_one'];?> <progress max="100" value="<?php echo $progress_info['language_one_pct'];?>"></progress></li>
      <li><?php echo $progress_info['language_two'];?> <progress max="100" value="<?php echo $progress_info['language_two_pct'];?>"></progress></li>
      <li><?php echo $progress_info['language_three'];?> <progress max="100" value="<?php echo $progress_info['language_three_pct'];?>"></progress></li>
      <li><?php echo $progress_info['language_four'];?> <progress max="100" value="<?php echo $progress_info['language_four_pct'];?>"></progress></li>      
    </ul>
    
    <div class="sern-widget-btn text-center">
      <a href="<?php get_bloginfo('url');?>/who-i-am" class="btn btn-orange" target="_blank">About Chris</a>
    </div>                
    
	
	  
<?php  }
	
}  // End I4web_ProgressBar_Widget class

?>