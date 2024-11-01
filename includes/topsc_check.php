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

/* AJAX to check on-page SEO */
function topsc_check() {
	$topsc_postId = filter_var( $_POST['topsc_postId'], FILTER_SANITIZE_NUMBER_INT );
	$topsc_postRequestContent = wp_safe_remote_post( get_permalink( $topsc_postId ) );
   	$topsc_postContent = $topsc_postRequestContent['body'];
    $topsc_check_labels = array(
		'Meta robots allowed',
		'Meta title',
		'Meta description',
		'One H1 tag',
		'H2 tag',
		'Alt text',
		'Responsive design',
		'No inline CSS',
		'Google Analytics',
		'Favicon',
		'SSL check',
		'HTTPS redirect',
		'WWW redirect',
		'One article tag',
		'Schema markup',
		'Secure links',
		'Broken links',
		'Redirected links'
	);

    $topsc_iconTick = '<span class="dashicons dashicons-thumbs-up" style="color: #52E4A7;"></span>';
    $topsc_iconCross = '<span class="dashicons dashicons-thumbs-down"></span>';
    $topsc_iconNA = '<span class="dashicons dashicons-no"></span>';

	// Meta Robots
	if ( ! strpos( $topsc_postContent, 'noindex' ) ) {
		$topsc_checks['meta_robots'] = $topsc_iconTick;
	} else {
		$topsc_checks['meta_robots'] = $topsc_iconCross;
	}
	// Meta Title
	if ( strpos( $topsc_postContent, '<title>' ) ) {
		$topsc_checks['meta_title'] = $topsc_iconTick;
	} else {
		$topsc_checks['meta_title'] = $topsc_iconCross;
	}
	// Meta Descriotion
	if ( strpos( $topsc_postContent, '<meta name="description"' ) ) {
		$topsc_checks['meta_description'] = $topsc_iconTick;
	} else {
		$topsc_checks['meta_description'] = $topsc_iconCross;
	}
	// One H1 Tag
	if ( strpos( $topsc_postContent, '<h1' ) ) {
		$topsc_checks['one_h1_tag'] = $topsc_iconTick;
		preg_match_all( '/<h1/', $topsc_postContent, $topsc_oneHOneTagMatches );
		if ( count( $topsc_oneHOneTagMatches[0] ) > 1 ) {
			$topsc_checks['one_h1_tag'] = $topsc_iconCross;
		}
	} else {
		$topsc_checks['one_h1_tag'] = $topsc_iconCross;
	}
	// H2 Tag
	if ( strpos( $topsc_postContent, '<h2' ) ) {
		$topsc_checks['h2_tag'] = $topsc_iconTick;
	} else {
		$topsc_checks['h2_tag'] = $topsc_iconCross;
	}
	// Alt Text
	if ( strpos( $topsc_postContent, '<img' ) || strpos( $topsc_postContent, '<amp-img' ) ) {
		if ( strpos( $topsc_postContent, 'alt=' ) !== false ) {
			$topsc_checks['alt_text'] = $topsc_iconTick;
			if ( strpos( $topsc_postContent, 'alt=""' ) ) {
				$topsc_checks['alt_text'] = $topsc_iconCross;
			}
		} else {
			$topsc_checks['alt_text'] = $topsc_iconCross;
		}
	} else {
		$topsc_checks['alt_text'] = $topsc_iconNA;
	}
	// Responsive Design
	if ( strpos( $topsc_postContent, '<meta name="viewport"' ) ) {
		$topsc_checks['responsive_design'] = $topsc_iconTick;
	} else {
		$topsc_checks['responsive_design'] = $topsc_iconCross;
	}
	// No Inline CSS
	if ( ! strpos( $topsc_postContent, 'style=' ) ) {
		$topsc_checks['no_inline_css'] = $topsc_iconTick;
	} else {
		$topsc_checks['no_inline_css'] = $topsc_iconCross;
	}
	// Google Analytics
	if ( preg_match( '/UA-\d/i', $topsc_postContent ) ) {
		$topsc_checks['google_analytics'] = $topsc_iconTick;
	} else {
		$topsc_checks['google_analytics'] = $topsc_iconCross;
	}
	// Favicon
	if ( strpos( $topsc_postContent, ' rel="icon' ) || strpos( $topsc_postContent, ' rel="shortcut' ) ) {
		$topsc_checks['favicon'] = $topsc_iconTick;
	} else {
		$topsc_checks['favicon'] = $topsc_iconCross;
	}
	// SSL Check
	if ( strpos( get_permalink( $topsc_postId ), 'https://' ) !== false ) {
		$topsc_checks['ssl_check'] = $topsc_iconTick;
	} else {
		$topsc_checks['ssl_check'] = $topsc_iconCross;
	}
	// HTTPS Redirect
	$topsc_httpsRedirectResponse = wp_remote_retrieve_response_code( wp_remote_head( str_replace( 'https://', 'http://', get_permalink( $topsc_postId ) ) ) );
	if ( $topsc_httpsRedirectResponse == 301 ) {
		$topsc_checks['https_redirect'] = $topsc_iconTick;
	} else {
		$topsc_checks['https_redirect'] = $topsc_iconCross;
	}
	// WWW Redirect	
	$topsc_withoutWWW = wp_remote_retrieve_response_code( wp_remote_head( str_replace( '://www.', '://', get_permalink( $topsc_postId ) ) ) );
	if ( ! strpos( get_permalink( $topsc_postId ), '://www.' ) ) {
		$topsc_withWWW = wp_remote_retrieve_response_code( wp_remote_head( str_replace( '://', '://www.', get_permalink( $topsc_postId ) ) ) );
	} else {
		$topsc_withWWW = wp_remote_retrieve_response_code( wp_remote_head( get_permalink( $topsc_postId ) ) );
	}
	if ( $topsc_withoutWWW !== $topsc_withWWW ) {
		$topsc_checks['www_redirect'] = $topsc_iconTick;
	} else {
		$topsc_checks['www_redirect'] = $topsc_iconCross;
	}
	// One Article Tag
	if ( strpos( $topsc_postContent, '<article' ) ) {
		$topsc_checks['one_article_tag'] = $topsc_iconTick;
		preg_match_all( '/<article/', $topsc_postContent, $topsc_oneArticleTagMatches );
		if ( count( $topsc_oneArticleTagMatches[0] ) > 1 ) {
			$topsc_checks['one_article_tag'] = $topsc_iconCross;
		}
	} else {
		$topsc_checks['one_article_tag'] = $topsc_iconNA;
	}
	// Schema Markup
	if ( strpos( $topsc_postContent, 'schema.org' ) ) {
		$topsc_checks['schema_markup'] = $topsc_iconTick;
	} else {
		$topsc_checks['schema_markup'] = $topsc_iconCross;
	}
	// Secure Links + Broken Links + Redirected Links
	preg_match_all( '<a href=\x22(.+?)\x22>', $topsc_postContent, $topsc_contentLinksMatch );
	$topsc_secureLinkCount = 0;
	$topsc_brokenLinkCount = 0;
	$topsc_redirectedLinkCount = 0;
	foreach ( $topsc_contentLinksMatch as $topsc_contentLink ) {
		foreach ( $topsc_contentLink as $topsc_contentLinkFinal ) {
			if ( ! preg_match( '/mailto:/', $topsc_contentLinkFinal ) && ! preg_match( '/tel:/', $topsc_contentLinkFinal ) && ! preg_match( '/fax:/', $topsc_contentLinkFinal ) ) {
				$topsc_contentLinkFinal = str_replace( 'a href=', '', $topsc_contentLinkFinal ); // Remove a href=
				$topsc_contentLinkFinal = str_replace( '"', '', $topsc_contentLinkFinal ); // Remove quotes
				var_dump($topsc_contentLinkFinal);
				if ( strpos( $topsc_contentLinkFinal, 'http://' ) !== false ) {
					$topsc_secureLinkCount++;
				}
				$topsc_contentLinkResponse = wp_remote_retrieve_response_code( wp_remote_head( $topsc_contentLinkFinal ) );
				if ( $topsc_contentLinkResponse == 404 ) {
					$topsc_brokenLinkCount++;
				}
				if ( $topsc_contentLinkResponse == 301 || $topsc_contentLinkResponse == 302 ) {
					$topsc_redirectedLinkCount++;
				}
			}
		}
	}
	if ( $topsc_secureLinkCount == 0 ) {
		$topsc_checks['secure_links'] = $topsc_iconTick;
	} else {
		$topsc_checks['secure_links'] = $topsc_iconCross;
	}
	if ( $topsc_brokenLinkCount == 0 ) {
		$topsc_checks['broken_links'] = $topsc_iconTick;
	} else {
		$topsc_checks['broken_links'] = $topsc_iconCross;
	}
	if ( $topsc_redirectedLinkCount == 0 ) {
		$topsc_checks['redirected_links'] = $topsc_iconTick;
	} else {
		$topsc_checks['redirected_links'] = $topsc_iconCross;
	}

	$topsc_checkCount = -1;
	$topsc_output = '';
	foreach ( $topsc_checks as $topsc_check ) {
		$topsc_checkCount++;
		$topsc_output .= '<tr>';
			$topsc_output .= '<th>' . $topsc_check_labels[$topsc_checkCount] . '</th>';
			$topsc_output .= '<td>' . $topsc_check . '</td>';
		$topsc_output .= '</tr>';
	}
	echo $topsc_output;
	wp_die();
}
add_action( 'wp_ajax_topsc_check', 'topsc_check' );

function topsc_ajax() {
?>
	<script type="text/javascript" >
	jQuery( document ).ready( function( $ ) {
		$( 'td.topsc_check a.button' ).on( 'click', function() {
			$( this ).hide();
			$( this ).after( '<p>Please wait, crawl in progress&hellip;</p>' );
			$( this ).parent().children( 'table.topsc_result' ).fadeIn();
			var data = {
				'action': 'topsc_check',
				'topsc_postId': $( this ).parent().attr( 'data-topsc' )
			};
			jQuery.post( ajaxurl, data, function( response ) {
				$( 'td.topsc_check[data-topsc=' + data['topsc_postId'] + ']' ).html( response );
			} );
		} );
	} );
	</script>
<?php
}
add_action( 'admin_footer', 'topsc_ajax' );