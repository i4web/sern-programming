<?php get_template_part('templates/page', 'header'); ?>

<div class="alert alert-warning">
  <?php _e('Sorry, but the page you were trying to view does not exist.', 'i4web'); ?>
</div>

<p><?php _e('It looks like this was the result of either:', 'i4web'); ?></p>
<ul>
  <li><?php _e('a mistyped address', 'i4web'); ?></li>
  <li><?php _e('an out-of-date link', 'i4web'); ?></li>
</ul>

<?php get_search_form(); ?>
