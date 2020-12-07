<?php

/* ------------------------------------------------ */
/* Search Stylish */
/* ------------------------------------------------ */
if (!function_exists('search_stylish_short')) {

    function search_stylish_short() {

        $cat_array = array();

        $cat_array = apply_filters('adforest_ajax_load_categories', $cat_array, 'cat');
        vc_map(array(
            "name" => __("Search - Stylish", 'adforest'),
            "base" => "search_stylish_short_base",
            "category" => __("Theme Shortcodes", 'adforest'),
            "params" => array(
                array(
                    'group' => __('Shortcode Output', 'adforest'),
                    'type' => 'custom_markup',
                    'heading' => __('Shortcode Output', 'adforest'),
                    'param_name' => 'order_field_key',
                    'description' => adforest_VCImage('search-stylish.png') . __('Ouput of the shortcode will be look like this.', 'adforest'),
                ),
                array(
                    "group" => __("Basic", "adforest"),
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Section Title", 'adforest'),
                    "param_name" => "section_title",
                ),
                array(
                    "group" => __("Basic", "adforest"),
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Minimum Price", 'adforest'),
                    "param_name" => "pricing_start",
                ),
                array(
                    "group" => __("Basic", "adforest"),
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Maximum Price", 'adforest'),
                    "param_name" => "pricing_end",
                ),
                apply_filters('adforest_admin_category_load_field', array()),
                array
                    (
                    'group' => __('Categories', 'adforest'),
                    'type' => 'param_group',
                    'heading' => __('Select Category ( All or Selective )', 'adforest'),
                    'param_name' => 'cats',
                    'value' => '',
                    'dependency' => array(
                        'element' => 'cat_frontend_switch',
                        'value' => array(''),
                    ),
                    'params' => array
                        ($cat_array)
                ),
            ),
        ));
    }

}

add_action('vc_before_init', 'search_stylish_short');
if (!function_exists('search_stylish_short_base_func')) {

    function search_stylish_short_base_func($atts, $content = '') {
        
        extract(shortcode_atts(array(
            'section_title' => '',
            'section_tag_line' => '',
            'pricing_start' => '',
            'pricing_end' => '',
            'cats' => '',
                        ), $atts));
        extract($atts);

        global $adforest_theme;


        $cats = false;
        $cats_html = '';

        $jax_cat_class = '';
        if (isset($atts['cat_frontend_switch']) && $atts['cat_frontend_switch'] == 'ajax_based') {
            $jax_cat_class = 'sb-load-ajax-cats ';
        } else {


            if (isset($adforest_elementor) && $adforest_elementor) {
                $rows = ($atts['cats']);
            } else {
               $rows = vc_param_group_parse_atts($atts['cats']);
            $rows = apply_filters('adforest_validate_term_type', $rows); 
            }



            
            if (count($rows) > 0) {
                $cats_html .= '';
                foreach ($rows as $row) {
                    
                    if (isset($adforest_elementor) && $adforest_elementor) {
                        $cat_idd = $row;
                    }else{
                        $cat_idd = $row['cat']; 
                    }
                    
                    
                    
                    if (isset($cat_idd)) {
                        if ($cat_idd == 'all') {
                            $cats = true;
                            $cats_html = '';
                            break;
                        }
                        $term = get_term($cat_idd, 'ad_cats');
                        $cats_html .= '<option value="' . $cat_idd . '">' . $term->name . '</option>';
                    }
                }

                if ($cats) {

                    if (isset($adforest_theme['display_taxonomies']) && $adforest_theme['display_taxonomies'] == 'hierarchical') {
                        $args = array(
                            'type' => 'html',
                            'taxonomy' => 'ad_cats',
                            'tag' => 'option',
                            'parent_id' => 0,
                        );
                        $cats_html = apply_filters('adforest_tax_hierarchy', $cats_html, $args);
                    } else {
                        $args = array('hide_empty' => 0);
                        $args = apply_filters('adforest_wpml_show_all_posts', $args); // for all lang texonomies
                        $ad_cats = get_terms('ad_cats', $args);
                        foreach ($ad_cats as $cat) {
                            $cats_html .= '<option value="' . $cat->term_id . '">' . $cat->name . '</option>';
                        }
                    }
                }
            }
        }



        wp_enqueue_script('price-slider-custom', trailingslashit(get_template_directory_uri()) . 'js/price_slider_shortcode.js', array(), false, true);

        $price_html = '<input type="hidden" id="min_price" value="' . esc_attr($pricing_start) . '" />
          <input type="hidden" id="max_price" value="' . esc_attr($pricing_end) . '" />
          <input type="hidden" name="min_price" id="min_selected" value="" />
          <input type="hidden" name="max_price" id="max_selected" value="" />
';
        $sb_search_page = apply_filters('adforest_language_page_id', $adforest_theme['sb_search_page']);
        return '<section class="search-2">
         <div class="container">
            <div class="col-md-12 col-sm-12 col-xs-12 no-padding">
               <div class="search-title">' . $section_title . '</div>
            </div>
            <div class="row">
               <form method="get" action="' . urldecode(get_the_permalink($sb_search_page)) . '">
			   		' . $price_html . '
                  <div class="col-md-3 col-xs-12 col-sm-3">
					<select class="' . $jax_cat_class . 'category form-control" name="cat_id" data-placeholder="' . __('Select Category', 'adforest') . '">
					<option label="' . __('Select Category', 'adforest') . '" value="">' . __('Select Category', 'adforest') . '</option>
				  		' . $cats_html . '
					</select>	
                  </div>
                  <!-- Search Field -->
                  <div class="col-md-3 col-xs-12 col-sm-3">
                     <input type="text" class="form-control" autocomplete="off" name="ad_title" placeholder="' . __('What Are You Looking For...', 'adforest') . '"  /> 
                  </div>
                  <div class="col-md-3 col-xs-12 col-sm-3">
                     <span class="price-slider-value">' . __('Price', 'adforest') . ' (' . $adforest_theme['sb_currency'] . ') <span id="price-min"></span> - <span id="price-max"></span></span>
                     <div id="price-slider"></div>
                  </div>
                  ' . apply_filters('adforest_form_lang_field', false) . '
                  <div class="col-md-3 col-xs-12 col-sm-3">
                     <button type="submit" class="btn btn-light">' . __('Search', 'adforest') . '</button>
                  </div>
               </form>
            </div>
         </div>
      </section>';
    }

}

if (function_exists('adforest_add_code')) {
    adforest_add_code('search_stylish_short_base', 'search_stylish_short_base_func');
}