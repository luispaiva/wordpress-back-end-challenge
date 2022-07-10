<?php
/**
 * Auth Route WordPress Back-end Challenge.
 *
 * PHP version 7.4
 *
 * @category Challenge
 * @package  WP_Backend_Challenge
 * @author   Luis Paiva <contato@luispaiva.com.br>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/luispaiva/wordpress-back-end-challenge
 */

namespace App\Routes;

/**
 * Auth Route Class.
 *
 * @category Challenge
 * @package  WP_Backend_Challenge
 * @author   Luis Paiva <contato@luispaiva.com.br>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/luispaiva/back-end-challenge/tree/luis-paiva
 */
class Auth {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'register_routes' ) );
	}

	/**
	 * Register routes.
	 */
	public function register_routes() {
		register_rest_route(
			'apiki/challenge',
			'/login',
			array(
				'methods'  => \WP_REST_Server::CREATABLE,
				'callback' => function ( \WP_REST_Request $request ) {
					return ( new \App\Controllers\Auth() )->login( $request );
				},
				'args'     => array(
					'username' => array(
						'required'          => true,
						'sanitize_callback' => 'sanitize_text_field',
					),
					'password' => array(
						'required'          => true,
						'sanitize_callback' => 'sanitize_text_field',
					),
				),
			)
		);
	}
}
