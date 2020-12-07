<?php
global $adforest_theme, $template;
$page_template = basename($template);
if (!function_exists('adforest_footer_content_html')) {
    function adforest_footer_content_html() {
        global $adforest_theme;
        if (isset($adforest_theme['design_type']) && $adforest_theme['design_type'] == 'modern' && isset($adforest_theme['search_design']) && $adforest_theme['search_design'] == 'map' && is_page_template('page-search.php')) {       
        } else {
            $layout = 'default';
            if (isset($adforest_theme['footer_style'])) {
                $layout = $adforest_theme['footer_style'];
            }
            get_template_part('template-parts/layouts/footer', $layout);
        }
    }
}
do_action('adforestAction_footer_content', 'adforest_footer_content_html');
if (in_array('sb_framework/index.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    $rtl = 0;

    if (function_exists('icl_object_id')) {
        if (apply_filters('wpml_is_rtl', NULL)) {
            $rtl = 1;
        }
    } else {
        if (is_rtl()) {
            $rtl = 1;
        }
    }
    $is_single = 0;
    if (is_singular('ad_post')) {
        $is_single = 1;
    }
    $is_video_on = 0;
    if (isset($adforest_theme['sb_video_icon']) && $adforest_theme['sb_video_icon']) {
        $is_video_on = 1;
    }
    $theme_type = '0';
    if (isset($adforest_theme['design_type']) && $adforest_theme['design_type'] == 'modern') {
        $theme_type = '1';
        ?>

        <?php
    }
    $auto_slide = 1000;
    if (isset($adforest_theme['sb_auto_slide_time']) && $adforest_theme['sb_auto_slide_time'] != "") {
        $auto_slide = $adforest_theme['sb_auto_slide_time'];
    }
    $sb_profile_page = apply_filters('adforest_language_page_id', $adforest_theme['sb_profile_page']);
    $after_login_redirect = get_the_permalink($sb_profile_page);
    if (isset($_GET['u']) && $_GET['u'] != "") {
        $after_login_redirect = $_GET['u'];
    }
    $is_logged_in = 0;
    if (is_user_logged_in()) {
        $is_logged_in = 1;
    }
    $sb_sign_in_page = apply_filters('adforest_language_page_id', $adforest_theme['sb_sign_in_page']);
    $sb_packages_page = apply_filters('adforest_language_page_id', $adforest_theme['sb_packages_page']);
    $ajax_url = apply_filters('adforest_set_query_param', admin_url('admin-ajax.php'));
    $custom_theme_color = isset($adforest_theme['custom-theme-color']) && !empty($adforest_theme['custom-theme-color']) ? $adforest_theme['custom-theme-color'] : '#f58936';
    $custom_btn_hover_color = isset($adforest_theme['custom-btn-hover-color']) && !empty($adforest_theme['custom-btn-hover-color']) ? $adforest_theme['custom-btn-hover-color'] : '#f58936';
    $custom_btn_border_color = isset($adforest_theme['custom-btn-border-color']) && !empty($adforest_theme['custom-btn-border-color']) ? $adforest_theme['custom-btn-border-color'] : '#f58936';
    $sb_disable_menu = isset($adforest_theme['sb_disable_menu']) ? $adforest_theme['sb_disable_menu'] : false;

    $adforest_menu_display = 'yes';
    if ($sb_disable_menu) {
        $adforest_menu_display = 'no';
    }

    $sb_upload_limit_admin = isset($adforest_theme['sb_upload_limit']) && !empty($adforest_theme['sb_upload_limit']) && $adforest_theme['sb_upload_limit'] > 0 ? $adforest_theme['sb_upload_limit'] : 0;

    $user_upload_max_images = $sb_upload_limit_admin;

    if (is_user_logged_in()) {
        $current_user = get_current_user_id();
        if ($current_user) {
            update_user_meta($current_user, '_sb_last_login', time());
        }

        $user_packages_images = get_user_meta($current_user, '_sb_num_of_images', true);
        if (isset($user_packages_images) && $user_packages_images == '-1') {
            $user_upload_max_images = 'null';
        } else if (isset($user_packages_images) && $user_packages_images > 0) {
            $user_upload_max_images = $user_packages_images;
        } 
    }
    $adforest_ad_html = isset($adforest_theme['sb_ad_desc_html']) ? $adforest_theme['sb_ad_desc_html'] : false;
    ?>
   
        <input type="hidden" id="is_logged_in" value="<?php echo esc_attr($is_logged_in);?>" />
        <input type="hidden" id="auto_slide_time" value="<?php echo esc_attr($auto_slide);?>" />
        <input type="hidden" id="theme_type" value="<?php echo esc_attr($theme_type);?>" />
        <input type="hidden" id="is_rtl" value="<?php echo esc_attr($rtl);?>" />
        <input type="hidden" id="is_menu_display" value="<?php echo esc_attr($adforest_menu_display);?>" />
        <input type="hidden" id="is_single_ad" value="<?php echo esc_attr($is_single);?>" />
        <input type="hidden" id="is_video_on" value="<?php echo esc_attr($is_video_on);?>" />
        <input type="hidden" id="profile_page" value="<?php echo esc_url($after_login_redirect);?>" />
        <input type="hidden" id="login_page" value="<?php echo get_the_permalink($sb_sign_in_page);?>" />
        <input type="hidden" id="sb_packages_page" value="<?php echo get_the_permalink($sb_packages_page);?>" />
        <input type="hidden" id="theme_path" value="<?php echo trailingslashit(get_template_directory_uri());?>" />
        <input type="hidden" id="adforest_ajax_url" value="<?php echo adforest_returnEcho($ajax_url);?>" />
        <input type="hidden" id="_nonce_error" value="<?php echo __('There is something wrong with the security please check the admin panel.', 'adforest');?>" />
        <input type="hidden" id="adforest_ad_html" value="<?php echo adforest_returnEcho($adforest_ad_html);?>" />
        <input type="hidden" id="adforest_forgot_msg" value="<?php echo __('Password reset link sent to your email.', 'adforest');?>" />
        <input type="hidden" id="adforest_profile_msg" value="<?php echo __('Profile saved successfully.', 'adforest');?>" />
        <input type="hidden" id="adforest_max_upload_reach" value="<?php echo __('Maximum upload limit reached', 'adforest');?>" />
        <input type="hidden" id="not_logged_in" value="<?php echo __('You have been logged out.', 'adforest');?>" />
        <input type="hidden" id="sb_upload_limit" value="<?php echo esc_attr($user_upload_max_images);?>" />
        <input type="hidden" id="adforest_map_type" value="<?php echo esc_attr($adforest_theme['map-setings-map-type']);?>" />
        <input type="hidden" id="adforest_radius_type" value="<?php echo esc_attr($adforest_theme['search_radius_type']);?>" />
        <input type="hidden" id="facebook_key" value="<?php echo esc_attr($adforest_theme['fb_api_key']);?>" />
        <input type="hidden" id="google_key" value="<?php echo esc_attr($adforest_theme['gmail_api_key']);?>" />
        <input type="hidden" id="google_recaptcha_type" value="<?php echo esc_attr($adforest_theme['google-recaptcha-type']);?>" />
        <input type="hidden" id="google_recaptcha_site_key" value="<?php echo esc_attr($adforest_theme['google_api_key']);?>" />
        <input type="hidden" id="google_recaptcha_error_text" value="<?php echo esc_html__('Oops You are spammer ! or Check your Google reCaptcha keys.', 'adforest');?>" />
        <input type="hidden" id="no-result-found" value="<?php echo esc_html__('No results found', 'adforest');?>" />
        <input type="hidden" id="confirm_delete" value="<?php echo __('Are you sure to delete this?', 'adforest');?>" />
        <input type="hidden" id="confirm_update" value="<?php echo __('Are you sure to update this?', 'adforest');?>" />
        <input type="hidden" id="ad_updated" value="<?php echo __('Ad updated successfully.', 'adforest');?>" />
        <input type="hidden" id="ad_posted" value="<?php echo __('Ad Posted successfully.', 'adforest');?>" />
        <input type="hidden" id="redirect_uri" value="<?php echo esc_url($adforest_theme['redirect_uri']);?>" />
        <input type="hidden" id="select_place_holder" value="<?php echo __('Select an option', 'adforest');?>" />
        <input type="hidden" id="is_sticky_header" value="<?php echo esc_attr($adforest_theme['sb_sticky_header']);?>" />
        <input type="hidden" id="required_images" value="<?php echo __('Images are required.', 'adforest');?>" />
        <input type="hidden" id="ad_limit_msg" value="<?php echo __('Your package has been used or expired, please purchase now.', 'adforest');?>" />
        <input type="hidden" id="is_sub_active" value="1" />
        <input type="hidden" id="custom-theme-color" value="<?php echo esc_attr($custom_theme_color);?>" />
        <input type="hidden" id="custom-hover-color" value="<?php echo esc_attr($custom_btn_hover_color);?>" />
        <input type="hidden" id="custom-border-color" value="<?php echo esc_attr($custom_btn_border_color);?>" />
        <input type="hidden" id="sb-lang-code" value="<?php echo get_bloginfo('language');?>" />
        <?php
        $slider_item = 2;
        if (isset($adforest_theme['design_type']) && $adforest_theme['design_type'] == 'modern' && ($page_template == 'taxonomy-ad_cats.php' || $page_template == 'taxonomy-ad_country.php')) {

            $search_cat_page = isset($adforest_theme['search_cat_page']) && $adforest_theme['search_cat_page'] ? TRUE : FALSE;
            if ($search_cat_page) {
                $slider_item = 3;
            } else {
                $slider_item = 4;
            }
        } else if (isset($adforest_theme['design_type']) && $adforest_theme['design_type'] == 'modern' && !is_page_template('page-search.php') && !is_singular('ad_post') && !is_singular('page')) {
            $slider_item = 3;
        } else if (isset($adforest_theme['design_type']) && $adforest_theme['design_type'] == 'modern' && isset($adforest_theme['search_design']) && $adforest_theme['search_design'] == 'topbar' && is_page_template('page-search.php')) {

            $slider_item = 4;
        } else if (isset($adforest_theme['design_type']) && $adforest_theme['design_type'] == 'modern' && isset($adforest_theme['search_design']) && $adforest_theme['search_design'] == 'sidebar' && is_page_template('page-search.php')) {

            $slider_item = 3;
        } else if (isset($adforest_theme['design_type']) && $adforest_theme['design_type'] == 'modern' && isset($adforest_theme['search_design']) && $adforest_theme['search_design'] == 'map' && is_page_template('page-search.php')) {
            $slider_item = 2;
        } else if (isset($adforest_theme['design_type']) && $adforest_theme['design_type'] == 'modern' && is_singular('ad_post')) {
            $slider_item = 4;
        } else if (isset($adforest_theme['design_type']) && $adforest_theme['design_type'] == 'modern' && is_singular('page')) {
            $slider_item = 4;
        }

        $time_zones_val = isset($adforest_theme['bid_timezone']) && $adforest_theme['bid_timezone'] != '' ? $adforest_theme['bid_timezone'] : 'Etc/UTC';
        if (function_exists('adforest_timezone_list') && isset($adforest_theme['bid_timezone']) && $adforest_theme['bid_timezone'] != '') {
            $time_zones_val = adforest_timezone_list('', $adforest_theme['bid_timezone']);
            date_default_timezone_set($time_zones_val);
        }
        echo '<input type="hidden" id="sb-bid-timezone" value="' . $time_zones_val . '"/>';
        ?>
        <input type="hidden" id="slider_item" value="<?php echo esc_attr($slider_item);?>" />
        <?php
        $yes = 0;
        $not_time = '';

        if (isset($adforest_theme['msg_notification_on']) && isset($adforest_theme['communication_mode']) && ( $adforest_theme['communication_mode'] == 'both' || $adforest_theme['communication_mode'] == 'message' )) {
            $yes = $adforest_theme['msg_notification_on'];
            $not_time = $adforest_theme['msg_notification_time'];
        }

        $unread_msgs = ADFOREST_MESSAGE_COUNT; /* Message count define in header */
        ?>
        <input type="hidden" id="msg_notification_on" value="<?php echo esc_attr($yes);?>" />
        <input type="hidden" id="msg_notification_time" value="<?php echo esc_attr($not_time);?>" />
        <input type="hidden" id="is_unread_msgs" value="<?php echo esc_attr($unread_msgs);?>" />
        <?php } else { ?>
        <input type="hidden" id="is_sub_active" value="0" />
        <?php }

    $transparent_flag = false;
    if ($adforest_theme['sb_header'] == 'transparent-2' || $adforest_theme['sb_header'] == 'transparent-3' || $adforest_theme['sb_header'] == 'modern') {
        $transparent_flag = true;
    }
    $menu_color = '#000';
    if (isset($adforest_theme['sb_header']) && $transparent_flag && isset($adforest_theme['sb_menu_color']) && isset($adforest_theme['sb_menu_color_single'])) {
        $menu_color = is_singular('ad_post') ? $adforest_theme['sb_menu_color_single'] : $adforest_theme['sb_menu_color'];
    }
    $sb_static_logo = $adforest_theme['sb_site_logo']['url'];
    if (is_singular('ad_post')) {
        $page_template = 'single-ad_post.php';
        if (isset($adforest_theme['ad_layout_style_modern']) && $adforest_theme['ad_layout_style_modern'] == 5) {
            $sb_static_logo = $adforest_theme['sb_site_logo_for_single']['url'];
        }
    } else if (basename($template) == 'page-home.php') {
        $sb_static_logo = $adforest_theme['sb_site_logo_for_home']['url'];
    }

       /*$front_page = is_front_page() || is_home() ? '1' : '2';*/
        $front_page = '2';
        if (is_front_page() && is_home()) {
            $front_page = '1';
        } elseif (is_front_page()) {
            $front_page = '1';
        } elseif (is_home()) {
            $front_page = '2';
        } else {
            $front_page = '2';
        }

      $is_mobile = wp_is_mobile() ? 1 : 2;
    ?>
    <input type="hidden" id="sticky_sb_logo" value="<?php echo esc_url($adforest_theme['sb_site_logo_for_transparent']['url']);?>" />
    <input type="hidden" id="static_sb_logo" value="<?php echo esc_url($sb_static_logo);?>" />
    <input type="hidden" id="sb_header_type" value="<?php echo esc_attr($adforest_theme['sb_header']);?>" />
    <input type="hidden" id="sb_menu_color" value="<?php echo esc_attr($menu_color);?>" />
    <input type="hidden" id="sb_page_template" value="<?php echo esc_attr($page_template);?>" />
    <input type="hidden" id="sb_is_mobile" value="<?php echo esc_attr($is_mobile);?>" />
    <input type="hidden" id="sb_is_homepage" value="<?php echo esc_attr($front_page);?>" />
    <?php get_template_part('template-parts/linkedin', 'access');?>
    <?php get_template_part('template-parts/verification', 'logic');?>
    <?php get_template_part('template-parts/layouts/sell', 'button');?>
    <?php get_template_part('template-parts/layouts/scroll', 'up');?>
    <?php
    
    if( isset( $adforest_theme['sb_android_app'] ) && $adforest_theme['sb_android_app'] ){ 
        if (!function_exists('adforest_app_notifier_html')) {
            function adforest_app_notifier_html() {
                get_template_part('template-parts/app', 'notifier');
            }
        }
        do_action('adforestAction_app_notifier', 'adforest_app_notifier_html');
    }
?>
<?php echo adforest_returnEcho($adforest_theme['footer_js_and_css']); ?>
<?php wp_footer();?>
</body>
</html>