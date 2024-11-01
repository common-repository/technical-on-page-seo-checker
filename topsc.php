<?php
/*
Plugin Name: SEO Checker
Plugin URI: https://wpza.net/developer-plugins/seo-checker/
Description: SEO Checker Helps WordPress Website Pages Rank Better In Search Engines.
Version: 1.0.2
Author: WPZA
Author URI: https://www.wpza.net/
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/
defined( 'ABSPATH' ) or die();

if( ! class_exists( 'topsc_init' ) ) {
	final class topsc_init {
		public function __construct() {
			$this->topsc_defineConstants();
			$this->topsc_includes();
		}

		private function topsc_defineConstants() {
			define( 'topsc_dir', __DIR__ );
			define( 'topsc_fullName', 'SEO Checker' );
		}

		private function topsc_includes() {
			$topsc_dir = scandir( topsc_dir . '/includes' );
			if( $topsc_dir ) {
				foreach( $topsc_dir as $topsc_module ) {
					$topsc_path = topsc_dir . '/includes';
					if( $topsc_path && substr( $topsc_module, 0, 1 ) !== '.' ) {
						$topsc_file = '/' . $topsc_module;
						if( is_readable( $topsc_path . $topsc_file ) ) {
							include_once( $topsc_path . $topsc_file );
						}
					}
				}
			}
		}
	}
}
new topsc_init();