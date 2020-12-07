<?php

global $adforest_theme;

$adforest_theme = get_option('adforest_theme');

/*
 * Theme Settings.
 * Make theme available for translation.
 * Translations can be filed in the /languages/ directory.
 * If you're building a theme based on Adforest, use a find and replace
 * to change ''rane to the name of your theme in all the template files.
 */
load_theme_textdomain('adforest', trailingslashit(get_template_directory()) . 'languages/');
// Content width
if (!isset($content_width)) {
    $content_width = 600;
}

add_action('adforestAction_header_content', 'adforest_header_content_html');
add_action('adforestAction_footer_content', 'adforest_footer_content_html');
add_action('adforestAction_app_notifier', 'adforest_app_notifier_html');
//WooCommrce
add_theme_support('woocommerce');
// Add default posts and comments RSS feed links to head.
add_theme_support('automatic-feed-links');

add_theme_support('wc-product-gallery-zoom');
add_theme_support('wc-product-gallery-lightbox');
add_theme_support('wc-product-gallery-slider');



/*
 * Let WordPress manage the document title.
 * By adding theme support, we declare that this theme does not use a
 * hard-coded <title> tag in the document head, and expect WordPress to
 * provide it for us.
 */
add_theme_support('title-tag');
// Theme editor style
add_editor_style('editor.css');
/*
 * Enable support for Post Thumbnails on posts and pages.
 *
 * @link https://developer.wordpress.org/themes/functionality/featured-SB_TAMEER_IMAGES-post-thumbnails/
 */
$crop_ad_images = isset($adforest_theme['crop_ad_images']) && $adforest_theme['crop_ad_images'] == false ? false : true;

add_theme_support('post-thumbnails', array('post', 'project'));

add_image_size('adforest-single-post', 760, 410, $crop_ad_images);
add_image_size('adforest-category', 400, 300, $crop_ad_images);
add_image_size('adforest-single-small', 80, 80, $crop_ad_images);
add_image_size('adforest-single-small-50', 50, 50, $crop_ad_images);
add_image_size('adforest-ad-thumb', 120, 63, $crop_ad_images);
add_image_size('adforest-ad-related', 313, 234, $crop_ad_images);
add_image_size('adforest-user-profile', 300, 300, $crop_ad_images);
add_image_size('adforest-ad-country', 250, 160, $crop_ad_images);

add_image_size('adforest-shop-thumbnail', 230, 230, $crop_ad_images);
add_image_size('adforest-shop-home', 265, 350, $crop_ad_images);
add_image_size('adforest-shop-gallery-main', 350, 350, $crop_ad_images);
add_image_size('adforest-shop-gallery', 110, 110, $crop_ad_images);
add_image_size('adforest-shop-gallery', 250, 250, $crop_ad_images);

/**
 * crop sizes for new home pages
 */

add_image_size('adforest-ads-medium', 169, 127, $crop_ad_images);
add_image_size('adforest-location-large', 370, 560, $crop_ad_images);
add_image_size('adforest-location-wide', 750, 270, $crop_ad_images);
add_image_size('adforest-location-grid', 360, 252, $crop_ad_images);
add_image_size('adforest-ad-small', 94, 102, $crop_ad_images);
add_image_size('adforest-ad-small-2', 180, 170, $crop_ad_images);
add_image_size('adforest-shop-book', 90, 147, $crop_ad_images);




