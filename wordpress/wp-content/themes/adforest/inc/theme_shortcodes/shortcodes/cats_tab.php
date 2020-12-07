<?php
/* ------------------------------------------------ */
/* Cats Tabs */
/* ------------------------------------------------ */
if (!function_exists('cats_tab_short')) {

    function cats_tab_short() {
        $grid_array;
        if (Redux::getOption('adforest_theme', 'design_type') == 'modern') {
            $grid_array = array(
                __('Select Layout Type', 'adforest') => '',
                __('Grid 1', 'adforest') => 'grid_1',
                __('Grid 2', 'adforest') => 'grid_2',
                __('Grid 3', 'adforest') => 'grid_3',
                __('Grid 4', 'adforest') => 'grid_4',
                __('Grid 5', 'adforest') => 'grid_5',
                __('Grid 6', 'adforest') => 'grid_6',
                __('Grid 7', 'adforest') => 'grid_7',
                __('Grid 8', 'adforest') => 'grid_8',
                __('Grid 9', 'adforest') => 'grid_9',
                __('Grid 10', 'adforest') => 'grid_10',
                __('List', 'adforest') => 'list',
            );
        } else {
            $grid_array = array(
                __('Select Layout Type', 'adforest') => '',
                __('Grid 1', 'adforest') => 'grid_1',
                __('Grid 2', 'adforest') => 'grid_2',
                __('Grid 3', 'adforest') => 'grid_3',
                __('List', 'adforest') => 'list',
                    )
            ;
        }
        $cat_array = array();
        $cat_array = apply_filters('adforest_ajax_load_categories', $cat_array, 'cat', 'no');
        vc_map(array(
            "name" => __("Categories - Tabs", 'adforest'),
            "base" => "cats_tab_short_base",
            "category" => __("Theme Shortcodes", 'adforest'),
            "params" => array(
                array(
                    'group' => __('Shortcode Output', 'adforest'),
                    'type' => 'custom_markup',
                    'heading' => __('Shortcode Output', 'adforest'),
                    'param_name' => 'order_field_key',
                    'description' => adforest_VCImage('cat-tab.png') . __('Ouput of the shortcode will be look like this.', 'adforest'),
                ),
                array(
                    "group" => __("Basic", "adforest"),
                    "type" => "dropdown",
                    "heading" => __("Category link Page", 'adforest'),
                    "param_name" => "cat_link_page",
                    "admin_label" => true,
                    "value" => array(
                        __('Search Page', 'adforest') => 'search',
                        __('Category Page', 'adforest') => 'category',
                    ),
                    'edit_field_class' => 'vc_col-sm-12 vc_column',
                ),
                array(
                    "group" => __("Basic", "adforest"),
                    "type" => "dropdown",
                    "heading" => __("Background Color", 'adforest'),
                    "param_name" => "section_bg",
                    "admin_label" => true,
                    "value" => array(
                        __('Select Background Color', 'adforest') => '',
                        __('White', 'adforest') => '',
                        __('Gray', 'adforest') => 'gray',
                    ),
                    'edit_field_class' => 'vc_col-sm-12 vc_column',
                    "std" => '',
                    "description" => __("Select background color.", 'adforest'),
                ),
                array(
                    "group" => __("Ads Settings", "adforest"),
                    "type" => "dropdown",
                    "heading" => __("Ads Type", 'adforest'),
                    "param_name" => "ad_type",
                    "admin_label" => true,
                    "value" => array(
                        __('Select Ads Type', 'adforest') => '',
                        __('Featured Ads', 'adforest') => 'feature',
                        __('Simple Ads', 'adforest') => 'regular',
                        __('Both', 'adforest') => 'both'
                    ),
                ),
                array(
                    "group" => __("Ads Settings", "adforest"),
                    "type" => "dropdown",
                    "heading" => __("Order By", 'adforest'),
                    "param_name" => "ad_order",
                    "admin_label" => true,
                    "value" => array(
                        __('Select Ads order', 'adforest') => '',
                        __('Oldest', 'adforest') => 'asc',
                        __('Latest', 'adforest') => 'desc',
                        __('Random', 'adforest') => 'rand'
                    ),
                ),
                array(
                    "group" => __("Ads Settings", "adforest"),
                    "type" => "dropdown",
                    "heading" => __("Layout Type", 'adforest'),
                    "param_name" => "layout_type",
                    "admin_label" => true,
                    "value" => $grid_array,
                ),
                array(
                    "group" => __("Ads Settings", "adforest"),
                    "type" => "dropdown",
                    "heading" => __("Ad limit for each category", 'adforest'),
                    "param_name" => "no_of_ads",
                    "admin_label" => true,
                    "value" => range(1, 500),
                ),
                array
                    (
                    'group' => __('Categories', 'adforest'),
                    'type' => 'param_group',
                    'heading' => __('Select Category', 'adforest'),
                    'param_name' => 'cats',
                    'value' => '',
                    'params' => array
                        ($cat_array)
                ),
            ),
        ));
    }
}

