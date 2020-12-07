<?php
if (!class_exists('adforest_search_condition')) 
{
class adforest_search_condition extends WP_Widget {
use adforest_reuse_functions;
/* Register widget with WordPress. */
function __construct() {
    $widget_ops = array(
        'classname' => 'adforest_search_conidtion',
        'description' => __('Only for search and single ad sidebar.', 'adforest'),
    );
    parent::__construct(false, __('Ad Condition', 'adforest'), $widget_ops);
}

/**
 * Front-end display of widget.
 *
 * @see WP_Widget::widget()
 *
 * @param array $args     Widget arguments.
 * @param array $instance Saved values from database.
 */
public function widget($args, $instance) {

    $expand = "";
    $cur_con = '';

    $is_show = adforest_getTemplateID('static', '_sb_default_cat_condition_show');
    if ($is_show = '' || $is_show == 1) {
        
    } else {
        return;
    }

    if (isset($_GET['condition']) && $_GET['condition'] != "") {
        $cur_con = $_GET['condition'];
        $expand = "in";
    }
    global $adforest_theme;
    $widget_layout = adforest_search_layout();
    require trailingslashit(get_template_directory()) . 'template-parts/layouts/widgets/' . $widget_layout . '/condition.php';
}

/**
 * Back-end widget form.
 *
 * @see WP_Widget::form()
 *
 * @param array $instance Previously saved values from database.
 */
public function form($instance) {
    if (isset($instance['title'])) {
        $title = $instance['title'];
    } else {
        $title = esc_html__('Condition', 'adforest');
    }
    $this->adforect_widget_open($instance);
    ?>
    <p>
        <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
            <?php echo esc_html__('Title:', 'adforest'); ?>
        </label> 
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
    </p>
    <?php
}

/**
 * Sanitize widget form values as they are saved.
 *
 * @see WP_Widget::update()
 *
 * @param array $new_instance Values just sent to be saved.
 * @param array $old_instance Previously saved values from database.
 *
 * @return array Updated safe values to be saved.
 */
public function update($new_instance, $old_instance) {
    $instance = array();
    $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
    $instance['open_widget'] = (!empty($new_instance['open_widget']) ) ? strip_tags($new_instance['open_widget']) : '';
    return $instance;
}

}
}

/*Ad type Widget*/
if (!class_exists('adforest_search_ad_type')) {

class adforest_search_ad_type extends WP_Widget {

use adforest_reuse_functions;

/**
 * Register widget with WordPress.
 */
function __construct() {
    $widget_ops = array(
        'classname' => 'adforest_search_ad_type',
        'description' => __('Only for search and single ad sidebar.', 'adforest'),
    );
    // Instantiate the parent object
    parent::__construct(false, __('Ad Type', 'adforest'), $widget_ops);
}

/**
 * Front-end display of widget.
 *
 * @see WP_Widget::widget()
 *
 * @param array $args     Widget arguments.
 * @param array $instance Saved values from database.
 */
public function widget($args, $instance) {
    $cur_type = '';
    $expand = "";

    $is_show = adforest_getTemplateID('static', '_sb_default_cat_ad_type_show');
    if ($is_show = '' || $is_show == 1) {
        
    } else {
        return;
    }

    $perm_name = (is_home() || is_front_page()) ? 'adtype' : 'ad_type';
    if (isset($_GET["$perm_name"]) && $_GET["$perm_name"] != "") {
        $expand = "in";
        $cur_type = $_GET["$perm_name"];
    }
    global $adforest_theme;
    $widget_layout = adforest_search_layout();
    require trailingslashit(get_template_directory()) . 'template-parts/layouts/widgets/' . $widget_layout . '/ad_type.php';
}

/**
 * Back-end widget form.
 *
 * @see WP_Widget::form()
 *
 * @param array $instance Previously saved values from database.
 */
public function form($instance) {
    if (isset($instance['title'])) {
        $title = $instance['title'];
    } else {
        $title = esc_html__('Ad Type', 'adforest');
    }
    $this->adforect_widget_open($instance);
    ?>
    <p>
        <label for="<?php echo esc_attr($this->get_field_id('title')); ?>" >
            <?php echo esc_html__('Title:', 'adforest'); ?>
        </label> 
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
    </p>
    <?php
}

/**
 * Sanitize widget form values as they are saved.
 *
 * @see WP_Widget::update()
 *
 * @param array $new_instance Values just sent to be saved.
 * @param array $old_instance Previously saved values from database.
 *
 * @return array Updated safe values to be saved.
 */
public function update($new_instance, $old_instance) {
    $instance = array();
    $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
    $instance['open_widget'] = (!empty($new_instance['open_widget']) ) ? strip_tags($new_instance['open_widget']) : '';
    return $instance;
}

}

/*Ad Type*/
}

/*Ad Warranty*/
if (!class_exists('adforest_search_ad_warranty')) {

class adforest_search_ad_warranty extends WP_Widget {

use adforest_reuse_functions;

/**
 * Register widget with WordPress.
 */
function __construct() {
    $widget_ops = array(
        'classname' => 'adforest_search_ad_warranty',
        'description' => __('Only for search and single ad sidebar.', 'adforest'),
    );
    // Instantiate the parent object
    parent::__construct(false, __('Ad Warranty', 'adforest'), $widget_ops);
}

/**
 * Front-end display of widget.
 *
 * @see WP_Widget::widget()
 *
 * @param array $args     Widget arguments.
 * @param array $instance Saved values from database.
 */
public function widget($args, $instance) {
    $cur_war = '';
    $expand = "";

    $is_show = adforest_getTemplateID('static', '_sb_default_cat_warranty_show');
    if ($is_show = '' || $is_show == 1) {
        
    } else {
        return;
    }


    if (isset($_GET['warranty']) && $_GET['warranty'] != "") {
        $expand = "in";
        $cur_war = $_GET['warranty'];
    }
    global $adforest_theme;
    $widget_layout = adforest_search_layout();
    require trailingslashit(get_template_directory()) . 'template-parts/layouts/widgets/' . $widget_layout . '/warranty.php';
}

/**
 * Back-end widget form.
 *
 * @see WP_Widget::form()
 *
 * @param array $instance Previously saved values from database.
 */
public function form($instance) {
    if (isset($instance['title'])) {
        $title = $instance['title'];
    } else {
        $title = esc_html__('Warranty', 'adforest');
    }
    $this->adforect_widget_open($instance);
    ?>
    <p>
        <label for="<?php echo esc_attr($this->get_field_id('title')); ?>" >
            <?php echo esc_html__('Title:', 'adforest'); ?>
        </label> 
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
    </p>
    <?php
}

/**
 * Sanitize widget form values as they are saved.
 *
 * @see WP_Widget::update()
 *
 * @param array $new_instance Values just sent to be saved.
 * @param array $old_instance Previously saved values from database.
 *
 * @return array Updated safe values to be saved.
 */
public function update($new_instance, $old_instance) {
    $instance = array();
    $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
    $instance['open_widget'] = (!empty($new_instance['open_widget']) ) ? strip_tags($new_instance['open_widget']) : '';
    return $instance;
}

}

// Ad Warranty
}




