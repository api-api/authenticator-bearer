<?php
/**
 * Authenticator loader.
 *
 * @package APIAPIAuthenticatorBearer
 * @since 1.0.0
 */

if ( ! function_exists( 'apiapi_register_authenticator_bearer' ) ) {

	/**
	 * Registers the authenticator for Bearer Authentication.
	 *
	 * It is stored in a global if the API-API has not yet been loaded.
	 *
	 * @since 1.0.0
	 */
	function apiapi_register_authenticator_bearer() {
		if ( function_exists( 'apiapi_manager' ) ) {
			apiapi_manager()->authenticators()->register( 'bearer', 'APIAPI\Authenticator_Bearer\Authenticator_Bearer' );
		} else {
			if ( ! isset( $GLOBALS['_apiapi_authenticators_loader'] ) ) {
				$GLOBALS['_apiapi_authenticators_loader'] = array();
			}

			$GLOBALS['_apiapi_authenticators_loader']['bearer'] = 'APIAPI\Authenticator_Bearer\Authenticator_Bearer';
		}
	}

	apiapi_register_authenticator_bearer();

}
