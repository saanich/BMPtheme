<?php get_header(); ?>
  <!-- CATEGORY TEMPLATE -->
  <div class="main container fourcol">
    <div class="col subcol">
      <h1 class="pagetitle"><span>BMPs by Category</span></h1>
      <h1 class="logo"><a href="<?php bloginfo('url'); ?>" ><span><?php bloginfo('name'); ?></span></a></h1>
      <?php dynamic_sidebar('underlogo') ?>
      <?php if (is_user_logged_in()) { dynamic_sidebar('insidepage2'); } ?>
    </div>
    <div class="col spantwo maincol">
    	<h1 class="pagetitle"><span>BMPs by Category</span></h1>
        <form method="get" id="searchform" class="searchbmps" action="/">
          <div>
          <input class="text" type="search" placeholder="search BMPs" value=" " name="s" id="s">
          <input type="submit" class="submit" name="Submit" value="Search BMPs">
          <input type="hidden" name="post_type" value="bmparchive" />
          </div>
        </form>
      <div class="contentarea"><h2><?php
      $category = get_the_category();
      echo ($category[0]->cat_name);
      ?></h2>
      
		<?php if ( have_posts() ) : ?>
			<?php while (have_posts()) : the_post(); ?>
			
			   	<h3><span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span></h3>
		    
		    <?php endwhile; ?>
		<?php endif; ?>
  </div>
      <?php if ( $wp_query->max_num_pages > 1 ) : ?> 
        <div class="pagination"> 
          <?php previous_posts_link( __('<< newer articles ') ); ?>
          <?php kriesi_pagination(); ?> 
          <?php next_posts_link( __('older articles >>') ); ?>
        </div>
      <?php endif;  ?>
    </div>
    <div class="col subcol">
      <?php dynamic_sidebar('insidepage') ?>
    </div>
  </div>
<?php get_footer(); ?>