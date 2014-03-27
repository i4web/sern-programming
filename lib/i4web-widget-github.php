<?php
/**
 * Widget for displaying a users github repositories
 */

/**
 * Github Repo Widget Class
 */
class I4web_Github_Widget extends WP_Widget{
  private $fields = array(
    'title'                 => 'Widget Title',  
    'github_widget_lead_txt'       => 'Lead Text',
    'github_api_url'        => 'API Url',
    'github_transient_key'  => 'Transient Key',
    'github_user_url'       => 'Github User URL'       
     
  );
  
  /**
  * Define the constructor 
  */
  function __construct() {
	  
    $widget_ops = array('classname' => 'widget_i4web_github', 'description' => __('Use this widget to add your Github Repo Listing', 'i4web'));

    $this->WP_Widget('widget_i4web_github', __('i4Web: Github', 'i4web'), $widget_ops);
    $this->alt_option_name = 'widget_i4web_github';

	
    add_action('save_post', array(&$this, 'flush_widget_cache'));
    add_action('deleted_post', array(&$this, 'flush_widget_cache'));
    add_action('switch_theme', array(&$this, 'flush_widget_cache'));	  
	  
  }
  
  function widget($args, $instance) {
    $cache = wp_cache_get('widget_i4web_github', 'widget');

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
    <ul class="sern-github-repo-list">
      <p><?php echo $instance['github_widget_lead_txt'];?></p>
    
<?php
    $i = 0;		//Counter to help limit the # of repos displayed
      
	foreach ( $this->i4web_get_repos($instance) as $repo ) {
		
	if($i <= 3){ 
	  echo '<li>';
	  echo '<a href="'.$repo->html_url.'" target="_blank">'.$repo->name.'</a><span class="sern-github-meta"><a href="'.$repo->forks_url.'">Fork <span class="badge">'.$repo->forks_count.'</span></a></span>';
	  echo '</li>';
	  $i++;
	}
	else
	 ; // do nothing
	
	}
             
?>
    </ul> <!-- end sern-github-repo-list -->
    
                 
  </div><!-- end sern-widget-content -->                     

    <div class="sern-widget-btn text-center">
      <a href="<?php echo $instance['github_user_url'];?>" class="btn btn-orange" target="_blank">View All</a>
    </div> 
    
  <?php
    echo $after_widget; //Display the html after the widget

    $cache[$args['widget_id']] = ob_get_flush();
    wp_cache_set('widget_i4web_github', $cache, 'widget');	  
	
  } //end widget()
  
  /*
   * Update the Github Repo Widget
   */
  function update($new_instance, $old_instance){
    $instance = array_map('strip_tags', $new_instance);

    $this->flush_widget_cache();

    $alloptions = wp_cache_get('alloptions', 'options');

    if (isset($alloptions['widget_i4web_github'])) {
      delete_option('widget_i4web_github');
    }

    return $instance;	 
	 
  } //end update()
  
  function flush_widget_cache() {
    wp_cache_delete('widget_i4web_github', 'widget');
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
  
	/**
	* Get the users Github Repo Listing
	* @todo set proper transient time
	*/
	function i4web_get_repos($instance) {
		
		$github = $instance;
		$transient_key = $github['github_transient_key'];
		$api_url = $github['github_api_url'];
		
	
		 $repos = get_transient( $transient_key );
		if ( false !== $repos )
			return $repos;
	
		$response = wp_remote_get( $api_url );
		if ( is_wp_error( $response ) )
			return array();
	
		$repos = json_decode( wp_remote_retrieve_body( $response ) );
		if ( ! is_array( $repos ) )
			return array();
	
		set_transient( $transient_key, $repos, 1 );
		
		return (array) $repos;
		
	} //end i4web_get_repos()
	
}  // End I4web_Github_Widget class

?>