<?php
global $adforest_theme;
$right_col = 'col-md-4 col-xs-12';
if (isset($adforest_theme['design_type']) && $adforest_theme['design_type'] == 'modern') {

$show_mob_filter  = false;
if(isset($adforest_theme['search_design']) && $adforest_theme['search_design'] == 'sidebar')
{
	if(isset($adforest_theme['search_design_sidebar_mob_filter']) && $adforest_theme['search_design_sidebar_mob_filter'] == true)
	{
		$show_mob_filter  = true;
	}
}
    $right_col = 'col-md-3 col-xs-12'; 
} ?>
<div class="<?php echo esc_attr($right_col);?>">
    <div class="sidebar <?php echo adforest_returnEcho($show_mob_filter) ?  'mobile-filters' : ''; ?>">
    	<?php if($show_mob_filter){ ?>
    	<div class="mobile-filter-heading"><?php esc_html_e("Search Filters", "adforest"); ?></div>
    	<a class="btn btn-theme filter-close-btn" href="javascript:void(0);"><i class="fa fa-close"></i></a>
    	<?php }?>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <?php dynamic_sidebar('adforest_search_sidebar');?>
        </div>
    </div>
</div>
	<?php if($show_mob_filter){ ?>
	<div class="mobile-filters-btn">
		<a class="btn btn-theme" href="javascript:void(0);"><?php esc_html_e("Filters", "adforest"); ?><i class="fa fa-filter"></i></a>
	</div>
	<?php }?>