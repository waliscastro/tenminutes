<?php
adforest_advance_search_map_container_open();

$sb_search_page = apply_filters('adforest_language_page_id', $adforest_theme['sb_search_page']);

?>
<div class="col-md-4 col-xs-12 col-sm-4">
    <form method="get" action="<?php echo get_the_permalink($sb_search_page); ?>">
        <div class="form-group">
            <label><?php
                echo esc_html($title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']));
                echo adforest_returnEcho($is_ad_type);
                ?></label>
            <select class="category form-control submit_on_select" name="ad" data-placeholder="<?php echo __('Select option', 'adforest'); ?>">
                <option label=""></option>
                <?php
                $conditions = array('' => __('Select Ad Type', 'adforest'), 0 => __('Simple Ads', 'adforest'), '1' => __('Featured Ads', 'adforest'));
                foreach ($conditions as $key => $val) {
                    ?>
                    <option value="<?php echo esc_attr($key); ?>" <?php
                    if ($is_ad_type === $key) {
                        echo esc_attr("selected");
                    }
                    ?>>
                    <?php echo esc_html($val); ?>
                    </option>
                    <?php
                }
                ?>
            </select>
        </div>
        <?php
        echo adforest_search_params('ad');
        ?>
    </form>
    <?php
    adforest_widget_counter();
    ?>
</div>
<?php
adforest_advance_search_map_container_close();
adforest_advance_search_container();
?>