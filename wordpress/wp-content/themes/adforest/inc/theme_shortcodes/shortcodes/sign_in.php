<?php
/* ------------------------------------------------ */
/* Sign In */
/* ------------------------------------------------ */
if (!function_exists('login_short')) {

    function login_short() {
        vc_map(array(
            "name" => __("Sign In", 'adforest'),
            "base" => "login_short_base",
            "category" => __("Theme Shortcodes", 'adforest'),
            "params" => array(
                adforest_generate_type(__('BG Color', 'adforest'), 'dropdown', 'sb_bg_color', __("Section background color", 'adforest'), "", array("Please select" => "", "Gray" => "bg-gray", "White" => "bg-white", "BG Image" => "bg_img")),
                adforest_generate_type(__('BG Image', 'adforest'), 'attach_image', 'bg_img', '', '', '', '', 'vc_col-sm-12 vc_column', array('element' => 'sb_bg_color', 'value' => 'bg_img')),
                adforest_generate_type(__('Section Title', 'adforest'), 'textfield', 'section_title'),
                // Making add more loop
                array
                    (
                    'group' => __('Features', 'adforest'),
                    'type' => 'param_group',
                    'heading' => __('Add Feature', 'adforest'),
                    'param_name' => 'features',
                    'value' => '',
                    'params' => array
                        (
                        adforest_generate_type(__('Image 80x80', 'adforest'), 'attach_image', 'image'),
                        adforest_generate_type(__('Title', 'adforest'), 'textfield', 'title'),
                        adforest_generate_type(__('Page Link', 'adforest'), 'vc_link', 'link'),
                        adforest_generate_type(__('Short Description', 'adforest'), 'textarea', 'description'),
                    )
                ),
            ),
        ));
    }

}

