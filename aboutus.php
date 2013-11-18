<?php
/*
Template Name: about us
*/
?>
<?php get_header(); ?>
  <div class="main page-wrap">
    <div class="container onecol"> 
      <?php if (has_post_thumbnail()) : ?>
        <?php the_post_thumbnail(
        array(960, 990),
        array('class' => 'mainimage')); ?>
      <?php endif; ?>
      <div class="col">
        <?php if (have_posts()) : ?>
          <?php while (have_posts()) : the_post(); ?>
            <div class="contentarea">
              <!-- Page title -->
              <h2 class="pagetitle"><span><?php the_title(); ?></span></h2>
              <?php the_content("Read more..."); ?>
            </div>
          <?php endwhile; ?>       
        <?php else : ?>
          <div class="contentarea">
            <h2><?php _e('Oops! Page not found!'); ?></h2>
            <p>I couldn't find any posts</p>
          </div>
        <?php endif; ?> 
      </div>
    </div>
  </div>
<?php get_footer(); ?>











