<?php get_header(); ?>
<?php global $adforest_theme; ?>
<div class="main-content-area clearfix">
    <section class="section-padding error-page pattern-bgs gray ">
        <div class="container">
            <div class="row">
                <?php
if (isset($adforest_theme['blog_sidebar']) && $adforest_theme['blog_sidebar'] == 'left') get_sidebar();
?>
                <?php
$blog_type = '';
if (isset($adforest_theme['blog_sidebar']) && $adforest_theme['blog_sidebar'] == 'no-sidebar')
{
    $blog_type = 'col-md-12 col-xs-12 col-sm-12';
}
else
{
    $blog_type = 'col-md-8 col-xs-12 col-sm-12';
}
?>

                <div class="<?php echo esc_attr($blog_type); ?>">
                    <div class="row">
                        <div class="posts-masonry">
                            <?php get_template_part('template-parts/layouts/blog', 'loop'); ?>                       
                        </div>
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <?php adforest_pagination(); ?>
                        </div>
                    </div>
                </div>
                <?php
if (isset($adforest_theme['blog_sidebar']) && $adforest_theme['blog_sidebar'] == 'right') get_sidebar();

if (!isset($adforest_theme['blog_sidebar'])) get_sidebar();
?>
            </div>
        </div>
    </section>
</div>
<?php get_footer(); ?>