/*Simple or featured ad search*/
if (!class_exists('adforest_search_ad_simple_feature')) {

class adforest_search_ad_simple_feature extends WP_Widget {

use adforest_reuse_functions;

/**
 * Register widget with WordPress.
 */
function __construct() {
    $widget_ops = array(
        'classname' => 'adforest_search_ad_simple_feature',
        'description' => __('Only for search and single ad sidebar.', 'adforest'),
    );
    // Instantiate the parent object
    parent::__construct(false, __('Simple or feature ad search', 'adforest'), $widget_ops);
}

/**
 * Front-end display of widget.
 *
 * @see WP_Widget::widget()
 *
 * @param array $args     Widget arguments.
 * @param array $instance Saved values from database.
 */
public function widget($args, $instance) {
    $simple = '';
    $featured = '';
    $expand = "";
    $is_ad_type = '';
    if (isset($_GET['ad']) && $_GET['ad'] != "") {
        $expand = "in";
        if ($_GET['ad'] == 0) {
            $is_ad_type = 0;
            $simple = "checked";
        }
        if ($_GET['ad'] == 1) {
            $is_ad_type = 1;
            $featured = "checked";
        }
    }
    global $adforest_theme;
    $widget_layout = adforest_search_layout();
    require trailingslashit(get_template_directory()) . 'template-parts/layouts/widgets/' . $widget_layout . '/simple_feature.php';
}

/**
 * Back-end widget form.
 *
 * @see WP_Widget::form()
 *
 * @param array $instance Previously saved values from database.
 */
public function form($instance) {
    if (isset($instance['title'])) {
        $title = $instance['title'];
    } else {
        $title = esc_html__('Simple or Featured', 'adforest');
    }
    $this->adforect_widget_open($instance);
    ?>
    <p>
        <label for="<?php echo esc_attr($this->get_field_id('title')); ?>" >
            <?php echo esc_html__('Title:', 'adforest'); ?>
        </label> 
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
    </p>
    <?php
}

/**
 * Sanitize widget form values as they are saved.
 *
 * @see WP_Widget::update()
 *
 * @param array $new_instance Values just sent to be saved.
 * @param array $old_instance Previously saved values from database.
 *
 * @return array Updated safe values to be saved.
 */
public function update($new_instance, $old_instance) {
    $instance = array();
    $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
    $instance['open_widget'] = (!empty($new_instance['open_widget']) ) ? strip_tags($new_instance['open_widget']) : '';
    return $instance;
}

}

/*Simple or featured ad search*/
}

/*Ad Price Widget*/
if (!class_exists('adforest_search_ad_price')) {

class adforest_search_ad_price extends WP_Widget {

use adforest_reuse_functions;

/**
 * Register widget with WordPress.
 */
function __construct() {
    $widget_ops = array(
        'classname' => 'adforest_search_ad_price',
        'description' => __('Only for search and single ad sidebar.', 'adforest'),
    );
    // Instantiate the parent object
    parent::__construct(false, __('Ad Price', 'adforest'), $widget_ops);
}

/**
 * Front-end display of widget.
 *
 * @see WP_Widget::widget()
 *
 * @param array $args     Widget arguments.
 * @param array $instance Saved values from database.
 */
public function widget($args, $instance) {
    $expand = "";


    $is_show = adforest_getTemplateID('static', '_sb_default_cat_price_show');
    if ($is_show = '' || $is_show == 1) {
        
    } else {
        return;
    }


    $min_price = $instance['min_price'];
    if (isset($_GET['min_price']) && $_GET['min_price'] != "") {
        $expand = "in";
        $min_price = $_GET['min_price'];
    }
    $max_price = $instance['max_price'];
    if (isset($_GET['max_price']) && $_GET['max_price'] != "") {
        $max_price = $_GET['max_price'];
    }
    global $adforest_theme;

    $min = 0;
    if (isset($instance['min_price'])) {
        $min = $instance['min_price'];
    }
    $currency = '';
    if (isset($_GET['c'])) {
        $currency = $_GET['c'];
    }
    global $adforest_theme;
    $widget_layout = adforest_search_layout();
    require trailingslashit(get_template_directory()) . 'template-parts/layouts/widgets/' . $widget_layout . '/price.php';
}

/**
 * Back-end widget form.
 *
 * @see WP_Widget::form()
 *
 * @param array $instance Previously saved values from database.
 */
public function form($instance) {
    if (isset($instance['title'])) {
        $title = $instance['title'];
    } else {
        $title = esc_html__('Ad Price', 'adforest');
    }

    if (isset($instance['min_price'])) {
        $min_price = $instance['min_price'];
    } else {
        $min_price = 1;
    }

    if (isset($instance['max_price'])) {
        $max_price = $instance['max_price'];
    } else {
        $max_price = esc_html__('10000000', 'adforest');
    }
    $this->adforect_widget_open($instance);
    ?>
    <p>
        <label for="<?php echo esc_attr($this->get_field_id('title')); ?>" >
            <?php echo esc_html__('Title:', 'adforest'); ?>
        </label> 
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
    </p>
    <p>
        <label for="<?php echo esc_attr($this->get_field_id('min_price')); ?>" >
            <?php echo esc_html__('Min Price:', 'adforest'); ?>
        </label> 
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('min_price')); ?>" name="<?php echo esc_attr($this->get_field_name('min_price')); ?>" type="text" value="<?php echo esc_attr($min_price); ?>">
    </p>
    <p>
        <label for="<?php echo esc_attr($this->get_field_id('max_price')); ?>" >
            <?php echo esc_html__('Max Price:', 'adforest'); ?>
        </label> 
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('max_price')); ?>" name="<?php echo esc_attr($this->get_field_name('max_price')); ?>" type="text" value="<?php echo esc_attr($max_price); ?>">
    </p>
    <?php
}

