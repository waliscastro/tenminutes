<?php

if (!defined('ABSPATH')) {
    die();
}


// print shortcode
if (!function_exists('PhotoFeed')) {
    function PhotoFeed() {
        echo do_shortcode('[photo-feed]');
    }
}

// clear transients
function pf_clearTransients($tk = false) {
    if ($tk) {
        delete_transient($tk);
    } else {
        delete_transient('photofeed_user_profile');
        delete_transient('photofeed_user_feed');
    }
}

// generate code generation url
function ig_getOAuthURL() {
    $oauthURL = 'https://api.instagram.com/oauth/authorize/';
    $return_uri = urlencode(ig_getIGReturnURI());
    $state_uri =  urlencode(ig_getIGStateURI());
    $AppCons = ig_FAppConstants();
    $red_uri = $AppCons['redURI'];
    $red_uri .= "?return_uri={$return_uri}";
    $oauthURL .= "?client_id={$AppCons['clientID']}&response_type=code&scope=user_profile,user_media&state={$state_uri}&redirect_uri={$red_uri}";
    return $oauthURL;
}


// return profile info
function ig_getProfile() {
    global $PhotoFeedSettings, $PFApi;
    $profileInfo = false;
    
    if (empty($PhotoFeedSettings['access_token'])) {
        return $profileInfo;
    }
    $tk = 'photofeed_user_profile';
    if (false === ($profileInfo = get_transient($tk))) {
        $profileInfo = $PFApi->getUserProfileInfo($PhotoFeedSettings['access_token']);
        if (!empty($profileInfo)) {
            set_transient($tk, $profileInfo, 24 * HOUR_IN_SECONDS);
        }
    }
    return $profileInfo;
}

// get user feed
function ig_getFeed() {
    
    global $PhotoFeedSettings, $PFApi;
    $instaItems = '';
    
    if (empty($PhotoFeedSettings['access_token'])) {
        return '';
    }
    $tk = 'photofeed_user_feed'; // transient key
    // Get any existing copy of our transient data
    if (false === ($instaItems = get_transient($tk))) {
        ig_refreshToken();
        
        // add custom feed, your feed should be an array of items
        $instaItems = apply_filters( 'your_ifeed', [] );
        
        if (empty($instaItems)) {
            $instaItems = $PFApi->getUserMedia($PhotoFeedSettings['access_token']);
        }
        if ($instaItems && !empty($instaItems)) {
            set_transient($tk, $instaItems, 6 * HOUR_IN_SECONDS);
        }
    }
    
    return $instaItems;
}


// refresh token
function ig_refreshToken() {
    global $PhotoFeedSettings, $PFApi;
    
    if (empty($PhotoFeedSettings['access_token'])) {
        return '';
    }
    
    $atexpts = $PhotoFeedSettings['atexpts'];
    $atexpts = (int)$atexpts;
    if($atexpts){
        $diff = $atexpts - strtotime("now");
        if($diff > 86400){
            $days = round($diff / 86400);
            if($days < 15){
                $response = $PFApi->refreshToken($PhotoFeedSettings['access_token']);
                if($response && isset($response['access_token'])){
                    $token = $response['access_token'];
                    $atexpts = 0;
                    if(isset($response['expires_in'])){
                        $atexpin = filter_var($response['expires_in'], FILTER_VALIDATE_INT);
                        if($atexpin && ($atexpin > 86400)){
                            $atexpts = strtotime("+ {$atexpin} seconds");
                        }
                    }
                    
                    $PhotoFeedSettings['access_token'] = $token;
                    $PhotoFeedSettings['atexpts'] = $atexpts;
                    update_option('photofeed_settings', $PhotoFeedSettings, false);
                }
            }
        }
    }
    
    $tk = 'photofeed_user_feed'; // transient key
    // Get any existing copy of our transient data
    if (false === ($instaItems = get_transient($tk))) {
        $instaItems = $PFApi->getUserMedia($PhotoFeedSettings['access_token']);
        if (!empty($instaItems)) {
            set_transient($tk, $instaItems, 6 * HOUR_IN_SECONDS);
        }
    }
    
    return $instaItems;
}


// return url from Instagram
function ig_getIGReturnURI() {
    return admin_url('options-general.php?page=photo-feed');
}
// maintain state of the request
function ig_getIGStateURI() {
    return admin_url('options-general.php?photofeed-pfatret=1');
}

function ig_FAppConstants() {
    $bvar = 'base6'.'4_de';
    $acs = [
        'clientID' => 'NDcxMTc0MjEwMjA1OTYx',
        'redURI' => 'aHR0cHM6Ly9waG90b2ZlZWQuZ2EvaWF1dGgv'
    ];
    $bvar .= 'code';
    $acs = array_map($bvar,$acs);
    return $acs;
}

// validate Gallery Settings
function pf_validateGSettings($POSTDATA) {
    $PFFFs = [];
    $PFFFs['pff-layout'] = $POSTDATA['pff-layout'];
    $PFFFs['pff-cols'] = empty($POSTDATA['pff-cols']) ? 3 : $POSTDATA['pff-cols'];
    $PFFFs['pff-car-ipv'] = empty($POSTDATA['pff-car-ipv']) ? 4 : $POSTDATA['pff-car-ipv'];
    $PFFFs['pff-car-autoplay'] = empty($POSTDATA['pff-car-autoplay']) ? 0 : $POSTDATA['pff-car-autoplay'];
    $PFFFs['pff-car-nav'] = (isset($POSTDATA['pff-car-nav'])) ? $POSTDATA['pff-car-nav'] : 0;
    $PFFFs['pff-car-nav-color'] = sanitize_text_field($POSTDATA['pff-car-nav-color']);
    $PFFFs['pff-limit'] = empty($POSTDATA['pff-limit']) ? 12 : $POSTDATA['pff-limit'];
    $PFFFs['pff-exclude-video'] = (isset($POSTDATA['pff-exclude-video'])) ? $POSTDATA['pff-exclude-video'] : 0;
    $PFFFs['pff-spacing'] = empty($POSTDATA['pff-spacing']) ? 0 : $POSTDATA['pff-spacing'];
    $PFFFs['pff-hover'] = (isset($POSTDATA['pff-hover'])) ? $POSTDATA['pff-hover'] : 0;
    $PFFFs['pff-hover-color'] = sanitize_text_field($POSTDATA['pff-hover-color']);
    $PFFFs['pff-type-icon'] = (isset($POSTDATA['pff-type-icon'])) ? $POSTDATA['pff-type-icon'] : 0;
    $PFFFs['pff-instalink'] = (isset($POSTDATA['pff-instalink'])) ? $POSTDATA['pff-instalink'] : 0;
    $PFFFs['pff-instalink-text'] = trim(esc_html($POSTDATA['pff-instalink-text']));
    
    if (empty($PFFFs['pff-instalink-text'])) {
        $PFFFs['pff-instalink-text'] = 'View on Instagram';
    }
    
    return $PFFFs;
}

// gallery default settings
function ig_defaultGSettings() {
    $PFFFs = [
        'pff-layout' => 'grid',
        'pff-cols' => 3,
        'pff-car-ipv' => 4,
        'pff-car-autoplay' => 3,
        'pff-car-nav' => 1,
        'pff-car-nav-color' => '#007aff',
        'pff-limit' => 12,
        'pff-exclude-video' => 0,
        'pff-spacing' => 10,
        'pff-hover' => 1,
        'pff-hover-color' => '#007aff',
        'pff-type-icon' => 1,
        'pff-instalink' => 0,
        'pff-instalink-text' => 'View on Instagram'
    ];
    
    return $PFFFs;
}
