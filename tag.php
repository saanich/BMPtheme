<?php get_header(); ?>
  <!-- INDEX -->
  <div class="main container fourcol">
    <div class="col subcol">
      <h1 class="pagetitle"><span>BMPs by tag</span></h1>
      <h1 class="logo"><a href="<?php bloginfo('url'); ?>" ><span><?php bloginfo('name'); ?></span></a></h1>
      <?php dynamic_sidebar('underlogo') ?>
      <?php if (is_user_logged_in()) { dynamic_sidebar('insidepage2'); } ?>
    </div>
    <div class="col spantwo maincol">
    <?php if (is_user_logged_in()) { ?>
      <?php if ( have_posts() ) : ?>
        <h1 class="pagetitle">BMPs by tag</h1>
        <!-- Category Archive Start -->
        <div class="contentarea">
        	<h2><?php single_tag_title(); ?></h2>
			<?php while ( have_posts() ) : the_post(); ?>
				 <h3><span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span></h3>
			<?php endwhile; ?>
        </div>
        <!-- Category Archive End -->
      <?php endif; ?> 
      <?php if ( $wp_query->max_num_pages > 1 ) : ?> 
        <div class="pagination"> 
          <?php previous_posts_link( __('<< newer articles ') ); ?>
          <?php kriesi_pagination(); ?> 
          <?php next_posts_link( __('older articles >>') ); ?>
        </div>
      <?php endif;  ?>
      <?php } else { ?>
      <h1 class="pagetitle"><span>All BMPs</span></h1>
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