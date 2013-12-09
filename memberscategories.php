<?php
/*
Template Name: Members only categories list.
*/
?>
<?php get_header(); ?>
  <div class="main container fourcol">
    <div class="col subcol">
      <h1 class="pagetitle"><span><?php the_title(); ?></span></h1>
      <h1 class="logo"><a href="<?php bloginfo('url'); ?>" ><span><?php bloginfo('name'); ?></span></a></h1>
      <?php dynamic_sidebar('underlogo') ?>
      <?php if (is_user_logged_in()) { dynamic_sidebar('insidepage2'); } ?>
    </div>
    <div class="col spantwo maincol">
      <?php if (is_user_logged_in()) { ?>
        <h1 class="pagetitle"><span><?php the_title(); ?></span></h1>
         <form method="get" id="searchform" action="http://bmp.saanich.ca">
        <div>
        <input class="text" type="search" placeholder="search BMPs" value=" " name="s" id="s">
        <input type="submit" class="submit" name="Submit" value="Search Site">
        <input type="hidden" name="post_type" value="bmparchive" />
        </div>
        </form>
        <div class="contentarea">
        
        <?php
        $categories = get_categories($args);
          foreach($categories as $category) { 
            echo '<h2><span><a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a></span></h2> ';
         } 
        ?>
        </div>  
      <?php } else { ?>

      <h1 class="pagetitle"><span><?php the_title(); ?></span></h1>
      <div class="contentarea">
        <p>I'm sorry, but you must be logged in to view this page.</p>
      </div>

      <?php } ?>
    </div>
    <div class="col subcol">
      <?php dynamic_sidebar('insidepage') ?>
    </div>
  </div>
<?php get_footer(); ?>