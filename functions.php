<?php

// Register some sidebars
// =======================================================
 register_sidebar(array(
 'name' => __( 'Front page' ),
 'id' => 'frontpage',
 'description' => __( 'Right hand column, front page' ),
 'before_widget' => '<div>',
 'after_widget' => '</div>',
 'before_title' => '<h3>',
 'after_title' => '</h3>',
 ));

 register_sidebar(array(
 'name' => __( 'Inside page' ),
 'id' => 'insidepage',
 'description' => __( 'Right hand column, inside page' ),
 'before_widget' => '<div>',
 'after_widget' => '</div>',
 'before_title' => '<h3>',
 'after_title' => '</h3>',
 ));

 register_sidebar(array(
 'name' => __( 'Top bar' ),
 'id' => 'topbar',
 'description' => __( 'Found on the top of the site on every page, the top bar lives on the top right side of the header. Intended for search.' ),
 'before_widget' => '',
 'after_widget' => '',
 'before_title' => '<h3>',
 'after_title' => '</h3>',
 ));

 register_sidebar(array(
 'name' => __( 'Under the Logo' ),
 'id' => 'underlogo',
 'description' => __( 'Left hand column, under the logo.' ),
 'before_widget' => '<div>',
 'after_widget' => '</div>',
 'before_title' => '<h3>',
 'after_title' => '</h3>',
 ));

// Login Script and logo change
// ======================================================= 
function my_login_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo get_bloginfo( 'template_directory' ) ?>/images/logo.png);
            padding-bottom: 30px;
            height: 140px;
            background-size: auto;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
function my_login_logo_url() {
    return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'Your Site Name and Info';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

// Login redirects to front page, not dashboard
// ======================================================= 
function admin_default_page() {
  return '/';
}

add_filter('login_redirect', 'admin_default_page');


// Add featured image support
// ======================================================= 
add_theme_support( 'post-thumbnails' ); 

// Change the [...] at the end of the excerpt
// ======================================================= 
function new_excerpt_more( $more ) {
    return ' <div class="excerpt"><span>...</span></div>';
}
add_filter('excerpt_more', 'new_excerpt_more');

// Change the length the excerpt
// ======================================================= 
function custom_excerpt_length( $length ) {
    return 40;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// Register two menus
// ======================================================= 
function register_my_menus() {
  register_nav_menus(
    array(
      'primary-menu' => __( 'Primary Menu' ),
      'secondary-menu' => __( 'Extra Menu' )
    )
  );
}
add_action( 'init', 'register_my_menus' );


// Remove custom post_type from search results
// ======================================================= 

function searchfilter($query) {

    if ($query->is_search && !is_admin() ) {
        $query->set('post_type',array('post','page'));
    }
    if ($query->is_search && is_user_logged_in() ) {
        $query->set('post_type',array('post','page','qa_faqs'));
    }
return $query;
}

add_filter('pre_get_posts','searchfilter');

// Variable & intelligent excerpt length.
// ======================================================= 
function print_excerpt($length) { // Max excerpt length. Length is set in characters
    global $post;
    $text = $post->post_excerpt;
    if ( '' == $text ) {
        $text = get_the_content('');
        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]>', $text);
    }
    $text = strip_shortcodes($text); // optional, recommended
    $text = strip_tags($text); // use ' $text = strip_tags($text,'<p><a>'); ' if you want to keep some tags
    $text = substr($text,0,$length);
    $excerpt = reverse_strrchr($text, '.', 1);
    if( $excerpt ) {
        echo apply_filters('the_excerpt',$excerpt);
    } else {
        echo apply_filters('the_excerpt',$text);
    }
}

// Returns the portion of haystack which goes until the last occurrence of needle
function reverse_strrchr($haystack, $needle, $trail) {
    return strrpos($haystack, $needle) ? substr($haystack, 0, strrpos($haystack, $needle) + $trail) : false;
}
function kriesi_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  
     global $paged;
     if(empty($paged)) $paged = 1;
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
     if(1 != $pages)
     {
         
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }
         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
        
     }
}
?>