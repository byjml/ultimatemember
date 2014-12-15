<?php

class UM_Logout {

	function __construct() {
		
		add_action('template_redirect', array(&$this, 'logout_page'), 10000 );
		
	}
	
	/***
	***	@Logout via logout page
	***/
	function logout_page() {
		if ( um_is_logout_page() ) {
			
			if ( is_user_logged_in() ) {
				
				if ( isset($_REQUEST['redirect_to']) && $_REQUEST['redirect_to'] !== '' ) {
					$redirect = $_REQUEST['redirect_to'];
				} else if ( um_user('after_logout') == 'redirect_home' ) {
					$redirect = home_url();
				} else {
					$redirect = um_user('logout_redirect_url');
				}
				
				wp_logout();
				exit( wp_redirect( $redirect ) );
				
			} else {
				exit( wp_redirect( home_url() ) );
			}
			
		}
	}

}