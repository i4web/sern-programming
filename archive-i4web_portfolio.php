<?php get_template_part('templates/page', 'header'); ?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no projects were found.', 'i4web'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php
  if(is_post_type_archive('i4web_portfolio')){  //Only retrieve the github data if we are on the Archive page for the Portfolio CPT

    $sern_repos = i4web_get_repos_test();

  }
?>

<?php while (have_posts()) : the_post(); ?>
    <?php include(locate_template('templates/content.php'));  //using locate_template allows us to pass in the $sern_repos variable ?>
  <?php endwhile; ?>

<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav class="post-nav">
    <ul class="pager">
      <li class="previous"><?php next_posts_link(__('&larr; Older Projects', 'i4web')); ?></li>
      <li class="next"><?php previous_posts_link(__('Newer Projects &rarr;', 'i4web')); ?></li>
    </ul>
  </nav>
<?php endif; ?>
