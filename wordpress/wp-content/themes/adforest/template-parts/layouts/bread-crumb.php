<?php
global $adforest_theme, $template;
$page_template = basename($template);
$ad__style = isset($adforest_theme['ad_layout_style_modern']) ? $adforest_theme['ad_layout_style_modern'] : '';
if (is_singular('ad_post'))
{
    if (isset($adforest_theme['ad_layout_style_modern']) && $adforest_theme['ad_layout_style_modern'] == '5')
    {return;}
}
$sb_profile_page = apply_filters('adforest_language_page_id', $adforest_theme['sb_profile_page']);
if (isset($_GET['type']) && ($_GET['type'] == 'ads' || $_GET['type'] == 1))
global $post;
if (basename(get_page_template()) == "page-search.php" && isset($adforest_theme['design_type']) && $adforest_theme['design_type'] == 'modern' && isset($adforest_theme['search_design']) && ($adforest_theme['search_design'] == 'topbar' || $adforest_theme['search_design'] == 'map')){ }
else
{
    if (is_archive() || is_category() || is_tax() || is_author() || is_404() || (isset($sb_profile_page) && $sb_profile_page != get_the_ID()))
    {
        if (isset($adforest_theme['design_type']) && $adforest_theme['design_type'] == 'modern' && isset($adforest_theme['Breadcrumb_type']) && $adforest_theme['Breadcrumb_type'] == 2) { ?>
            <?php } else {
            if ($ad__style != '6') { ?>
                <div class="page-header-area">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="header-page"><h1><?php echo adforest_bread_crumb_heading(); ?></h1></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
    }
}
?>
<?php
$ad__style = isset($adforest_theme['ad_layout_style_modern']) ? $adforest_theme['ad_layout_style_modern'] : '';
$breadcrubme_disable_flag = ($ad__style == '6' && is_singular('ad_post')) ? false : true;
if (basename(get_page_template()) == "page-search.php" && isset($adforest_theme['design_type']) && $adforest_theme['design_type'] == 'modern' && isset($adforest_theme['search_design']) && ($adforest_theme['search_design'] == 'topbar' || $adforest_theme['search_design'] == 'map')) { }
else if (basename(get_page_template()) == "page-search.php" && (is_home() || is_front_page()))
{
    /*new added on 29-06-2020*/
}
else if (isset($sb_profile_page) && ($sb_profile_page != get_the_ID()))
{
    if (isset($adforest_theme['design_type']) && $adforest_theme['design_type'] == 'modern' && isset($adforest_theme['Breadcrumb_type']) && $adforest_theme['Breadcrumb_type'] == 2 && $breadcrubme_disable_flag){
        $transparent_class = isset($adforest_theme['sb_header']) && $adforest_theme['sb_header'] == 'transparent-2' ? 'transparent-bread-4' : '';
        $tg = 'p';
        if ($page_template == 'taxonomy-ad_cats.php' || $page_template == 'taxonomy-ad_country.php' || 'taxonomy-ad_tags.php' == $page_template)
        { $tg = 'h1'; }
    ?>
        <div class="bread-3 page-header-area <?php echo esc_attr($transparent_class); ?>">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="header-page"><<?php echo adforest_returnEcho($tg); ?>><?php echo adforest_bread_crumb_heading(); ?></<?php echo adforest_returnEcho($tg); ?>></div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div class="small-breadcrumb modern-type">
                            <div class=" breadcrumb-link">
                                <ul>
                                    <li><a href="<?php echo home_url('/'); ?>"><?php echo esc_html__('Home', 'adforest'); ?></a></li>
                                    <li class="active"><a href="javascript:void(0);" class="active"><?php echo adforest_breadcrumb(); ?></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php }  else { if ($ad__style != '6') { ?>
            <div class="small-breadcrumb">
                <div class="container">
                    <div class=" breadcrumb-link">
                        <ul>
                            <li><a href="<?php echo home_url('/'); ?>"><?php echo esc_html__('Home', 'adforest'); ?> </a></li>
                            <li class="active"><a href="javascript:void(0);" class="active"><?php echo adforest_breadcrumb(); ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}
?>