/**
 * Sanitize widget form values as they are saved.
 *
 * @see WP_Widget::update()
 *
 * @param array $new_instance Values just sent to be saved.
 * @param array $old_instance Previously saved values from database.
 *
 * @return array Updated safe values to be saved.
 */
public function update($new_instance, $old_instance) {
    $instance = array();
    $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
    $instance['min_price'] = (!empty($new_instance['min_price']) ) ? strip_tags($new_instance['min_price']) : 0;
    $instance['max_price'] = (!empty($new_instance['max_price']) ) ? strip_tags($new_instance['max_price']) : '';
    $instance['open_widget'] = (!empty($new_instance['open_widget']) ) ? strip_tags($new_instance['open_widget']) : '';
    return $instance;
}

}

}



/*Ad Categories widget*/
if (!class_exists('adforest_search_cats')) {

class adforest_search_cats extends WP_Widget {

use adforest_reuse_functions;

/**
 * Register widget with WordPress.
 */
function __construct() {
    $widget_ops = array(
        'classname' => 'adforest_search_cats',
        'description' => __('Only for search and single ad sidebar.', 'adforest'),
    );
    // Instantiate the parent object
    parent::__construct(false, __('Ad Categories', 'adforest'), $widget_ops);
}

/**
 * Front-end display of widget.
 *
 * @see WP_Widget::widget()
 *
 * @param array $args     Widget arguments.
 * @param array $instance Saved values from database.
 */
public function widget($args, $instance) {

    $new = '';
    $used = '';
    $expand = "";
    if (isset($_GET['cat_id']) && $_GET['cat_id'] != "") {
        $expand = "in";
    }
    global $adforest_theme;
    $widget_layout = adforest_search_layout();
    require trailingslashit(get_template_directory()) . 'template-parts/layouts/widgets/' . $widget_layout . '/cats.php';
}

/**
 * Back-end widget form.
 *
 * @see WP_Widget::form()
 *
 * @param array $instance Previously saved values from database.
 */
public function form($instance) {
    if (isset($instance['title'])) {
        $title = $instance['title'];
    } else {
        $title = esc_html__('Categories', 'adforest');
    }

    $this->adforect_widget_open($instance);
    ?>
    <p>
        <label for="<?php echo esc_attr($this->get_field_id('title')); ?>" >
            <?php echo esc_html__('Title:', 'adforest'); ?>
        </label> 
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
    </p>
    <?php
}

/**
 * Sanitize widget form values as they are saved.
 *
 * @see WP_Widget::update()
 *
 * @param array $new_instance Values just sent to be saved.
 * @param array $old_instance Previously saved values from database.
 *
 * @return array Updated safe values to be saved.
 */
public function update($new_instance, $old_instance) {
    $instance = array();
    $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
    $instance['open_widget'] = (!empty($new_instance['open_widget']) ) ? strip_tags($new_instance['open_widget']) : '';
    return $instance;
}

}

}


/*Ad title Widget*/
if (!class_exists('adforest_search_ad_title')) {

class adforest_search_ad_title extends WP_Widget {

use adforest_reuse_functions;

/**
 * Register widget with WordPress.
 */
function __construct() {
    $widget_ops = array(
        'classname' => 'adforest_search_ad_title',
        'description' => __('Only for search and single ad sidebar.', 'adforest'),
    );
    // Instantiate the parent object
    parent::__construct(false, __('Ad Search', 'adforest'), $widget_ops);
}

/**
 * Front-end display of widget.
 *
 * @see WP_Widget::widget()
 *
 * @param array $args     Widget arguments.
 * @param array $instance Saved values from database.
 */
public function widget($args, $instance) {
    $expand = "";
    $title = '';
    if (isset($_GET['ad_title']) && $_GET['ad_title'] != "") {
        $expand = "in";
        $title = $_GET['ad_title'];
    }
    global $adforest_theme;
    $widget_layout = adforest_search_layout();
    require trailingslashit(get_template_directory()) . 'template-parts/layouts/widgets/' . $widget_layout . '/title.php';
    ?>

    <?php
}

/**
 * Back-end widget form.
 *
 * @see WP_Widget::form()
 *
 * @param array $instance Previously saved values from database.
 */
public function form($instance) {
    if (isset($instance['title'])) {
        $title = $instance['title'];
    } else {
        $title = esc_html__('Ad Search', 'adforest');
    }
    $this->adforect_widget_open($instance);
    ?>
    <p>
        <label for="<?php echo esc_attr($this->get_field_id('title')); ?>" >
            <?php echo esc_html__('Title:', 'adforest'); ?>
        </label> 
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
    </p>
    <?php
}

/**
 * Sanitize widget form values as they are saved.
 *
 * @see WP_Widget::update()
 *
 * @param array $new_instance Values just sent to be saved.
 * @param array $old_instance Previously saved values from database.
 *
 * @return array Updated safe values to be saved.
 */
public function update($new_instance, $old_instance) {
    $instance = array();
    $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
    $instance['open_widget'] = (!empty($new_instance['open_widget']) ) ? strip_tags($new_instance['open_widget']) : '';
    return $instance;
}

}

}


