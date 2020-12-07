<?php
	
	if (!defined('ABSPATH')) {
		die();
	}
	
	global $PFApi;
	
	include_once (PHOTOFEED_PATH . 'app/includes/functions.php');
	include_once (PHOTOFEED_PATH . 'app/includes/PFIGAPI.php');
	
	$PFApi = new PFIGAPI();
	
	
    // handle preview gallery request
	add_action('wp_ajax_pfa_preview_gallery', function () {
		if (!check_admin_referer('pfds-form-nonce')) {
			wp_send_json_error(__('Invalid Request.', 'photo-feed'));
		}
		wp_send_json_success(cb_shortcode_photofeed());
	});
	
	
	
	// handle admin requests
	add_action('admin_init', function () {
		if (!current_user_can('administrator')) {
			return;
		}
		
		// handle profile actions
		if (isset($_POST['pfa-profile-action']) && check_admin_referer('pfa-request')) {
			$action = filter_input(INPUT_POST, 'pfa-profile-action', FILTER_SANITIZE_STRING);
			switch ($action) {
				case 'remove':
				delete_option('photofeed_settings');
				$GLOBALS['pfa-message'] = __('Instagram account disconnected.', 'photo-feed');
				break;
				case 'cache':
				pf_clearTransients();
				$GLOBALS['pfa-message'] = __('Data refreshed successfully.', 'photo-feed');
				break;
			}
		}
	});
	
	// save token
	add_action('admin_init', function (){
		if (!current_user_can('administrator')) {
			return;
		}
		$pfitrs = 'photofeed'.'-pfatret';
		$igpanel = admin_url('options-general.php?page=photo-feed');
		if (isset($_GET[$pfitrs])) {		
			if (!empty($_GET['ig_access_token'])) {
				$token = filter_var($_GET['ig_access_token'], FILTER_SANITIZE_STRING);
				if ($token) {
					global $PhotoFeedSettings;
					if (!$PhotoFeedSettings || !is_array($PhotoFeedSettings)) {
						$PhotoFeedSettings = get_option('photofeed_settings');
					}
					
					// check again for empty string
					if (empty($PhotoFeedSettings)) {
						$PhotoFeedSettings = [];
					}
					
					$PhotoFeedSettings['access_token'] = $token;
			
					$atexpts = 0;
					if (isset($_GET['ig_atexpin'])) {
						$atexpin = filter_var($_GET['ig_atexpin'], FILTER_VALIDATE_INT);
						if($atexpin && ($atexpin > 86400)){
							$atexpts = strtotime("+ {$atexpin} seconds");
						}
					}
					$PhotoFeedSettings['atexpts'] = $atexpts;
					
					if (!isset($PhotoFeedSettings['DisplaySettings'])) {
						$PFFFs = ig_defaultGSettings();
						$PhotoFeedSettings['DisplaySettings'] = $PFFFs;
					}
					
					update_option('photofeed_settings', $PhotoFeedSettings, false);
					pf_clearTransients();
					
					if ( wp_redirect( $igpanel ) ) {
						exit;
					}
				}
			}
			
			// redirect to admin dashboard
			if (!empty($_GET['ig_message'])) {
				exit(filter_var($_GET['ig_message'], FILTER_SANITIZE_STRING));
			} else {
				if ( wp_redirect( $igpanel ) ) {
					exit;
				}
			}
			
		}
	});					