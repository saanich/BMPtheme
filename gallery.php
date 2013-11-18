<?php
/*
Template Name: Gallery
*/
?>
<?php get_header(); ?>
   <div class="main page-wrap">
    <div class="container onecol">
      <!-- Page title -->
      <h2 class="pagetitle"><span><?php the_title(); ?></span></h2>
      <div class="col">
        <div class="photogallery">
          <?php echo do_shortcode("[nggalbum id=1 template=joel]"); ?>
        </div>
        <?php if (have_posts()) : ?>
          <?php while (have_posts()) : the_post(); ?>
              <?php the_content("Read more..."); ?>
          <?php endwhile; ?>        
        <?php endif; ?> 
      </div>
    </div>
  </div>
<?php get_footer(); ?>











