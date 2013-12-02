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
      'secondary-menu' => __( 'Mobile Menu' )
    )
  );
}
add_action( 'init', 'register_my_menus' );

// Custom Nav
// ======================================================= 


add_filter( 'wp_nav_menu_items', 'add_loginout_link', 10, 2 );
function add_loginout_link( $items, $args ) {
    if (is_user_logged_in() && $args->theme_location == 'default') {
        $items .= '<li><a href="'. wp_logout_url() .'">Log Out</a></li>';
    }
    elseif (!is_user_logged_in() && $args->theme_location == 'default') {
        $items .= '<li><a href="'. site_url('wp-login.php') .'">Log In</a></li>';
    }
    return $items;
}

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

// Removes posts and pages from menu options in dashboard for those that aren't administrator.
// ======================================================= 

function remove_menus () {
    if(!current_user_can('administrator'))
    {
        remove_menu_page( 'wpcf7' );                      //Contactform 7
        remove_menu_page( 'edit.php' );                   //Posts
        remove_menu_page( 'upload.php' );                 //Media
        remove_menu_page( 'edit.php?post_type=page' );    //Pages
        remove_menu_page( 'edit-comments.php' );          //Comments
        remove_menu_page( 'themes.php' );                 //Appearance
        remove_menu_page( 'plugins.php' );                //Plugins
        remove_menu_page( 'users.php' );                  //Users
        remove_menu_page( 'tools.php' );                  //Tools
        remove_menu_page( 'options-general.php' );        //Settings  
        add_filter('screen_options_show_screen', 'remove_screen_options');
    }
}
add_action('admin_menu', 'remove_menus');

// Removes admin bar menus for those that aren't administrator.
// =======================================================

function admin_bar_edit() {
    if(!current_user_can('administrator'))
    {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('wp-logo');
        $wp_admin_bar->remove_menu('my-account-with-avatar'); 
        $wp_admin_bar->remove_menu('edit-profile');
        $wp_admin_bar->remove_menu('search');
        $wp_admin_bar->remove_menu('edit');
        $wp_admin_bar->remove_menu('new-content');
        $wp_admin_bar->remove_menu('new-post'); 
        $wp_admin_bar->remove_menu('new-page'); 
        $wp_admin_bar->remove_menu('new-media');
        $wp_admin_bar->remove_menu('new-link'); 
        $wp_admin_bar->remove_menu('new-user'); 
        $wp_admin_bar->remove_menu('new-theme'); 
        $wp_admin_bar->remove_menu('new-plugin');
        $wp_admin_bar->remove_menu('comments');
    }
}

// Adds topbar menus
// =======================================================

add_action( 'wp_before_admin_bar_render', 'admin_bar_edit' );

function admin_bar_sitelink() {
    global $wp_admin_bar;
    $wp_admin_bar->add_menu( array(  
        'id' => 'backhome', 
        'title' => __('Saanich main website'),  
        'href' => ('http://saanich.ca') 
        ) 
    ); 
}
add_action( 'wp_before_admin_bar_render', 'admin_bar_sitelink' );

// Change welcome text
// =======================================================

function custom_howdy( $text ) {
    $greeting = 'Welcome, you are logged in';
    if ( is_admin() ) {
        $text = str_replace( 'Howdy', $greeting, $text );
    }
    return $text;
}
add_filter( 'gettext', 'custom_howdy' );
?>