/* Adding image sizes*/
//add_filter( 'intermediate_image_sizes_advanced','adforest_set_thumbnail_size_by_post_type', 10);
if( !function_exists('adforest_set_thumbnail_size_by_post_type'))
{
    function adforest_set_thumbnail_size_by_post_type( $sizes ) {

        global $adforest_theme;
        $crop_ad_images = isset($adforest_theme['crop_ad_images']) && $adforest_theme['crop_ad_images'] == false ? false : true;
        global $post;
        $post_type = get_post_type($_REQUEST['post_id']);

        if($post_type == 'ad_post')
        {
            $sizes['adforest-single-post'] = array( 'width' => 760, 'height' => 410, 'crop' => $crop_ad_images  );
            $sizes['adforest-category'] = array( 'width' => 400, 'height' => 300, 'crop' => $crop_ad_images  );
            $sizes['adforest-single-small'] = array( 'width' => 80, 'height' => 80, 'crop' => $crop_ad_images  );
            $sizes['adforest-single-small-50'] = array( 'width' => 50, 'height' => 50, 'crop' => $crop_ad_images  );
            $sizes['adforest-ad-thumb'] = array( 'width' => 120, 'height' => 63, 'crop' => $crop_ad_images  );
            $sizes['adforest-ad-related'] = array( 'width' => 313, 'height' => 234, 'crop' => $crop_ad_images  );
            $sizes['adforest-ads-medium'] = array( 'width' => 169, 'height' => 127, 'crop' => $crop_ad_images  );
            $sizes['adforest-ad-small'] = array( 'width' => 94, 'height' => 102, 'crop' => $crop_ad_images  );
            $sizes['adforest-ad-small-2'] = array( 'width' => 180, 'height' => 170, 'crop' => $crop_ad_images  );

            $sizes['adforest-app-thumb'] = array( 'width' => 400, 'height' => 250, 'crop' => $crop_ad_images  );
            $sizes['adforest-app-full'] = array( 'width' => 700, 'height' => 400, 'crop' => $crop_ad_images  );

        }
        else if($post_type == 'product')
        {
                $sizes['adforest-shop-thumbnail'] = array( 'width' => 230, 'height' => 230, 'crop' => $crop_ad_images  );
                $sizes['adforest-shop-home'] = array( 'width' => 264, 'height' => 350, 'crop' => $crop_ad_images  );
                $sizes['adforest-shop-gallery-main'] = array( 'width' => 350, 'height' => 350, 'crop' => $crop_ad_images  );
                $sizes['adforest-shop-gallery'] = array( 'width' => 110, 'height' => 110, 'crop' => $crop_ad_images  );
                $sizes['adforest-shop-gallery'] = array( 'width' => 250, 'height' => 250, 'crop' => $crop_ad_images  );
                $sizes['adforest-shop-book'] = array( 'width' => 90, 'height' => 147, 'crop' => $crop_ad_images  );

        }
        else if($post_type == 'post')
        {

        }
        else if($post_type == 'page')
        {

        }                
        else
        {

                $sizes['adforest-user-profile'] = array( 'width' => 300, 'height' => 300, 'crop' => $crop_ad_images  );
                $sizes['adforest-ad-country'] = array( 'width' => 250, 'height' => 160, 'crop' => $crop_ad_images  );
                $sizes['adforest-location-large'] = array( 'width' => 370, 'height' => 560, 'crop' => $crop_ad_images  );
                $sizes['adforest-location-wide'] = array( 'width' => 750, 'height' => 270, 'crop' => $crop_ad_images  );

                //If api plugin exists
                if(true)
                {
                    $sizes['adforest-andriod-profile'] = array( 'width' => 450, 'height' => 450, 'crop' => $crop_ad_images  );
                    $sizes['adforest-category'] = array( 'width' => 400, 'height' => 300, 'crop' => $crop_ad_images  );
                    $sizes['adforest-location-grid'] = array( 'width' => 360, 'height' => 252, 'crop' => $crop_ad_images  );
                }
                
        }

        return $sizes;
    }
}


/* This theme uses wp_nav_menu() in one location. */
register_nav_menus(array('main_menu' => esc_html__('adforest Primary Menu', 'adforest'),));
register_nav_menus(array('footer_main_menu' => esc_html__('adforest footer-6 , footer-7 Menu', 'adforest'),));

/*
 * Switch default core markup for search form, comment form, and comments
 * to output valid HTML5.
 */
add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption',));

/*
 * Enable support for Post Formats.
 * See https://developer.wordpress.org/themes/functionality/post-formats/
 */

/* Set up the WordPress core custom background feature. */
add_theme_support('custom-background', apply_filters('adforest_custom_background_args', array(
    'default-color' => 'ffffff',
    'default-image' => '',
)));

if (in_array('js_composer/js_composer.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    if (function_exists('vc_disable_frontend')) {
        /* vc_disable_frontend(); */
    }
}