/*Ad Locations widget*/
if (!class_exists('adforest_search_locations')) {

class adforest_search_locations extends WP_Widget {

use adforest_reuse_functions;

/**
 * Register widget with WordPress.
 */
function __construct() {
    $widget_ops = array(
        'classname' => 'adforest_search_locations',
        'description' => __('Only for search and single ad sidebar.', 'adforest'),
    );
    // Instantiate the parent object
    parent::__construct(false, __('Ad Locations', 'adforest'), $widget_ops);
}

/**
 * Front-end display of widget.
 *
 * @see WP_Widget::widget()
 *
 * @param array $args     Widget arguments.
 * @param array $instance Saved values from database.
 */
public function widget($args, $instance) {

    $expand = "";
    $location = '';
    if (isset($_GET['location']) && $_GET['location'] != "") {
        $expand = "in";
        $location = $_GET['location'];
    }
    global $adforest_theme;
    $widget_layout = adforest_search_layout();
    require trailingslashit(get_template_directory()) . 'template-parts/layouts/widgets/' . $widget_layout . '/location.php';
}

/**
 * Back-end widget form.
 *
 * @see WP_Widget::form()
 *
 * @param array $instance Previously saved values from database.
 */
public function form($instance) {
    if (isset($instance['title'])) {
        $title = $instance['title'];
    } else {
        $title = esc_html__('Ad Locations', 'adforest');
    }
    $this->adforect_widget_open($instance);
    ?>
    <p>
        <label for="<?php echo esc_attr($this->get_field_id('title')); ?>" >
            <?php echo esc_html__('Title:', 'adforest'); ?>
        </label> 
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
    </p>
    <?php
}

/**
 * Sanitize widget form values as they are saved.
 *
 * @see WP_Widget::update()
 *
 * @param array $new_instance Values just sent to be saved.
 * @param array $old_instance Previously saved values from database.
 *
 * @return array Updated safe values to be saved.
 */
public function update($new_instance, $old_instance) {
    $instance = array();
    $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
    $instance['open_widget'] = (!empty($new_instance['open_widget']) ) ? strip_tags($new_instance['open_widget']) : '';
    return $instance;
}

}

/*Locations widget*/
}

