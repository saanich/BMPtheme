<?php


// =======================================================
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


// =======================================================
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


// =======================================================
// Login redirects to front page, not dashboard
// ======================================================= 
function admin_default_page() {
  return '/';
}

add_filter('login_redirect', 'admin_default_page');


// =======================================================
// Add featured image support
// ======================================================= 
add_theme_support( 'post-thumbnails' ); 


// =======================================================
// Change the [...] at the end of the excerpt
// ======================================================= 
function new_excerpt_more( $more ) {
    return ' <div class="excerpt"><span>...</span></div>';
}
add_filter('excerpt_more', 'new_excerpt_more');


// =======================================================
// Change the length the excerpt
// ======================================================= 
function custom_excerpt_length( $length ) {
    return 40;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


// =======================================================
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


// =======================================================
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


// =======================================================
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


// =======================================================
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


// =======================================================
// Removes posts and pages from menu options in dashboard for those that aren't administrator.
// ======================================================= 

function remove_menus () {
    if(!current_user_can('administrator'))
    {
        remove_menu_page( 'wpcf7' );                      //Contactform 7
        remove_menu_page( 'edit.php' );                   //Posts
        remove_menu_page( 'upload.php' );                 //Media
        //remove_menu_page( 'edit.php?post_type=page' );    //Pages
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



// =======================================================
// Removes admin bar menus for those that aren't administrator, but are editor.
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

// =======================================================
// Adds topbar menus
// =======================================================
add_action('set_current_user', 'csstricks_hide_admin_bar');
function csstricks_hide_admin_bar() {
  if (current_user_can('subscriber')) {
    show_admin_bar(false);
  }
}

// =======================================================
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


// =======================================================
// Change welcome text
// =======================================================

function custom_howdy( $text ) {
    $greeting = 'You are logged in';
    if (!current_user_can('administrator') ) {
        $text = str_replace( 'Howdy', $greeting, $text );
    }
    return $text;
}
add_filter( 'gettext', 'custom_howdy' );


// =======================================================
// Remove widgets from the dashboard.
// =======================================================

function remove_dashboard_widgets() {
    if(!current_user_can('administrator'))
    {
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');   // Right Now
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); // Recent Comments
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');  // Incoming Links
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal');   // Plugins
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');  // Quick Press
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');  // Recent Drafts
    remove_meta_box('dashboard_primary', 'dashboard', 'side');   // WordPress blog
    remove_meta_box('dashboard_secondary', 'dashboard', 'side');   // Other WordPress News
    // use 'dashboard-network' as the second parameter to remove widgets from a network dashboard.
    } 
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );



// =======================================================
// Add a widget to the dashboard.
// =======================================================

function bmp_add_dashboard_widgets() {

    wp_add_dashboard_widget(
                 'bmp_dashboard_widget',            // Widget slug.
                 'How to add BMPs',    // Title.
                 'bmp_dashboard_widget_function'    // Display function.
        );  
}
add_action( 'wp_dashboard_setup', 'bmp_add_dashboard_widgets' );
function bmp_dashboard_widget_function() {
    echo "
    <h1>Adding a BMP</h1>
    <p>To add a BMP, hover over, or click on the BMP menu to the left.</p>
    <p>In the submenu that shows up is a menu item called <a href='///bmp.saanich.ca/wp-admin/post-new.php?post_type=qa_faqs'>Add New</a>. In the Add BMP screen, you will be asked to enter a <strong>title</strong>, a <strong>short description</strong>, a  <strong>PDF file</strong> and <strong>select a category</strong>.</p>
    
    <h2>The title</h2>
    <p>The title is the title of the PDF document you are adding. This title will also be displayed on the page beneath the BMP category.</p>
    
    <h2>The short description</h2>
    <p>The short description contains information about the BMP. This is typically found on the BMP's PDF document cover page.</p>
    <p>Most BMP descriptions are sorted into categories. The <strong>description itself</strong>, the <strong>source</strong>, <strong>keywords</strong> and <strong>additional resources</strong> may be found on the BMPs</p>
    <p>Each of these sections is preceded by a <strong>header</strong>, or an <code>H4</code>. When creating the content for the BMPs type out the headings for descriptions, keywords and resources as <em>plain text</em> first. </p>
    <p>In between each of the paragraph headings, type in plan text the descriptions, keywords and resources themselves. Each of these are also in their own paragraph.</p>
    <p>When you are done, you will have several paragraphs of plain text. It will look something like this:</p>
    <pre>
    Description

    A temporary measure to settle sediment and fine particulates by slowing the movement of water within a small channel.
    
    Source

    Salix Applied Earthcare
    
    Keywords

    Check Dam, Velocity reduction, Sediment, Open Channel, Swale
    
    Additional Resources

    Salix Applied Earthcare Erosion Draw 5.0
    </pre>
    <p>Select each of the paragraphs, one at a time and convert them into headers. Select your first header and use the <em>format</em> dropdown from the top left of the short description input box, and chose <strong>heading 4</strong>. Do this to the rest of the headers.</p>
    
    <h2>Add the PDF file</h2>
    <p>Create a new paragraph at the bottom of the description. Ensure the cursor is flashing at the new paragraph at the bottom of the text.</p>
    <p>Click on the <strong>Add Media</strong> button, and a file browser will open. Here you can drag and drop in the PDF you are linking to, or use the file browser to locate the file on your hard drive.</p>
    <p>Once the file is uploaded you will be given the chance to give the file a title. Be sure to give it a readable title (remove the _ and other symbols found in the original file name). Adding a file description, and title can be found on the right hand side of the file uplod screen.</p>
    <p>Add in a caption and a description for the file. I usually copy and paste from the title. The Attachment display settings allow you to chose where it will link to: <strong>Media file</strong> or <strong>post page</strong>. In the BMP site, we are going to link it to the Media File, so our engineers can download it directly</p>
    <p>The text and icon for the PDF is appended to the name automatically, when viewed on the front end of the site.</p>
    <h2>Select the category</h2>
    <p>On the right hand side of the screen, you will find a list of all the categories. Select the category the BMP belongs to by checking the box next to it.</p> 
    <p>If additional categories are needed, you can create a new one by selecting <strong>Add New BMP Category</strong>.</p>
    ";
} 

function bmp_edit_dashboard_widgets() {

    wp_add_dashboard_widget(
                 'bmpedit_dashboard_widget',            // Widget slug.
                 'How to edit BMPs',                    // Title.
                 'bmpedit_dashboard_widget_function'    // Display function.
        );  
}
add_action( 'wp_dashboard_setup', 'bmp_edit_dashboard_widgets' );
function bmpedit_dashboard_widget_function() {
    echo "

    <h1>Editing a BMP</h1>
    <p>To edit a BMP, hover over, or click on the BMP menu to the left.</p>
    <p>In the submenu that shows up is a menu item called <a href='///bmp.saanich.ca/wp-admin/edit.php?post_type=qa_faqs'>BMPS</a>. In the BMP screen, you will see all the BMPs listed on the site in chronological order, newest at the top.</p>
    <p>Click on the file you wish to edit, and use the guidelines for adding a BMP to edit the BMP, or add a new file.</p>
    ";
} 
function bmp_delete_dashboard_widgets() {

    wp_add_dashboard_widget(
                 'bmpdelete_dashboard_widget',            // Widget slug.
                 'How to delete BMPs',                    // Title.
                 'bmpdelete_dashboard_widget_function'    // Display function.
        );  
}
add_action( 'wp_dashboard_setup', 'bmp_delete_dashboard_widgets' );
function bmpdelete_dashboard_widget_function() {
    echo "
    <h1>Deleting a BMP</h1>
    <p>To erase a BMP, hover over, or click on the BMP menu to the left.</p>
    <p>In the submenu that shows up is a menu item called <a href='///bmp.saanich.ca/wp-admin/edit.php?post_type=qa_faqs'>BMPS</a>. In the BMP screen, you will see all the BMPs listed on the site in chronological order, newest at the top.</p>
    <p>When you hover over a file name, a <span class='trash'><a href='#'>red link that says Trash</a></span> is shown, click on the link to delete the BMP.</p>
    <p>A yellow box will confirm that you have trashed the file, and will give you a chance to undo. Trashed files are found in the trash section of the BMPS and you will need to empty the trash if you wish to use the same file name.</p>
    ";
} 
// Register Custom Post Type

//This wan an experiment with settin gmy own custom post tyle, but it wasn't good enough. I needed something bigger so a custom post type plugin was created.


function BMPs() {

  $labels = array(
    'name'                => _x( 'BMPs', 'Post Type General Name', 'text_domain' ),
    'singular_name'       => _x( 'BMP', 'Post Type Singular Name', 'text_domain' ),
    'menu_name'           => __( 'BMPs', 'text_domain' ),
    'parent_item_colon'   => __( 'Parent BMP:', 'text_domain' ),
    'all_items'           => __( 'All BMPs', 'text_domain' ),
    'view_item'           => __( 'View BMPs', 'text_domain' ),
    'add_new_item'        => __( 'Add New BMP', 'text_domain' ),
    'add_new'             => __( 'New BMP', 'text_domain' ),
    'edit_item'           => __( 'Edit BMP', 'text_domain' ),
    'update_item'         => __( 'Update BMP', 'text_domain' ),
    'search_items'        => __( 'Search BMPs', 'text_domain' ),
    'not_found'           => __( 'No BMPs found', 'text_domain' ),
    'not_found_in_trash'  => __( 'No BMPs found in Trash', 'text_domain' ),
  );
  $rewrite = array(
    'slug'                => 'bmps',
    'with_front'          => true,
    'pages'               => true,
    'feeds'               => true,
  );
  $args = array(
    'label'               => __( 'BMP', 'text_domain' ),
    'description'         => __( 'BMP information pages', 'text_domain' ),
    'labels'              => $labels,
    'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
    'taxonomies'          => array( 'bmps', 'post_tag', 'category' ),
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 5,
    'menu_icon'           => '',
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'rewrite'             => $rewrite,
    'capability_type'     => 'post'
  );
  register_post_type( 'BMPs', $args );
  flush_rewrite_rules();

}

// Hook into the 'init' action
add_action( 'init', 'BMPs', 0 );

?>