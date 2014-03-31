<?php
/**
 * Register sidebars and widgets
 */
require_once('i4web-widget-github.php'); 
require_once('i4web-widget-progress-bars.php');
require_once('i4web-widget-toolbox.php');
require_once('i4web-widget-radial-progress-bar.php');
 
function i4web_widgets_init() {
  // Sidebars
  register_sidebar(array(
    'name'          => __('Primary', 'i4web'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
  ));
  
  register_sidebar(array(
    'name'          => __('Strengths Area', 'i4web'),
    'id'            => 'strengths-widget',
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
  ));  
  
  register_sidebar(array(
    'name'          => __('Home Page', 'i4web'),
    'id'            => 'home-page-widget',
    'before_widget' => '<div class="col-lg-4 sern-widget-wrapper"><div class="sern-widget">',
    'after_widget'  => '</div></div>',
    'before_title'  => '<div class="sern-widget-header"><h4><span class="glyphicon glyphicon-usd text-orange"></span> ',
    'after_title'   => '</h4></div>',
  ));

  register_sidebar(array(
    'name'          => __('Footer', 'i4web'),
    'id'            => 'sidebar-footer',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
  ));

  // Widgets
  register_widget('I4web_Vcard_Widget');
  register_widget('I4web_Github_Widget');
  register_widget('I4web_ProgressBar_Widget');
  register_widget('I4web_ToolBox_Widget');
  register_widget('I4web_Radials_Widget');
  
}
add_action('widgets_init', 'i4web_widgets_init');


/**
 * Example vCard widget
 */
class I4web_Vcard_Widget extends WP_Widget {
  private $fields = array(
    'title'          => 'Title (optional)',
    'street_address' => 'Street Address',
    'locality'       => 'City/Locality',
    'region'         => 'State/Region',
    'postal_code'    => 'Zipcode/Postal Code',
    'tel'            => 'Telephone',
    'email'          => 'Email'
  );

  function __construct() {
    $widget_ops = array('classname' => 'widget_i4web_vcard', 'description' => __('Use this widget to add a vCard', 'i4web'));

    $this->WP_Widget('widget_i4web_vcard', __('i4Web: vCard', 'i4web'), $widget_ops);
    $this->alt_option_name = 'widget_i4web_vcard';

    add_action('save_post', array(&$this, 'flush_widget_cache'));
    add_action('deleted_post', array(&$this, 'flush_widget_cache'));
    add_action('switch_theme', array(&$this, 'flush_widget_cache'));
  }

  function widget($args, $instance) {
    $cache = wp_cache_get('widget_i4web_vcard', 'widget');

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

    $title = apply_filters('widget_title', empty($instance['title']) ? __('vCard', 'i4web') : $instance['title'], $instance, $this->id_base);

    foreach($this->fields as $name => $label) {
      if (!isset($instance[$name])) { $instance[$name] = ''; }
    }

    echo $before_widget;

    if ($title) {
      echo $before_title, $title, $after_title;
    }
  ?>
    <p class="vcard">
      <a class="fn org url" href="<?php echo home_url('/'); ?>"><?php bloginfo('name'); ?></a><br>
      <span class="adr">
        <span class="street-address"><?php echo $instance['street_address']; ?></span><br>
        <span class="locality"><?php echo $instance['locality']; ?></span>,
        <span class="region"><?php echo $instance['region']; ?></span>
        <span class="postal-code"><?php echo $instance['postal_code']; ?></span><br>
      </span>
      <span class="tel"><span class="value"><?php echo $instance['tel']; ?></span></span><br>
      <a class="email" href="mailto:<?php echo $instance['email']; ?>"><?php echo $instance['email']; ?></a>
    </p>
  <?php
    echo $after_widget;

    $cache[$args['widget_id']] = ob_get_flush();
    wp_cache_set('widget_i4web_vcard', $cache, 'widget');
  }

  function update($new_instance, $old_instance) {
    $instance = array_map('strip_tags', $new_instance);

    $this->flush_widget_cache();

    $alloptions = wp_cache_get('alloptions', 'options');

    if (isset($alloptions['widget_i4web_vcard'])) {
      delete_option('widget_i4web_vcard');
    }

    return $instance;
  }

  function flush_widget_cache() {
    wp_cache_delete('widget_i4web_vcard', 'widget');
  }

  function form($instance) {
    foreach($this->fields as $name => $label) {
      ${$name} = isset($instance[$name]) ? esc_attr($instance[$name]) : '';
    ?>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id($name)); ?>"><?php _e("{$label}:", 'i4web'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id($name)); ?>" name="<?php echo esc_attr($this->get_field_name($name)); ?>" type="text" value="<?php echo ${$name}; ?>">
    </p>
    <?php
    }
  }
}
