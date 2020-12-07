<?php get_header(); ?>
<?php global $adforest_theme; ?>
<section class="section-padding error-page pattern-bg ">
<div class="container">
<div class="row">
  <div class="col-md-12 col-xs-12 col-sm-12">
     <div class="error-container">
        <div class="error-text"><?php echo esc_html__( '404', 'adforest' ); ?></div>
        <div class="error-info"><?php echo esc_html__( 'Sorry, this page does not exist.', 'adforest' ); ?></div>
     </div>
  </div>
     </div>
</div>
</section>
<?php get_footer(); ?>