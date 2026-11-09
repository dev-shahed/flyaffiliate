<?php
/**
 * What a settings save refuses.
 *
 * @package FlyAffiliate\Test
 */

namespace FlyAffiliate\Test\Admin;

use FlyAffiliate\Test\FlyAffiliateTestCase;

/**
 * A value a field cannot hold is refused with 400 and nothing is stored (ADR-0010).
 */
class SettingsValidationTest extends FlyAffiliateTestCase {

	/**
	 * A WordPress query variable cannot become the referral variable: with `p`,
	 * every plain post link would credit the affiliate whose id matches the post.
	 *
	 * @return void
	 */
	public function test_a_wordpress_query_variable_cannot_be_the_referral_variable(): void {
		foreach ( [ 'p', 's', 'page_id', 'name', 'cat', 'author', 'year', 'posts_per_page' ] as $reserved ) {
			$result = flyaffiliate()->settings->save( [ 'referral_variable' => $reserved ] );

			$this->assertWPError( $result, $reserved );
			$this->assertSame( 400, $result->get_error_data()['status'], $reserved );
			$this->assertArrayHasKey( 'referral_variable', $result->get_error_data()['errors'], $reserved );
			$this->assertSame( 'affiliate', flyaffiliate_get_option( 'referral_variable' ), $reserved );
		}

		foreach ( [ 'ref', 'aff', 'partner_id', 'affiliate' ] as $allowed ) {
			$this->assertNotWPError( flyaffiliate()->settings->save( [ 'referral_variable' => $allowed ] ), $allowed );
			$this->assertSame( $allowed, flyaffiliate_get_option( 'referral_variable' ) );
		}
	}
}