/*Featured Ads Widget*/
if (!class_exists('adforest_search_featured_ad')) {

class adforest_search_featured_ad extends WP_Widget {

use adforest_reuse_functions;

/**
 * Register widget with WordPress.
 */
function __construct() {
    $widget_ops = array(
        'classname' => 'adforest_search_featured_ad',
        'description' => __('Only for search and single ad sidebar.', 'adforest'),
    );
    // Instantiate the parent object
    parent::__construct(false, __('Ad Featured', 'adforest'), $widget_ops);
}

/**
 * Front-end display of widget.
 *
 * @see WP_Widget::widget()
 *
 * @param array $args     Widget arguments.
 * @param array $instance Saved values from database.
 */
public function widget($args, $instance) {
    $max_ads = $instance['max_ads'];
    global $adforest_theme;
    if (isset($adforest_theme['design_type']) && $adforest_theme['design_type'] == 'modern') {
        if (!is_singular('ad_post') && isset($adforest_theme['search_design'])) {
            if (is_page_template('page-search.php') && ($adforest_theme['search_design'] == 'map' || $adforest_theme['search_design'] == 'topbar' ))
                return;
        }
    }
    ?>
    <div class="panel panel-default">
        <div class="panel-heading" >
            <div class="panel-title">
                <span><?php echo esc_html($title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title'])); ?></span>
            </div>
        </div>
        <div class="panel-collapse">
            <div class="panel-body recent-ads">
                <div class="featured-slider-3 owl-carousel owl-theme owl-responsive-1000 owl-loaded">
                    <?php
                    $f_args = array(
                        'post_type' => 'ad_post',
                        'post_status' => 'publish',
                        'posts_per_page' => $max_ads,
                        'meta_query' => array( array( 'key' => '_adforest_is_feature', 'value' => 1, 'compare' => '=',  ), ), 'orderby' => 'rand',
                    );
                    $f_args = apply_filters('adforest_wpml_show_all_posts', $f_args);
                    $f_args = apply_filters('adforest_site_location_ads', $f_args, 'ads');
                    $f_ads = new WP_Query($f_args);
                    if ($f_ads->have_posts()) {
                        $number = 0;
                        while ($f_ads->have_posts()) {
                            $f_ads->the_post();
                            $pid = get_the_ID();
                            $author_id = get_post_field('post_author', $pid);
                         
                            $author = get_user_by('ID', $author_id);

                            $img = adforest_get_ad_default_image_url('adforest-ad-related');
                            $media = adforest_get_ad_images($pid);
                            $total_imgs = count($media);
                            if (count($media) > 0) {
                                foreach ($media as $m) {
                                    $mid = '';
                                    if (isset($m->ID))
                                        $mid = $m->ID;
                                    else
                                        $mid = $m;

                                    $image = wp_get_attachment_image_src($mid, 'adforest-ad-related');
                                    $img = $image[0];
                                    break;
                                }
                            }

                            $timer_html = '';
                            $bid_end_date = get_post_meta($pid, '_adforest_ad_bidding_date', true);
                            if ($bid_end_date != "" && date('Y-m-d H:i:s') < $bid_end_date) {
                                $timer_html .= '<div class="listing-bidding">' . adforest_timer_html($bid_end_date, false) . '</div>';
                            }
                            ?>
                                <div class="item">
                                    <div class="col-md-12 col-xs-12 col-sm-12 no-padding">
                                        <div class="category-grid-box">
                                            <div class="category-grid-img">
                                                <?php echo adforest_returnEcho($timer_html); ?>
                                                <img class="img-responsive" alt="<?php echo get_the_title(); ?>" src="<?php echo esc_url($img); ?>">
                                                <?php echo adforest_video_icon(); ?>
                                                <div class="user-preview">
                                                    <a href="<?php echo adforest_set_url_param(get_author_posts_url($author_id), 'type', 'ads'); ?>">
                                                        <img src="<?php echo adforest_get_user_dp($author_id); ?>" class="avatar avatar-small" alt="<?php echo get_the_title(); ?>">
                                                    </a>
                                                </div>
                                                <a href="<?php echo get_the_permalink(); ?>" class="view-details"><?php echo __('View Details', 'adforest'); ?></a>
                                            </div>
                                            <div class="short-description">
                                                <div class="category-title"><?php echo adforest_display_cats(get_the_ID()); ?></div>
                                                <div class="feature-ad-title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></div>
                                                <div class="price"><?php echo(adforest_adPrice(get_the_ID())); ?></div>
                                            </div>
                                            <div class="ad-info">
                                                <ul><li><i class="fa fa-map-marker"></i><?php echo get_post_meta(get_the_ID(), '_adforest_ad_location', true); ?></li></ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } }
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Back-end widget form.
 *
 * @see WP_Widget::form()
 *
 * @param array $instance Previously saved values from database.
 */
public function form($instance) {

    if (isset($instance['title'])) {
        $title = $instance['title'];
    } else {
        $title = esc_html__('Featured Ads', 'adforest');
    }
    if (isset($instance['max_ads'])) {
        $max_ads = $instance['max_ads'];
    } else {
        $max_ads = 5;
    }
    $this->adforect_widget_open($instance);
    ?>
    <p>
        <label for="<?php echo esc_attr($this->get_field_id('title')); ?>" >
            <?php echo esc_html__('Title:', 'adforest'); ?>
        </label> 
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
    </p>
    <p>
        <label for="<?php echo esc_attr($this->get_field_id('max_ads')); ?>" >
            <?php echo esc_html__('Max # of Ads:', 'adforest'); ?>
        </label> 
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('max_ads')); ?>" name="<?php echo esc_attr($this->get_field_name('max_ads')); ?>" type="text" value="<?php echo esc_attr($max_ads); ?>">
    </p>
    <?php
}

/**
 * Sanitize widget form values as they are saved.
 *
 * @see WP_Widget::update()
 *
 * @param array $new_instance Values just sent to be saved.
 * @param array $old_instance Previously saved values from database.
 *
 * @return array Updated safe values to be saved.
 */
public function update($new_instance, $old_instance) {
    $instance = array();
    $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
    $instance['max_ads'] = (!empty($new_instance['max_ads']) ) ? strip_tags($new_instance['max_ads']) : '';
    $instance['open_widget'] = (!empty($new_instance['open_widget']) ) ? strip_tags($new_instance['open_widget']) : '';
    return $instance;
}

}
}




if (!class_exists('adforest_search_recent_ad')) {

class adforest_search_recent_ad extends WP_Widget {

use adforest_reuse_functions;

/**
 * Register widget with WordPress.
 */
function __construct() {
    $widget_ops = array(
        'classname' => 'adforest_search_recent_ad',
        'description' => __('Only for search and single ad sidebar.', 'adforest'),
    );
    // Instantiate the parent object
    parent::__construct(false, __('Ads Recent', 'adforest'), $widget_ops);
}
/**
 * Front-end display of widget.
 *
 * @see WP_Widget::widget()
 *
 * @param array $args     Widget arguments.
 * @param array $instance Saved values from database.
 */
public function widget($args, $instance) {
    $max_ads = $instance['max_ads'];
    global $adforest_theme;
    if (isset($adforest_theme['design_type']) && $adforest_theme['design_type'] == 'modern') {
        if (!is_singular('ad_post') && is_page_template('page-search.php')){return;} 
    }
    ?>
    <div class="panel panel-default">
        <div class="panel-heading" >
            <div class="panel-title">
                <span>
        <?php echo esc_html($title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title'])); ?>
                </span>
            </div>
        </div>
        <div class="panel-collapse">
            <div class="panel-body recent-ads">
                <?php
                $f_args = array(
                    'post_type' => 'ad_post',
                    'posts_per_page' => $max_ads,
                    'meta_query' => array(
                        array( 'key' => '_adforest_ad_status_', 'value' => 'active', 'compare' => '=', ), ),
                    'post_status' => 'publish',
                    'orderby' => 'date',
                    'order' => 'DESC',
                );
                 $f_args = apply_filters('adforest_wpml_show_all_posts', $f_args);
                 $f_args = apply_filters('adforest_site_location_ads', $f_args, 'ads');
                $f_ads = new WP_Query($f_args);
                if ($f_ads->have_posts()) {
                    $number = 0;
                    while ($f_ads->have_posts()) {
                        $f_ads->the_post();
                        $pid = get_the_ID();
                        $author_id = get_post_field('post_author', $pid);
                        $author = get_user_by('ID', $author_id);

                        $img = adforest_get_ad_default_image_url('adforest-ad-related');
                        $media = adforest_get_ad_images($pid);
                        $total_imgs = count($media);
                        if (count($media) > 0) {
                            foreach ($media as $m) {
                                $mid = '';
                                if (isset($m->ID))
                                    $mid = $m->ID;
                                else
                                    $mid = $m;

                                $image = wp_get_attachment_image_src($mid, 'adforest-ad-related');
                                $img = $image[0];
                                break;
                            }
                        }
                        ?><div class="recent-ads-list">
                            <div class="recent-ads-container">
                                <div class="recent-ads-list-image"><a href="<?php the_permalink(); ?>" class="recent-ads-list-image-inner"><img alt="<?php echo get_the_title(); ?>" src="<?php echo esc_url($img); ?>"></a></div>
                                <div class="recent-ads-list-content">
                                    <div class="recent-ads-list-title"><a href="<?php the_permalink(); ?>"><?php echo adforest_words_count(get_the_title(), 25); ?></a></div>
                                    <ul class="recent-ads-list-location"><li><a href="javascript:void(0);"><?php echo adforest_words_count(get_post_meta(get_the_ID(), '_adforest_ad_location', true), 30); ?></a></li></ul>
                                    <div class="recent-ads-list-price"><?php echo(adforest_adPrice(get_the_ID())); ?></div>
                                </div>
                            </div>
                        </div><?php
                    }
                }
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>               
    <?php
}

/**
 * Back-end widget form.
 *
 * @see WP_Widget::form()
 *
 * @param array $instance Previously saved values from database.
 */
public function form($instance) {
    if (isset($instance['title'])) {
        $title = $instance['title'];
    } else {
        $title = esc_html__('Recent Ads', 'adforest');
    }
    if (isset($instance['max_ads'])) {
        $max_ads = $instance['max_ads'];
    } else {
        $max_ads = 5;
    }
    $this->adforect_widget_open($instance);
    ?>
    <p>
        <label for="<?php echo esc_attr($this->get_field_id('title')); ?>" >
            <?php echo esc_html__('Title:', 'adforest'); ?>
        </label> 
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
    </p>
    <p>
        <label for="<?php echo esc_attr($this->get_field_id('max_ads')); ?>" >
            <?php echo esc_html__('Max # of Ads:', 'adforest'); ?>
        </label> 
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('max_ads')); ?>" name="<?php echo esc_attr($this->get_field_name('max_ads')); ?>" type="text" value="<?php echo esc_attr($max_ads); ?>">
    </p>
    <?php
}

/**
 * Sanitize widget form values as they are saved.
 *
 * @see WP_Widget::update()
 *
 * @param array $new_instance Values just sent to be saved.
 * @param array $old_instance Previously saved values from database.
 *
 * @return array Updated safe values to be saved.
 */
public function update($new_instance, $old_instance) {
    $instance = array();
    $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
    $instance['max_ads'] = (!empty($new_instance['max_ads']) ) ? strip_tags($new_instance['max_ads']) : '';
    $instance['open_widget'] = (!empty($new_instance['open_widget']) ) ? strip_tags($new_instance['open_widget']) : '';
    return $instance;
}
}
}

/*Advertisement  Widget*/



if (!class_exists('adforest_search_advertisement')) {

class adforest_search_advertisement extends WP_Widget {

use adforest_reuse_functions;

/**
 * Register widget with WordPress.
 */
function __construct() {
    $widget_ops = array(
        'classname' => 'adforest_search_advertisement',
        'description' => __('Only for search and single ad sidebar.', 'adforest'),
    );
    // Instantiate the parent object
    parent::__construct(false, __('Adforest Advertisement', 'adforest'), $widget_ops);
}

/**
 * Front-end display of widget.
 *
 * @see WP_Widget::widget()
 *
 * @param array $args     Widget arguments.
 * @param array $instance Saved values from database.
 */
public function widget($args, $instance) {
    $ad_code = $instance['ad_code'];
    global $adforest_theme;
    ?>

    <div class="panel panel-default">
        <div class="panel-heading" >
            <div class="panel-title">
                <span><?php echo esc_html($title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title'])); ?></span>
            </div>
        </div>
        <div class="panel-collapse">
            <div class="panel-body recent-ads"><?php echo "" . $ad_code; ?></div>
        </div>
    </div>               
    <?php
}

/**
 * Back-end widget form.
 *
 * @see WP_Widget::form()
 *
 * @param array $instance Previously saved values from database.
 */
public function form($instance) {
    if (isset($instance['title'])) {
        $title = $instance['title'];
    } else {
        $title = esc_html__('Advertisement', 'adforest');
    }
    $ad_code = '';
    if (isset($instance['ad_code'])) {
        $ad_code = $instance['ad_code'];
    }
    $this->adforect_widget_open($instance);
    ?>
    <p>
        <label for="<?php echo esc_attr($this->get_field_id('title')); ?>" >
            <?php echo esc_html__('300 X 250 Ad', 'adforest'); ?>
        </label> 
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
    </p>
    <p>
        <label for="<?php echo esc_attr($this->get_field_id('ad_code')); ?>" >
            <?php echo esc_html__('Code:', 'adforest'); ?>
        </label> 
        <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('ad_code')); ?>" name="<?php echo esc_attr($this->get_field_name('ad_code')); ?>" type="text"><?php echo esc_attr($ad_code); ?></textarea>
    </p>
    <?php
}

/**
 * Sanitize widget form values as they are saved.
 *
 * @see WP_Widget::update()
 *
 * @param array $new_instance Values just sent to be saved.
 * @param array $old_instance Previously saved values from database.
 *
 * @return array Updated safe values to be saved.
 */
public function update($new_instance, $old_instance) {
    $instance = array();
    $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
    $instance['ad_code'] = (!empty($new_instance['ad_code']) ) ? $new_instance['ad_code'] : '';
    $instance['open_widget'] = (!empty($new_instance['open_widget']) ) ? strip_tags($new_instance['open_widget']) : '';
    return $instance;
}
}
/*Advertisement*/
}

/* ------------------------------------------------------------------------------------- */
/* Custom Search */
if (!class_exists('adforest_search_custom_fields')) {

class adforest_search_custom_fields extends WP_Widget {

use adforest_reuse_functions;

/**
 * Register widget with WordPress.
 */
function __construct() {
    $widget_ops = array(
        'classname' => 'adforest_search_custom_fields',
        'description' => __('Only for search and single ad sidebar.', 'adforest'),
    );
    // Instantiate the parent object
    parent::__construct(false, __('Custom Fields Search', 'adforest'), $widget_ops);
}

/**
 * Front-end display of widget.
 *
 * @see WP_Widget::widget()
 *
 * @param array $args     Widget arguments.
 * @param array $instance Saved values from database.
 */
public function widget($args, $instance) {
    $ad_code = '';
    if (isset($instance['ad_code'])) {
        $ad_code = $instance['ad_code'];
    }
    global $adforest_theme;
    $term_id = '';
    $customHTML = '';
    $widget_layout = adforest_search_layout();
    require trailingslashit(get_template_directory()) . 'template-parts/layouts/widgets/' . $widget_layout . '/custom.php';
    echo "" . $customHTML;
}

/**
 * Back-end widget form.
 *
 * @see WP_Widget::form()
 *
 * @param array $instance Previously saved values from database.
 */
public function form($instance) {

    $title = ( isset($instance['title']) ) ? $instance['title'] : esc_html__('Search By:', 'adforest');
    $this->adforect_widget_open($instance);
    ?>
    <p>
        <label for="<?php echo esc_attr($this->get_field_id('title')); ?>" >
            <?php echo esc_html__('Title:', 'adforest'); ?> <small><?php echo esc_html__('You can leave it empty as well', 'adforest'); ?></small>
        </label> 
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
    <p><?php echo esc_html__('You can show/hide the specific type from categories custom fields where you created it.', 'adforest'); ?> </p>
    </p>

    <?php
}

/**
 * Sanitize widget form values as they are saved.
 *
 * @see WP_Widget::update()
 *
 * @param array $new_instance Values just sent to be saved.
 * @param array $old_instance Previously saved values from database.
 *
 * @return array Updated safe values to be saved.
 */
public function update($new_instance, $old_instance) {
    $instance = array();
    $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
    $instance['open_widget'] = (!empty($new_instance['open_widget']) ) ? strip_tags($new_instance['open_widget']) : '';
    return $instance;
}
}

/* Custom Search */
}
if (!function_exists('adforest_getTemplateID')) {

function adforest_getTemplateID($type = 'dynamic', $is_show = '') {
if (isset($_GET['cat_id']) && $_GET['cat_id'] != "" && is_numeric($_GET['cat_id'])) {

    $term_id = $_GET['cat_id'];
    $result = adforest_dynamic_templateID($term_id);
    $templateID = get_term_meta($result, '_sb_dynamic_form_fields', true);

    if (isset($templateID) && $templateID != "") {

        if ($type != 'dynamic') {
            $formData = sb_custom_form_data($templateID, $is_show);
        } else {
            $formData = sb_dynamic_form_data($templateID);
        }
        return $formData;
    } else {
        return 1;
    }
} else {
    return 1;
}
}

}





/*Ad Categories widget*/
if (!class_exists('adforest_ad_locations')) {

class adforest_ad_locations extends WP_Widget {

use adforest_reuse_functions;

/**
 * Register widget with WordPress.
 */
function __construct() {
    $widget_ops = array(
        'classname' => 'adforest_ad_locations',
        'description' => __('Only for search', 'adforest'),
    );
    // Instantiate the parent object
    parent::__construct(false, __('Country Location', 'adforest'), $widget_ops);
}

/**
 * Front-end display of widget.
 *
 * @see WP_Widget::widget()
 *
 * @param array $args     Widget arguments.
 * @param array $instance Saved values from database.
 */
public function widget($args, $instance) {

    $new = '';
    $used = '';
    $expand = "";
    if (isset($_GET['country_id']) && $_GET['country_id'] != "") {
        $expand = "in";
    }
    global $adforest_theme;
    $widget_layout = adforest_search_layout();
    require trailingslashit(get_template_directory()) . 'template-parts/layouts/widgets/' . $widget_layout . '/countries.php';
}

/**
 * Back-end widget form.
 *
 * @see WP_Widget::form()
 *
 * @param array $instance Previously saved values from database.
 */
public function form($instance) {
    if (isset($instance['title'])) {
        $title = $instance['title'];
    } else {
        $title = esc_html__('Country Location', 'adforest');
    }
    $this->adforect_widget_open($instance);
    ?>
    <p>
        <label for="<?php echo esc_attr($this->get_field_id('title')); ?>" >
            <?php echo esc_html__('Title:', 'adforest'); ?>
        </label> 
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
    </p>
    <?php
}

/**
 * Sanitize widget form values as they are saved.
 *
 * @see WP_Widget::update()
 *
 * @param array $new_instance Values just sent to be saved.
 * @param array $old_instance Previously saved values from database.
 *
 * @return array Updated safe values to be saved.
 */
public function update($new_instance, $old_instance) {
    $instance = array();
    $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
    $instance['open_widget'] = (!empty($new_instance['open_widget']) ) ? strip_tags($new_instance['open_widget']) : '';
    return $instance;
}

}
/*Location widget*/
}

/*Ad Locations widget*/
if (!class_exists('adforest_radius_search_locations')) {

class adforest_radius_search_locations extends WP_Widget {

use adforest_reuse_functions;

/**
 * Register widget with WordPress.
 */
function __construct() {
    $widget_ops = array(
        'classname' => 'adforest_radius_search_locations',
        'description' => __('Only for search.', 'adforest'),
    );
    // Instantiate the parent object
    parent::__construct(false, __('Adforest Radius Search', 'adforest'), $widget_ops);
}

/**
 * Front-end display of widget.
 *
 * @see WP_Widget::widget()
 *
 * @param array $args     Widget arguments.
 * @param array $instance Saved values from database.
 */
public function widget($args, $instance) {

    global $adforest_theme;
    if (isset($adforest_theme['design_type']) && $adforest_theme['design_type'] == 'modern') {
        if (!is_singular('ad_post') && isset($adforest_theme['search_design'])) {
            if (is_page_template('page-search.php') && $adforest_theme['search_design'] == 'map')
                return;
        }
    }


    $expand = "";
    $location = '';
    if (isset($_GET['location']) && $_GET['location'] != "") {
        $expand = "in";
        $location = $_GET['location'];
    }
    global $adforest_theme;
    $widget_layout = adforest_search_layout();
    require trailingslashit(get_template_directory()) . 'template-parts/layouts/widgets/' . $widget_layout . '/radius_serach.php';
}

/**
 * Back-end widget form.
 *
 * @see WP_Widget::form()
 *
 * @param array $instance Previously saved values from database.
 */
public function form($instance) {
    if (isset($instance['title'])) {
        $title = $instance['title'];
    } else {
        $title = esc_html__('Radius Search', 'adforest');
    }
    $this->adforect_widget_open($instance);
    ?>
    <p>
        <label for="<?php echo esc_attr($this->get_field_id('title')); ?>" >
            <?php echo esc_html__('Title:', 'adforest'); ?>
        </label> 
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
    </p>
    <?php
}

/**
 * Sanitize widget form values as they are saved.
 *
 * @see WP_Widget::update()
 *
 * @param array $new_instance Values just sent to be saved.
 * @param array $old_instance Previously saved values from database.
 *
 * @return array Updated safe values to be saved.
 */
public function update($new_instance, $old_instance) {
    $instance = array();
    $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
    $instance['open_widget'] = (!empty($new_instance['open_widget']) ) ? strip_tags($new_instance['open_widget']) : '';
    return $instance;
}

}
}


/*Adds widget: Contact With Ad Owner*/
class adforest_contactwithadowner_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'adforest_contactwithadowner_Widget',
            esc_html__( 'Contact With Ad Owner', 'adforest' ),
            array( 'description' => esc_html__( 'Contact with ad owner with/without login. This widget is for single ad page only and you can use only one widget on the page ', 'adforest' ), ) // Args
        );
    }

    private $widget_fields = array(
    );

    public function widget( $args, $instance ) {
        echo adforest_returnEcho($args['before_widget']);

        if ( ! empty( $instance['title'] ) ) {
            $widget_title =  $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
            echo adforest_returnEcho($widget_title);
        }

        global $adforest_theme;

if (isset($adforest_theme['user_contact_form']) && $adforest_theme['user_contact_form']) {

    $captcha_type = isset($adforest_theme['google-recaptcha-type']) && !empty($adforest_theme['google-recaptcha-type']) ? $adforest_theme['google-recaptcha-type'] : 'v2';
    $site_key = isset($adforest_theme['google_api_key']) && !empty($adforest_theme['google_api_key']) ? $adforest_theme['google_api_key'] : '';
    $contact_form_recaptcha = isset($adforest_theme['contact_form_recaptcha']) && !empty($adforest_theme['contact_form_recaptcha']) ? $adforest_theme['contact_form_recaptcha'] : '';
    ?>

    <form class="send-message-to-author">
        <div class="seller-form-group">
            <div class="form-group">
                <input type="text" class="form-control" name="userName" aria-describedby="nameHelp" placeholder="<?php echo __('Name', 'adforest');?>" data-parsley-required="true" data-parsley-error-message="<?php echo __('This field is required.', 'adforest');?>">
                <small id="nameHelp" class="form-text text-muted"></small> </div>
            <div class="form-group">
                <input type="email" class="form-control" name="emailAddress" aria-describedby="emailHelp" placeholder="<?php echo __('Email', 'adforest');?>" data-parsley-required="true" data-parsley-error-message="<?php echo __('This field is required.', 'adforest');?>">
                <small id="emailHelp" class="form-text text-muted"></small> </div>
            <div class="form-group">
                <input type="text" class="form-control" name="phoneNumber" aria-describedby="phonelHelp" placeholder="<?php echo __('Phone Number', 'adforest');?>" data-parsley-required="true" data-parsley-error-message="<?php echo __('This field is required.', 'adforest');?>">
                <small id="phonelHelp" class="form-text text-muted"></small> </div>
            <div class="form-group">
                <textarea class="form-control" name="message" rows="4" placeholder="<?php echo __('Message', 'adforest');?>" data-parsley-required="true" data-parsley-error-message="<?php echo __('This field is required.', 'adforest');?>"></textarea>
            </div>
            <?php
            $captcha = '<input type="hidden" value="no" name="is_captcha" />';

            if (isset($contact_form_recaptcha) && $contact_form_recaptcha) {
                if ($captcha_type == 'v2') {
                    if ($site_key != "") {
                        $captcha = '<div class="form-group"><div class="g-recaptcha" data-sitekey="' . $site_key . '"></div></div><input type="hidden" value="yes" name="is_captcha" />';
                    }
                } else {
                    $captcha = '<input type="hidden" value="yes" name="is_captcha" />';
                }
            }
            echo adforest_returnEcho($captcha);
            ?>
        </div>
        <div class="sellers-button-group">
            <button class="btn btn-primary btn-theme" type="submit"><?php echo __('Send Message', 'adforest');?></button>
        </div>
    </form>
    <?php
}             
        echo adforest_returnEcho($args['after_widget']);
    }

    public function field_generator( $instance ) {
        $output = '';
        foreach ( $this->widget_fields as $widget_field ) {
            $default = '';
            if ( isset($widget_field['default']) ) {
                $default = $widget_field['default'];
            }
            $widget_value = ! empty( $instance[$widget_field['id']] ) ? $instance[$widget_field['id']] : $default;
            switch ( $widget_field['type'] ) {
                default:
                    $output .= '<p>';
                    $output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'adforest' ).':</label> ';
                    $output .= '<input class="widefat" id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" type="'.$widget_field['type'].'" value="'.esc_attr( $widget_value ).'">';
                    $output .= '</p>';
            }
        }
        echo adforest_returnEcho($output);
    }

    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'adforest' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <?php
        $this->field_generator( $instance );
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        foreach ( $this->widget_fields as $widget_field ) {
            switch ( $widget_field['type'] ) {
                default:
                    $instance[$widget_field['id']] = ( ! empty( $new_instance[$widget_field['id']] ) ) ? strip_tags( $new_instance[$widget_field['id']] ) : '';
            }
        }
        return $instance;
    }
}

add_action('widgets_init', function() {
    if(function_exists('adforest_register_custom_widgets')){
        adforest_register_custom_widgets('adforest_search_condition');
        adforest_register_custom_widgets('adforest_search_ad_type');
        adforest_register_custom_widgets('adforest_search_ad_warranty');
        adforest_register_custom_widgets('adforest_search_ad_simple_feature');
        adforest_register_custom_widgets('adforest_search_ad_price');
        adforest_register_custom_widgets('adforest_search_cats');
        adforest_register_custom_widgets('adforest_search_ad_title');
        adforest_register_custom_widgets('adforest_search_locations');
        adforest_register_custom_widgets('adforest_search_featured_ad');
        adforest_register_custom_widgets('adforest_search_recent_ad');
        adforest_register_custom_widgets('adforest_search_advertisement');
        adforest_register_custom_widgets('adforest_search_custom_fields');
        adforest_register_custom_widgets('adforest_ad_locations');
        adforest_register_custom_widgets('adforest_radius_search_locations');
        adforest_register_custom_widgets('adforest_contactwithadowner_Widget');
    }
});