add_action('vc_before_init', 'cats_tab_short');
if (!function_exists('cats_tab_short_base_func')) {

    function cats_tab_short_base_func($atts, $content = '') {
        
         extract(shortcode_atts(array(
            'section_bg' => '',
            'cats' => '',
            'ad_type' => 'grid_1',
            'ad_order' => '',
            'layout_type' => 'grid_1',
            'no_of_ads' => '',
                        ), $atts));
        
        extract($atts);
        global $adforest_theme;
        $ads = new ads();
        $categories_html = '';
        if (isset($atts['cats'])) {
            if (isset($adforest_elementor) && $adforest_elementor) {
                $rows = $atts['cats'];
            } else {
                $rows = vc_param_group_parse_atts($atts['cats']);
                $rows = apply_filters('adforest_validate_term_type', $rows);
            }
            $ads_html = '';
            if (count($rows) > 0) {
                $i = 1;
                foreach ($rows as $row) {
                    $rand = rand(1234, 999999);
                    $cat_flag = false;
                    if (isset($adforest_elementor) && $adforest_elementor) {
                        if (isset($row) && $row != '') {
                            $cat_flag = true;
                            $cat_id = $row;
                        }
                    } else {
                        if (isset($row['cat'])) {
                            $cat_flag = true;
                            $cat_id = $row['cat'];
                        }
                    }
                    if ($cat_flag) {
                        $category = get_term($cat_id);
                        if (count((array) $category) == 0)
                            continue;
                        $count = $category->count;
                        $class = '';
                        $class2 = '';
                        if ($i == 1) {
                            $class = 'active';
                            $class2 = ' in active';
                            $i++;
                        }
                        $categories_html .= ' <li class="' . esc_attr($class) . '">
                                 <a href="#cat-' . $rand . '" data-toggle="tab">
                                    <h6>' . $category->name . '</h6>
                                 </a>
                              </li>';

                        $ads_html .= '<div class="tab-pane fade' . esc_attr($class2) . '" id="cat-' . $rand . '">
                                 <div class="row">';
                        $category1 = array(
                            array(
                                'taxonomy' => 'ad_cats',
                                'field' => 'term_id',
                                'terms' => $cat_id,
                            ),
                        );
                        $is_feature = '';
                        if ($ad_type == 'feature') {
                            $is_feature = array(
                                'key' => '_adforest_is_feature',
                                'value' => 1,
                                'compare' => '=',
                            );
                        } else if ($ad_type == 'both') {
                            $is_feature = '';
                        } else {
                            $is_feature = array(
                                'key' => '_adforest_is_feature',
                                'value' => 0,
                                'compare' => '=',
                            );
                        }
                        $is_active = array(
                            'key' => '_adforest_ad_status_',
                            'value' => 'active',
                            'compare' => '=',
                        );
                        $ordering = 'DESC';
                        $order_by = 'date';
                        if ($ad_order == 'asc') {
                            $ordering = 'ASC';
                        } else if ($ad_order == 'desc') {
                            $ordering = 'DESC';
                        } else if ($ad_order == 'rand') {
                            $order_by = 'rand';
                        }
                        $countries_location = '';
                        $countries_location = apply_filters('adforest_site_location_ads', $countries_location, 'search');
                        $args = array(
                            'post_type' => 'ad_post',
                            'post_status' => 'publish',
                            'posts_per_page' => $no_of_ads,
                            'meta_query' => array(
                                $is_feature,
                                $is_active,
                            ),
                            'tax_query' => array(
                                $category1,
                                $countries_location,
                            ),
                            'orderby' => $order_by,
                            'order' => $ordering,
                        );
                        $args = apply_filters('adforest_wpml_show_all_posts', $args);
                        $results = new WP_Query($args);
                        if ($results->have_posts()) {
                            while ($results->have_posts()) {
                                $results->the_post();
                                $function = "adforest_search_layout_$layout_type";
                                $ads_html .= $ads->$function(get_the_ID(), 4);
                            }
                        }
                        $ads_html .= '</div></div>';
                    }
                }
            }
            wp_reset_postdata();
        }
        return '<section class="latest-ads ' . $section_bg . '">
            <div class="container">
               <div class="row">
                  <div class="col-md-12 ">
                     <div class="panel with-nav-tabs panel-default">
                        <div class="panel-heading">
                           <ul class="nav nav-tabs">' . $categories_html . '</ul>
                        </div>
                        <div class="panel-body">
                           <div class="tab-content">' . $ads_html . '</div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>';
    }

}

if (function_exists('adforest_add_code')) {
    adforest_add_code('cats_tab_short_base', 'cats_tab_short_base_func');
}