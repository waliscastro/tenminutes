<?php
global $adforest_theme;
$class = 'colored-header';
if (isset($adforest_theme['design_type']) && $adforest_theme['design_type'] == 'modern' && isset($adforest_theme['sb_header']) && $adforest_theme['sb_header'] == 'transparent' && is_page_template('page-home.php'))
    $class = 'transparent-header';
?>
<div class="<?php echo esc_attr($class);?>">
    <?php get_template_part('template-parts/layouts/top', 'bar');?>
    <div class="clearfix"></div>
    <div class="sb-white-header">
        <nav id="menu-1" class="mega-menu">
            <section class="menu-list-items">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <ul class="menu-logo"><li><?php get_template_part('template-parts/layouts/site', 'logo');?></li></ul>
                            <?php get_template_part('template-parts/layouts/main', 'nav');?>
                            <ul class="menu-search-bar"><li><?php get_template_part('template-parts/layouts/ad', 'button');?></li></ul>
                        </div>
                    </div>
                </div>      
            </section>
        </nav>
    </div>
</div>