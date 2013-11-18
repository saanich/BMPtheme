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
        <?php else : ?>
          <div class="contentarea">
          		<h2><?php _e('Oops! Page not found!'); ?></h2>
          		<p>I couldn't find any posts</p>
          </div>
        <?php endif; ?> 
        <?php if ( $wp_query->max_num_pages > 1 ) : ?> 
          <div class="pagination"> 
            <?php previous_posts_link( __('<< newer articles ') ); ?>
            <?php kriesi_pagination(); ?> 
            <?php next_posts_link( __('older articles >>') ); ?>
          </div>
        <?php endif;  ?>
        </div>
        <div class="col spantwo">
          <?php dynamic_sidebar('news') ?>
        </div>
      </div>
    </div>
<?php get_footer(); ?>