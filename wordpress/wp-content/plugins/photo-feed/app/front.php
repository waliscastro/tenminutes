<?php

if (!defined('ABSPATH')) {
    die();
}


// Registering assets
add_action('wp_enqueue_scripts', 'photofeed_enqueue_scripts');

function photofeed_enqueue_scripts() {
	
	global $PhotoFeedSettings;
	$layout = '';
	if(! $PhotoFeedSettings){
		$PhotoFeedSettings = get_option('photofeed_settings');
	}
	if (isset($PhotoFeedSettings['DisplaySettings']) && !empty($PhotoFeedSettings['DisplaySettings']['pff-layout'])) {
        $layout = $PhotoFeedSettings['DisplaySettings']['pff-layout'];
    }
	if($layout == 'carousel'){
		wp_enqueue_style('swiper', PHOTOFEED_URL . '/assets/swiper/swiper.min.css', [], PHOTOFEED_VER);
        wp_enqueue_script('swiper', PHOTOFEED_URL . '/assets/swiper/swiper.min.js', ['jquery'], PHOTOFEED_VER, true);
	}
	
	$suffix = ( defined('WP_DEBUG') && WP_DEBUG ) ? '' : '.min';
    wp_enqueue_style('photo-feed', PHOTOFEED_URL . '/assets/style'. $suffix .'.css', [], PHOTOFEED_VER);
}

// shortcode
add_shortcode('photo-feed', 'cb_shortcode_photofeed');

// shortcode callback
function cb_shortcode_photofeed() {
    global $PhotoFeedSettings, $PFApi;
    $PhotoFeedSettings = get_option('photofeed_settings');

    $results = '';
    if (!isset($PhotoFeedSettings['access_token']) || empty($PhotoFeedSettings['access_token'])) {
        if (current_user_can('administrator')) {
            $results .= '<div class="photofeed-no-token">';
            $results .= '<p>' . __('please connect an Instagram account in Photo Feed settings panel.', 'photo-feed') . '</p>';
            $results .= '</div>';
        }
        return $results;
    }

    if (!isset($PhotoFeedSettings['DisplaySettings']) || empty($PhotoFeedSettings['DisplaySettings'])) {
        if (current_user_can('administrator')) {
            $results .= '<div class="photofeed-no-token">';
            $results .= '<p>' . __('please configure gallery settings first.', 'photo-feed') . '</p>';
            $results .= '</div>';
        }
        return $results;
    }

    // Display Settings
    $PFDS = $PhotoFeedSettings['DisplaySettings'];
	
	// filter settings
	$PFDS = apply_filters( 'photo_feed_display_settings', $PFDS );
	
    if(isset($_REQUEST['pfds-form-update-preview'])){
        $POSTDATA = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $iGPFFs = pf_validateGSettings($POSTDATA);
        $PFDS = array_merge($PFDS, $iGPFFs);
    }
    
    $ifeed = ig_getFeed();
    $iprofile = ig_getProfile();
	
	// filter results
	$ifeed = apply_filters( 'photo_feed_items', $ifeed );

	
	
    $results .= '<div class="photo-feed-block">';
        
    if (!empty($ifeed)) {
		$tpl = 'grid';
		if (!empty($PFDS['pff-layout'])) {
			$tpl = $PFDS['pff-layout'];
		}
        ob_start();
		include (PHOTOFEED_PATH . "templates/{$tpl}.php");
        $results .= ob_get_clean();
    } else {
        if (current_user_can('administrator')) {
            $results .= '<div class="photo-feed-no-items-msg">';
            $msg = $PFApi->getMessage();
            if (!empty($msg)) {
                $results .= '<p>' . $msg . '</p>';
            }
            $results .= '</div>';
        }
    }


    $results .= '</div> <!-- // Gallery Block -->';
    return $results;
}
