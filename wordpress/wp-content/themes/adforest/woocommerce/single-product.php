<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $adforest_theme;
if ( isset( $adforest_theme['shop-turn-on'] ) && $adforest_theme['shop-turn-on'] ) {
	get_header( 'shop' );
	/**
	 * woocommerce_before_main_content hook.
	 *
	 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
	 * @hooked woocommerce_breadcrumb - 20
	 */
	do_action( 'woocommerce_before_main_content' );
	?>
    <section class="section-padding modern-version description-product">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-xs-12 col-sm-12">
					<?php while ( have_posts() ) : ?>
						<?php the_post(); ?>
						<?php wc_get_template_part( 'content', 'single-product' ); ?>
					<?php endwhile; // end of the loop. ?>
                </div>

                <div class="col-md-4 col-xs-12 col-sm-12">
                    <div class="sidebar">
						<?php if ( is_active_sidebar( 'adforest_woocommerce_widget' ) ) : ?>
							<?php dynamic_sidebar( 'adforest_woocommerce_widget' ); ?>
						<?php endif; ?>
                    </div>
                </div>
				<?php
				/**
				 * woocommerce_after_main_content hook.
				 *
				 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
				 */
				do_action( 'woocommerce_after_main_content' );
				?>
            </div>
        </div>
    </section>
	<?php
	get_footer();
} else {
	$sb_packages_page = apply_filters( 'adforest_language_page_id', $adforest_theme['sb_packages_page'] );
	wp_redirect( get_the_permalink( $sb_packages_page ) );
	exit;
}
