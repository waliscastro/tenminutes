<?php
/* Ads Layout */
extract(shortcode_atts(array('cats' => '', 's_title' => '', 'ad_type' => '', 'layout_type' => '', 'ad_order' => '', 'no_of_ads' => '',), $atts));

$cats = array();
$rows = array();

if (isset($adforest_elementor) && $adforest_elementor) {
    
} else {
    
    if (isset($atts['cats']) && $atts['cats'] != '') {
        $rows = vc_param_group_parse_atts($atts['cats']);
        $rows = apply_filters('adforest_validate_term_type', $rows);
    }

    if (isset($rows) && $rows != '' && is_array($rows) && count($rows) > 0) {
        foreach ($rows as $row) {
            if (isset($row['cat'])) {
                if ($row['cat'] != 'all') {
                    $cats[] = $row['cat'];
                }
            }
        }
    }
}

$is_all = false;

$category = '';
if (isset($cats) && !empty($cats) && count($cats) > 0) {
    $category = array('taxonomy' => 'ad_cats', 'field' => 'term_id', 'terms' => $cats);
}

$is_feature = '';
if ($ad_type == 'feature') {
    $is_feature = array('key' => '_adforest_is_feature', 'value' => 1, 'compare' => '=',);
} else if ($ad_type == 'both') {
    $is_feature = '';
} else {
    $is_feature = array('key' => '_adforest_is_feature', 'value' => 0, 'compare' => '=',);
}

$is_active = array('key' => '_adforest_ad_status_', 'value' => 'active', 'compare' => '=',);

$ordering = 'DESC';
$order_by = 'date';
if ($ad_order == 'asc') {
    $ordering = 'ASC';
} else if ($ad_order == 'desc') {
    $ordering = 'DESC';
} else if ($ad_order == 'rand') {
    $order_by = 'rand';
}

$args = array(
    'post_type' => 'ad_post',
    'post_status' => 'publish',
    'posts_per_page' => $no_of_ads,
    'orderby' => $order_by,
    'order' => $ordering,
    'meta_query' => array($is_feature, $is_active,),
);

if ($category != '') {
    $args['tax_query'] = array($category);
}

$args = apply_filters('adforest_wpml_show_all_posts', $args);
$args = apply_filters('adforest_site_location_ads', $args, 'ads');

$ads = new ads();
$html = '';


if ($layout_type == '') {
    $layout_type = 'grid_1';
}
//echo '<pre>';
//print_r($args);
//echo '</pre>';

global $adforest_theme;
if ($layout_type == 'slider') {
    $html = $ads->adforest_get_ads_grid_slider($args, $s_title, 4);
} else if (isset($modern_slider) && $modern_slider) {
    $results = new WP_Query($args);
    if ($results->have_posts()) {
        while ($results->have_posts()) {
            $results->the_post();
            $pid = get_the_ID();
            $html .= '<div class="item">';
            $function = "adforest_search_layout_$layout_type";
            $html .= $ads->$function($pid, 12, 12);
            $html .= '</div>';
        }
        wp_reset_postdata();
    }
} else {
    $results = new WP_Query($args);
    $layouts = array('list_1', 'list_2', 'list_3');
    if ($results->have_posts()) {
        $type = $layout_type;
        $col = 6;
        if (isset($no_title)) {
            $col = 4;
        }
        if (isset($adforest_theme['design_type']) && $adforest_theme['design_type'] == 'modern') {
            $col = 3;
        }
        if (in_array($layout_type, $layouts)) {
            require trailingslashit(get_template_directory()) . "template-parts/layouts/ad_style/search-layout-list.php";
        } else if ($layout_type == 'list') {
            $list_html = '';
            while ($results->have_posts()) {
                $results->the_post();
                $pid = get_the_ID();
                $list_html .= $ads->adforest_search_layout_list($pid);
            }
            $out = '';
            //$out .= '<div class="posts-masonry">';
            $out .= '<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12"><ul class="list-unstyled"> ' . $list_html . ' </ul></div>';
            //$out .= '</div>';
            $out .= '<div class="clearfix"></div>';
        } else {
            require trailingslashit(get_template_directory()) . "template-parts/layouts/ad_style/search-layout-grid.php";
        }
        wp_reset_postdata();
        $heading = '';
        if ($s_title != "") {
            $heading = '<div class="heading-panel"><div class="col-xs-12 col-md-12 col-sm-12"><h3 class="main-title text-left"> ' . $s_title . ' </h3></div></div>';
        }

        $css = '';
        if (isset($no_title)) {
            $heading = ''; 
            $css = 'style="box-shadow: 0px 0px 0px 0px;"';
        }
        $cur_cls = '';
        if (isset($cls)) {
            $cur_cls = $cls;
        } else {
            $html = '<div class="' . esc_attr($cur_cls) . '" ' . $css . ' >' . $heading . '<div class="col-md-12 col-xs-12 col-sm-12"><div class="row">' . $out . ' </div></div></div>';
        }
    }
}