// Register side bar for widgets
add_action('widgets_init', 'sb_themes_sidebar_widgets_init');
if (!function_exists('sb_themes_sidebar_widgets_init')) {

    function sb_themes_sidebar_widgets_init() {
        register_sidebar(array(
            'name' => esc_html__('adforest Sidebar', 'adforest'),
            'id' => 'sb_themes_sidebar',
            'before_widget' => '<div class="widget widget-content"><div id="%1$s">',
            'after_widget' => '</div></div>',
            'before_title' => '<div class="widget-heading"><h4 class="panel-title"><span>',
            'after_title' => '</span></h4></div>'
        ));
        register_sidebar(array(
            'name' => esc_html__('adforest Grid Sidebar', 'adforest'),
            'id' => 'sb_themes_grid_sidebar',
            'before_widget' => '<div class="widget widget-content"><div id="%1$s">',
            'after_widget' => '</div></div>',
            'before_title' => '<div class="widget-heading"><h4 class="panel-title"><span>',
            'after_title' => '</span></h4></div>'
        ));
        register_sidebar(array(
            'name' => esc_html__('Ads Search', 'adforest'),
            'id' => 'adforest_search_sidebar',
            'before_widget' => '<div class="panel panel-default sb-default-widget">',
            'after_widget' => '</div>',
            'before_title' => '<div class="panel-heading"><h4 class="panel-title">',
            'after_title' => '</h4></div>'
        ));
        register_sidebar(array(
            'name' => esc_html__('Single Ad Top', 'adforest'),
            'id' => 'adforest_ad_sidebar_top',
            'before_widget' => '<div class="widget">',
            'after_widget' => '</div></div>',
            'before_title' => '<div class="widget-heading"><div class="panel-title"><span>',
            'after_title' => '</span></div></div><div class="widget-content saftey">'
        ));
        register_sidebar(array(
            'name' => esc_html__('Single Ad Bottom', 'adforest'),
            'id' => 'adforest_ad_sidebar_bottom',
            'before_widget' => '<div class="widget">',
            'after_widget' => '</div></div>',
            'before_title' => '<div class="widget-heading"><div class="panel-title"><span>',
            'after_title' => '</span></div></div><div class="widget-content saftey">'
        ));
        register_sidebar(array(
            'name' => esc_html__('AdForest Woo-Commerce Sidebar', 'adforest'),
            'id' => 'adforest_woocommerce_widget',
            'before_widget' => '<div class="widget %2$s">',
            'after_widget' => '</div></div>',
            'before_title' => '<div class="widget-heading"><div class="panel-title"><a>',
            'after_title' => '</a></div></div><div class="widget-content saftey">'
        ));

        register_sidebar(array(
            'name' => esc_html__('TechForest Ajax Section - Sidebar', 'adforest'),
            'id' => 'adforest_tech_ajax_section',
            'before_widget' => '<div class="widget tech-section-widget">',
            'after_widget' => '</div></div>',
            'before_title' => '<div class="widget-heading tech-section-widget-heading"><div class="panel-title"><a>',
            'after_title' => '</a></div></div><div class="widget-content  tech-section-widget-content">'
        ));


        register_sidebar(array(
            'name' => esc_html__('Category Search - Sidebar', 'adforest'),
            'id' => 'adforest_cat_search',
            'before_widget' => '<div class="panel panel-default sb-default-widget">',
            'after_widget' => '</div>',
            'before_title' => '<div class="panel-heading"><h4 class="panel-title">',
            'after_title' => '</h4></div>'
        ));

        register_sidebar(array(
            'name' => esc_html__('Location Search - Sidebar', 'adforest'),
            'id' => 'adforest_location_search',
            'before_widget' => '<div class="panel panel-default sb-default-widget">',
            'after_widget' => '</div>',
            'before_title' => '<div class="panel-heading"><h4 class="panel-title">',
            'after_title' => '</h4></div>'
        ));
    }

}

/*
    $typography_body  = $start_tags;
    $typography_body  .= 'Color: '       . $adforest_theme['adf-typography-body']['color'];
    $typography_body  .= 'Font style: '  . $adforest_theme['adf-typography-body']['font-style'];
    $typography_body  .= 'Font family: ' . $adforest_theme['adf-typography-body']['font-family'];
    $typography_body  .= 'Google: '      . $adforest_theme['adf-typography-body']['google'];
    $typography_body  .= 'Font size: '   . $adforest_theme['adf-typography-body']['font-size'];
    $typography_body  .= 'Line height: ' . $adforest_theme['adf-typography-body']['line-height'];
    $typography_body  .= $end_tags;
*/

/*/*//*
function adforest_typo_keyVals($css_key = '', $css_val = '')
{
    $return = '';
    if(isset($css_val) && $css_val != "" && $css_key != "")
    {
         $return = "$css_key: $css_val;";
    }
    return  $return;
}


function adforest_typo_keyValsStyle($start_tags = '', $end_tags = '', $args = '')
{
    $return_css_attr = '';
    
    if(isset($args) && count($args) > 0)
    {
        $return_css_attr .= $start_tags;
        foreach ($args as $key => $value) 
        {
            $return_css_attr .= ($value != "" ) ? "$key : $value; " : '';
        }
        $return_css_attr .= $end_tags;
    }
    
    return  $return_css_attr;
}


function adforest_type_things() 
{
    /*wp_enqueue_style( 'theme_custom_css', get_template_directory_uri() . '/css/custom_style.css' );* /
    global $adforest_theme;

    //wp_register_style( 'adforest-theme-typography', false );
    //wp_enqueue_style( 'adforest-theme-typography' );

    $typography_body = '';

    if(isset($adforest_theme['adf-typography-body'])){
        $adf_opt_name   = $adforest_theme['adf-typography-body'];
        $start_tags = 'body{';
        $end_tags   = '}';

        $typography_body = adforest_typo_keyValsStyle($start_tags, $end_tags, $adforest_theme['adf-typography-body']);

        /*$typography_body  = $start_tags;
        $typography_body  .= adforest_typo_keyVals('color',$adf_opt_name['color']); 
        $typography_body  .= adforest_typo_keyVals('font-style',$adf_opt_name['font-style']);
        $typography_body  .= adforest_typo_keyVals('font-family',$adf_opt_name['font-family']);
        $typography_body  .= adforest_typo_keyVals('google',$adf_opt_name['google']);
        $typography_body  .= adforest_typo_keyVals('font-size',$adf_opt_name['font-size']);
        $typography_body  .= adforest_typo_keyVals('line-height',$adf_opt_name['line-height']);
        $typography_body  .= $end_tags;*/

  //  }

    //wp_add_inline_style( 'adforest-theme-typography', $typography_body );

//}

//add_action('wp_enqueue_scripts', 'adforest_type_things');

