<?php get_header(); ?>
<?php global $adforest_theme; ?>
<?php
/* Only need on this page so inluded here don't want to increase page size for optimizaion by adding extra scripts in all the web */
wp_enqueue_style('star-rating', trailingslashit(get_template_directory_uri()) . 'css/star-rating.css');
wp_register_script('star-rating', trailingslashit(get_template_directory_uri()) . 'js/star-rating.js', false, false, true);
wp_enqueue_script('star-rating');
wp_enqueue_script('adforest-search');

if (have_posts())
{
    while (have_posts())
    {
        the_post();
        $aid = get_the_ID();
        // Make expired to featured ad

        $expiry_days = '-1';
        $package_ad_expiry_days = get_post_meta($aid, 'package_ad_expiry_days', true);
        if (isset($package_ad_expiry_days) && $package_ad_expiry_days != '')
        {
            $expiry_days = $package_ad_expiry_days;
        }
        else if (isset($adforest_theme['simple_ad_removal']) && $adforest_theme['simple_ad_removal'] != '')
        {
            $expiry_days = $adforest_theme['simple_ad_removal'];
        }
        else
        {
        }

        if($expiry_days != '-1'){

            $now = time(); // or your date as well
            $simple_date = strtotime(get_the_date('Y-m-d'));
            $simple_days = adforest_days_diff($now, $simple_date);            
            $after_expired_ads = isset($adforest_theme['after_expired_ads']) && !empty($adforest_theme['after_expired_ads']) ? $adforest_theme['after_expired_ads'] : 'trashed';
            if ($after_expired_ads == 'expired')
            { 
                if ($simple_days > $expiry_days)
                {
                    update_post_meta($aid, '_adforest_ad_status_', 'expired');
                    $my_post = array(
                        'ID' => $aid,
                        'post_status' => 'draft',
                        'post_type' => 'ad_post',
                    );
                    wp_update_post($my_post);
                }
            }
            else
            {
                if ($simple_days > $expiry_days)
                {
                    wp_trash_post($aid);
                }
            }
        }

        $featured_expiry_days = '-1';
        $package_adFeatured_expiry_days = get_post_meta($aid, 'package_adFeatured_expiry_days', true);
        if (isset($package_adFeatured_expiry_days) && $package_adFeatured_expiry_days != '')
        {
            $featured_expiry_days = $package_adFeatured_expiry_days;
        }
        else if (isset($adforest_theme['featured_expiry']) && $adforest_theme['featured_expiry'] != '')
        {
            $featured_expiry_days = $adforest_theme['featured_expiry'];
        }

        if (get_post_meta($aid, '_adforest_is_feature', true) == '1' && $featured_expiry_days != '-1')
        {
            if (isset($featured_expiry_days) && $featured_expiry_days != '-1')
            {
                $now = time(); // or your date as well
                $featured_date = strtotime(get_post_meta($aid, '_adforest_is_feature_date', true));

                $featured_days = adforest_days_diff($now, $featured_date);
                if ($featured_days > $featured_expiry_days)
                {
                    update_post_meta($aid, '_adforest_is_feature', 0);
                }
            }
        }


        adforest_setPostViews($aid);

        if (isset($adforest_theme['design_type']) && $adforest_theme['design_type'] == 'modern')
        {
            get_template_part('template-parts/layouts/ad_style/style', $adforest_theme['ad_layout_style_modern']);
        }
        else
        {
            get_template_part('template-parts/layouts/ad_style/style', $adforest_theme['ad_layout_style']);
        }
    }
}
else
{
    get_template_part('template-parts/content', 'none');
}
get_footer();
?>