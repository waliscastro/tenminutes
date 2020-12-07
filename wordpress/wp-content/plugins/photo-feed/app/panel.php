<?php
if (!defined('ABSPATH')) {
    die();
}
/*
 * plugin settings page
 */
global $PhotoFeedSettings;
$PhotoFeedSettings = get_option('photofeed_settings');

$ig_msgs = [];
// update gallery
if (isset($_POST['pfds-form-update']) && check_admin_referer('pfds-form-nonce')) {
    // filtering data
    $POSTDATA = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    // Form Fields
    $PFFFs = pf_validateGSettings($POSTDATA);
    $PhotoFeedSettings['DisplaySettings'] = $PFFFs;
    update_option('photofeed_settings', $PhotoFeedSettings, false);

    $ig_msgs[] = __('Gallery updated successfully.', 'photo-feed');
}
?>
<div id="photofeed-page" class="wrap">
    <header class="pfa-page-header">
        <h3><?php _e('Photo Feed', 'photo-feed'); ?></h3>
    </header>
    <div class="photofeed-page-content">
        <?php
        if (!empty($ig_msgs)) {
            foreach ($ig_msgs as $ig_msg) {
                echo '<div class="notice updated is-dismissible" ><p>' . $ig_msg . '</p></div>';
            }
        }
        
        if(isset($GLOBALS['pfa-message']) && !empty($GLOBALS['pfa-message'])){
            echo '<div class="notice updated is-dismissible" ><p>' . $GLOBALS['pfa-message'] . '</p></div>';
        }
                
        if (empty($PhotoFeedSettings['access_token'])) {
            include 'views/new-account.php';
        } else {
            include 'views/account.php';
            include 'views/gallery.php';
        }
        ?>
    </div>
</div>

