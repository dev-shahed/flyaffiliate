<?php
/**
 * Plugin Name: FlyAffiliate e2e — test helpers
 * Description: Written by tests/pw (global-setup.ts). Logs PHP errors to wp-content/pw-php.log, records outgoing mail instead of sending it (option `pw_mail_log`), and registers a "PW Bank" payout method that always reports missing details (while the option `pw_bank_on` is set). Never install it on a real site.
 *
 * @package FlyAffiliate\Tests
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Every PHP notice, warning, deprecation and fatal, whatever WP_DEBUG_LOG says.
ini_set( 'log_errors', '1' ); // phpcs:ignore WordPress.PHP.IniSet.Risky
ini_set( 'error_log', WP_CONTENT_DIR . '/pw-php.log' ); // phpcs:ignore WordPress.PHP.IniSet.log_errors_Disallowed
error_reporting( E_ALL ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions.prevent_path_disclosure_error_reporting

// Mail: recorded, never sent.
add_filter(
	'pre_wp_mail',
	static function ( $short, $atts ) {
		$log   = (array) get_option( 'pw_mail_log', [] );
		$log[] = [
			'to'      => is_array( $atts['to'] ) ? implode( ',', $atts['to'] ) : (string) $atts['to'],
			'subject' => (string) $atts['subject'],
			'message' => (string) $atts['message'],
		];
		update_option( 'pw_mail_log', $log, false );
		return true;
	},
	10,
	2
);

// A payout method that can never pay anyone: its check always fails, so the
// payout preview shows its warning and the "Switch to Manual" button. Only
// while the option `pw_bank_on` is set, so other specs see Manual alone.
add_filter(
	'flyaffiliate_payout_methods',
	static function ( $methods ) {
		if ( ! get_option( 'pw_bank_on' ) ) {
			return $methods;
		}
		if ( ! class_exists( 'PW_Bank_Method' ) && class_exists( '\FlyAffiliate\Abstracts\PayoutMethod' ) ) {
			eval( // phpcs:ignore Squiz.PHP.Eval.Discouraged -- test fixture: the parent class exists only once FlyAffiliate has loaded.
				'class PW_Bank_Method extends \FlyAffiliate\Abstracts\PayoutMethod {
					public function get_id(): string { return "pwbank"; }
					public function get_label(): string { return "PW Bank"; }
					public function check_affiliate( \FlyAffiliate\Models\Affiliate $affiliate ) {
						return new WP_Error( "pw_missing", "PW Bank account missing." );
					}
				}'
			);
		}
		if ( class_exists( 'PW_Bank_Method' ) ) {
			$methods['pwbank'] = new PW_Bank_Method();
		}
		return $methods;
	}
);
