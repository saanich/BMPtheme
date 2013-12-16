<?php get_header(); ?>
  <div class="main container fourcol">
    <div class="col subcol">
      <h1 class="pagetitle"><span><?php the_title(); ?></span></h1>
      <h1 class="logo"><a href="<?php bloginfo('url'); ?>" ><span><?php bloginfo('name'); ?></span></a></h1>
      <?php dynamic_sidebar('underlogo') ?>
    </div>
    <div class="col spantwo maincol">
      <?php while (have_posts()) : the_post(); ?>
        <h1 class="pagetitle"><span><?php the_title(); ?></span></h1>
        <div class="contentarea">
          <?php the_content(); ?>
        </div>
      <?php endwhile; ?>   

    </div>
    <div class="col subcol">
      <?php dynamic_sidebar('frontpage') ?>
      <?php if (is_user_logged_in()) { dynamic_sidebar('insidepageright2'); } ?>
    </div>
  </div>
<?php get_footer(); ?>