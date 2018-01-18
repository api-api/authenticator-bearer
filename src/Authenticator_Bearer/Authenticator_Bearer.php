<?php
/**
 * Authenticator_Bearer class
 *
 * @package APIAPI\Authenticator_Bearer
 * @since 1.0.0
 */

namespace APIAPI\Authenticator_Bearer;

use APIAPI\Core\Authenticators\Authenticator;
use APIAPI\Core\Request\Route_Request;
use APIAPI\Core\Exception\Request_Authentication_Exception;

if ( ! class_exists( 'APIAPI\Authenticator_Bearer\Authenticator_Bearer' ) ) {

	/**
	 * Authenticator implementation for Bearer Authentication.
	 *
	 * @since 1.0.0
	 */
	class Authenticator_Bearer extends Authenticator {
		/**
		 * Authenticates a request.
		 *
		 * This method does not yet actually authenticate the request with the server. It only sets
		 * the required values on the request object.
		 *
		 * @since 1.0.0
		 *
		 * @param Route_Request $request The request to send.
		 *
		 * @throws Request_Authentication_Exception Thrown when the request cannot be authenticated.
		 */
		public function authenticate_request( Route_Request $request ) {
			$data = $this->parse_authentication_data( $request );

			if ( empty( $data['token'] ) ) {
				throw new Request_Authentication_Exception( sprintf( 'The request to %s could not be authenticated as a token has not been passed.', $request->get_uri() ) );
			}

			$request->set_header( 'Authorization', 'Bearer ' . $data['token'] );
		}

		/**
		 * Checks whether a request is authenticated.
		 *
		 * This method does not check whether the request was actually authenticated with the server.
		 * It only checks whether authentication data has been properly set on it.
		 *
		 * @since 1.0.0
		 *
		 * @param Route_Request $request The request to check.
		 * @return bool True if the request is authenticated, otherwise false.
		 */
		public function is_authenticated( Route_Request $request ) {
			$data = $this->parse_authentication_data( $request );

			$header_value = $request->get_header( 'Authorization' );
			if ( null === $header_value ) {
				return false;
			}

			return 0 === strpos( $header_value, 'Bearer ' );
		}

		/**
		 * Sets the default authentication arguments.
		 *
		 * @since 1.0.0
		 */
		protected function set_default_args() {
			$this->default_args = array(
				'token'       => '',
			);
		}
	}

}