add_action('vc_before_init', 'login_short');
if (!function_exists('login_short_base_func')) {

    function login_short_base_func($atts, $content = '') {
        
         extract(shortcode_atts(array(
            'sb_bg_color' => '',
            'section_title' => '',
            'bg_img' => '',
            'features' => '',
                        ), $atts));
        extract($atts);

        if (!adforest_vc_forntend_edit() && !is_admin()) {
            adforest_user_logged_in();
        }
        $feature_arr = isset($atts['features']) && $atts['features'] != '' ? $atts['features'] : '';
        $features = '';
        if ($feature_arr != '') {


            if (isset($adforest_elementor) && $adforest_elementor) {
                $rows = ($atts['features']);
            } else {
                $rows = vc_param_group_parse_atts($atts['features']);
            }





            if (isset($rows) && $rows != '' && count($rows) > 0) {
                foreach ($rows as $row) {
                    $icon = '';

                    if (isset($adforest_elementor) && $adforest_elementor) {
                        $img_id = $row['image']['id'];
                    } else {
                        $img_id = $row['image'];
                    }



                    if (isset($img_id)) {
                        $img = wp_get_attachment_image_src($img_id, 'full');
                        if (isset($img) && $img != '' && isset($img[0]) && $img[0] != '') {
                            $icon = '<div class="features-icons">
                              <img src="' . $img[0] . '" alt="' . __('image', 'adforest') . '">
                           </div>';
                        }
                    }
                    $title = '';

                    if (isset($row['title'])) {
                        if (isset($row['link'])) {

                            if (isset($adforest_elementor) && $adforest_elementor) {

                                $link_attr = '';
                                $btn_args = array(
                                    'btn_key' => $row['link'],
                                    'adforest_elementor' => $adforest_elementor,
                                    'btn_class' => '',
                                    'iconBefore' => '',
                                    'iconAfter' => '',
                                    'onlyAttr' => true,
                                    'titleText' => 'TEST',
                                );
                                $link_attr = apply_filters('adforest_elementor_url_field', $link_attr, $btn_args);

                                $title = '<h3><a '.$link_attr.'>' . $row['title'] . '</a></h3>';
                            } else {
                                $res = adforest_extarct_link($row['link']);
                                $title = '<h3><a href="' . $res['url'] . '" title="' . $res['title'] . '" target="' . $res['target'] . '">' . $row['title'] . '</a></h3>';
                            }
                        } else {
                            $title = '<h3>' . $row['title'] . '</h3>';
                        }
                    }
                    $desc = '';
                    if (isset($row['description'])) {
                        $desc = '<p>' . $row['description'] . '</p>';
                    }
                    $features .= '<div class="features">' . $icon . '<div class="features-text">' . $title . '' . $desc . '</div></div>';
                }
            }
        }



        global $adforest_theme;
        $social_login = '';
        if ($adforest_theme['fb_api_key'] != "") {
            $social_login .= '<div class="col-md-12 col-xs-12 col-sm-12"><a class="btn btn-block btn-social btn-facebook" onclick="hello(\'facebook\').login(' . "{
                                    scope : 'email',
                                    }" . ')">
                          <img src="' . get_template_directory_uri() . '/images/facebook.png"  alt="' . esc_html__('facebook logo', 'adforest') . '" />' . __('Facebook', 'adforest') . '
                          </a></div>';
        }
        if ($adforest_theme['gmail_api_key'] != "") {
            $social_login .= '<div class="col-md-12 col-xs-12 col-sm-12"><a class="btn btn-block btn-social btn-google" onclick="hello(\'google\').login(' . "{scope : 'email'}" . ')">
                                <img src="' . get_template_directory_uri() . '/images/google.png"  alt="' . esc_html__('google logo', 'adforest') . '" />' . __('sign in with google', 'adforest') . '
                              </a></div>';
        }

        $social_linked = (isset($social_linked) && $social_linked != "") ? $social_linked : __("Signin With LinkedIn", "adforest");
        $linkedin_api_key = '';
        if ((isset($adforest_theme['adforest_linkedin_api_key'])) && $adforest_theme['adforest_linkedin_api_key'] != '' && (isset($adforest_theme['adforest_linkedin_api_secret'])) && $adforest_theme['adforest_linkedin_api_secret'] != '' && (isset($adforest_theme['adforest_redirect_uri'])) && $adforest_theme['adforest_redirect_uri'] != '') {
            $linkedin_api_key = ($adforest_theme['adforest_linkedin_api_key']);
            $linkedin_secret_key = ($adforest_theme['adforest_linkedin_api_secret']);
            $redirect_uri = ($adforest_theme['adforest_redirect_uri']);
            $linkedin_url = 'https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id=' . $linkedin_api_key . '&redirect_uri=' . $redirect_uri . '&state=popup&scope=r_liteprofile r_emailaddress';
            $social_login .= '<div class="col-md-12 col-xs-12 col-sm-12"><a href="' . esc_url($linkedin_url) . '" class="btn-social btn-linkedIn btn-block"><i class="fa fa-linkedin-square"></i><span>' . ($social_linked) . '</span></a></div>';
        }

        if ($social_login != '') {
            $social_login .= '<input type="hidden" id="sb-social-login-nonce" value="' . wp_create_nonce('sb_social_login_nonce') . '" />';
        }



        $get_res = adforest_bg_func($sb_bg_color, $bg_img);
        $class = $get_res['color'];
        $css = '';
        if ($get_res['url'] != "")
            $css = 'style="background: #fff url(' . $get_res['url'] . ') repeat-x scroll center bottom;padding-bottom: 120px !important;"';

        $authentication = new authentication();
        $code = time();
        $_SESSION['sb_nonce'] = $code;
        $if_social_login_enable = '';
        if ($social_login != "") {
            $if_social_login_enable = '<hr>
						<div class="center-line">' . __('OR', 'adforest') . '</div>
						<hr>';
        }
        return ' <div class="main-content-area clearfix ' . $sb_bg_color . '">
         <section class="section-padding error-page ' . $class . '" ' . $css . '>
            <div class="container">
               <div class="row">
                  <div class="col-md-5 col-md-push-7 col-sm-12 col-xs-12">
                     <div class="form-grid">
						<div class="row">' . $social_login . '</div>
						' . $if_social_login_enable . '
					 	' . $authentication->adforest_sign_in_form($code) . '
                     </div>
                  </div>
                 
                  <div class="col-md-7  col-md-pull-5  col-sm-12 col-xs-12">
                     <div class="heading-panel">
                        <h3 class="main-title text-left">' . $section_title . '</h3>
                     </div>
                     <div class="content-info">
					 	' . $features . '
                        <span class="arrowsign hidden-sm hidden-xs">
						<img src="' . trailingslashit(get_template_directory_uri()) . 'images/arrow.png" alt="' . __('image', 'adforest') . '">
						</span>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </div>';
    }

}

if (function_exists('adforest_add_code')) {
    adforest_add_code('login_short_base', 'login_short_base_func');
}

/*
 * load modal in footer
 */

$authentication = new authentication();

$popup_args = array(
    'adforest_forgot_form' => $authentication->adforest_forgot_password_form(),
);

add_action('wp_footer', function () use ($popup_args) {

    extract(shortcode_atts(array(
        'adforest_forgot_form' => '',
                    ), $popup_args));
    if (!is_user_logged_in()) {
        ?>
        <div class="custom-modal">
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="pass-modal-title"><?php echo __('Forgot Your Password ?', 'adforest') ?></div>
                        </div>
                        <?php echo adforest_returnEcho($adforest_forgot_form); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}, 10, 1);
