<?php
/*
Template Name: Contact
*/
?>
<?php
/*
Template Name: fields
*/
?>
<?php get_header(); ?>
    <div class="container fivecol">
      <div class="col spanfive">
        <!-- Page title -->
          <h1 class="pagetitle"><span><?php the_title(); ?></span></h1>
      </div>
    </div>
    <div class="container fivecol">
      <div class="col spanthree">
        <?php if (have_posts()) : ?>
          <?php while (have_posts()) : the_post(); ?>
            <div class="contentarea">
              
              <!-- Set a featured image at the size specified. -->
              <?php if (has_post_thumbnail()) : ?>
                <div class="wp-caption alignleft"> 
                  <?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
                  echo '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" >';
                  the_post_thumbnail(
                    array(332,323),
                    array('class' => 'mainimage')); 
                  echo '</a>';?>
                </div>
              <?php endif; ?>
            <?php the_content("Read more..."); ?>
          </div>
          <?php endwhile; ?>       
        <?php else : ?>
            <h2><?php _e('Oops! Page not found!'); ?></h2>
            <p>I couldn't find any posts</p>
        <?php endif; ?> 
      </div>
      <div class="col spantwo">
        <?php dynamic_sidebar('contactsidebar') ?>
      </div>
    </div>

<?php get_footer(); ?>










