<?php get_header(); ?>
  <!-- INDEX -->
  <div class="main container fourcol">
    <div class="col subcol">
      <h1 class="pagetitle"><span>All BMPs</span></h1>
      <h1 class="logo"><a href="<?php bloginfo('url'); ?>" ><span><?php bloginfo('name'); ?></span></a></h1>
           
      <?php dynamic_sidebar('underlogo') ?>
      <?php if (is_user_logged_in()) { dynamic_sidebar('insidepage2'); } ?>
    </div>
    <div class="col spantwo maincol">
    <?php if (is_user_logged_in()) { ?>
      <?php if ( have_posts() ) : ?>
        <h1 class="pagetitle"><span>All BMPs</span></h1>
         <form method="get" id="searchform" class="searchbmps" action="/">
          <div>
          <input class="text" type="search" placeholder="search BMPs" value=" " name="s" id="s">
          <input type="submit" class="submit" name="Submit" value="Search BMPs">
          <input type="hidden" name="post_type" value="bmparchive" />
          </div>
        </form>
        <!-- Category Archive Start -->
        <div class="contentarea">
          <?php
          $catQuery = $wpdb->get_results("SELECT * FROM $wpdb->terms AS wterms INNER JOIN $wpdb->term_taxonomy AS wtaxonomy ON ( wterms.term_id = wtaxonomy.term_id ) WHERE wtaxonomy.taxonomy = 'category' AND wtaxonomy.parent = 0 AND wtaxonomy.count > 0");
          foreach ($catQuery as $category) {
            $catLink = get_category_link($category->term_id);
            echo '<h2><span><a href="'.$catLink.'" title="'.$category->name.'">'.$category->name.'</a></span></h2>';
              query_posts('cat='.$category->term_id.'&showposts=10000');?>
              <?php while (have_posts()) : the_post(); ?>
                  <h3 class="qa-faq-title"><span><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></span></h3>
              <?php endwhile; ?>
          <?php } ?>
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