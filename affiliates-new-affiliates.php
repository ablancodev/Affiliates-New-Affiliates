<?php
/*
Plugin Name: Affiliates new affiliates
Plugin URI: http://www.eggemplo.com
Description: Add a new referral when a new affiliates is added.
Author: eggemplo
Version: 1.0
Author URI: http://www.eggemplo.com
*/

class AffiliatesNewAffiliates_Plugin {

	public static function init() {
		add_action( 'init', array( __CLASS__, 'wp_init' ) );
	}

	public static function wp_init () {
		add_action( 'affiliates_added_affiliate', array( __CLASS__, 'affiliates_added_affiliate' ) );
	}

	public static function affiliates_added_affiliate( $aff_id ) {
		$description = sprintf( "New affiliate %d registration", $aff_id );
		$amount = 10;
		$currency_id = "USD";
	
		$affiliate_id = Affiliates_Service::get_referrer_id();
		if ( $affiliate_id ) {
			if ( class_exists( 'Affiliates_Referral_WordPress' ) ) {
				$r = new Affiliates_Referral_WordPress();
				$r->add_referrals( array( $aff_id ), null, $description, null, null, $amount, $currency_id);
			} else {
				affiliates_add_referral( $aff_id, null, $description, null, $amount, $currency_id);
			}
		}
	}
}

AffiliatesNewAffiliates_Plugin::init();
?>
