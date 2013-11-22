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
        <!-- If there's a post thumbnail, add it at the specified size -->
        <?php if (has_post_thumbnail()) : ?>
        <div class="indexbox">
           <div class="wp-caption alignleft">
           <a href="<?php the_permalink(); ?>">
           <?php  the_post_thumbnail(
                array(170, 170),
                array(
                      'class' => 'thumbnail'
                    )
              ); ?> 
            </a>
            </div>
          </div>
          <?php endif; ?> 
          <h3 class="headline"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h3>
          <?php print_excerpt(500); ?>
          <div class="excerpt"><span>…</span></div>
        </div>
        <!-- Add the The Permalink to the article -->
        <a href="<?php the_permalink(); ?>" class="more-link">Read More</a>
      <?php endwhile; ?>  
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