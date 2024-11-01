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

/* Register Settings Page */
if( ! function_exists( 'topsc_home' ) ) {
	function topsc_home() {
		$topsc_icon = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCIKCSB3aWR0aD0iMjVweCIgaGVpZ2h0PSIxNi43NDdweCIgdmlld0JveD0iMCAwIDI1IDE2Ljc0NyIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgMjUgMTYuNzQ3IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPGc+Cgk8cGF0aCBmaWxsPSIjRkZGRkZGIiBkPSJNMjQuNDEzLDEzLjcyNWMtMS40MTUtMC42OTQtMi45NzItMC44NTQtNC40ODYtMS4xNjZjLTAuMDk5LTAuMDIxLTAuMjI5LDAuMDQtMC4zMjUsMC4wOTUKCQljLTEuNywwLjk4LTMuNTk3LDEuMjM4LTUuNDkzLDEuMzY3Yy0yLjA0NiwwLjEzOC00LjA2MS0wLjE3OC02LjAyNy0wLjczM2MwLjAwMi0wLjA4MSwwLjAwNS0wLjE2MiwwLjAwNy0wLjI0MgoJCWMwLjc1LDAuMDg0LDEuNSwwLjE4MSwyLjI1MSwwLjI1MmMyLjIzNywwLjIwOSw0LjQ1LDAuMTQsNi42MTctMC41NDljMC42ODItMC4yMTYsMC45ODMtMC40MzksMC40NDgtMS4xNzMKCQljLTAuNjc4LTAuOTI4LTEuMzUzLTIuMDU1LTEuMDk5LTMuMTUxYzAuMjc3LTEuMTk3LTAuMjIzLTEuNDQ0LTEuMDk2LTEuNjY4Yy0wLjA0MS0wLjAxLTAuMDY0LTAuMDkyLTAuMTA0LTAuMTUzCgkJYzAuNjI1LTAuODQ0LDEuNDc4LTEuMDA1LDIuNDIxLTAuNzMxYzAuNjk5LDAuMjAzLDEuMzc2LDAuNDg5LDIuMDUzLDAuNzYyYzAuOTQ3LDAuMzgzLDEuODU4LDEuMDEyLDMuMDMyLDAuMwoJCWMtMS4yMjIsMC42NDItMC45MTEsMS43NzItMS4xLDIuNzE1Yy0wLjExMSwwLjU1NCwwLjEyOCwwLjcxMiwwLjYyNiwwLjQ5NGMxLjY2OS0wLjcyOSwyLjMxOS0zLjc1NCwxLjA2OC01LjA2MgoJCWMtMS4xMDYtMS4xNTYtMi40MjQtMi4wMjQtMy44ODEtMi42ODhjLTAuNDM3LTAuMTk5LTAuODExLTAuMTg3LTEuMjM0LDAuMDY2Yy0wLjY0NiwwLjM4Ni0xLjMxNiwwLjc1Ny0yLjE0NywwLjc3OQoJCWMwLjA4NC0wLjQwMSwwLjM2Mi0wLjU0NiwwLjU2My0wLjc0NWMxLjAzNy0xLjAyNSwwLjg5Mi0xLjc3Mi0wLjQ3MS0yLjM0NmMtMC4zOS0wLjE2NC0wLjc4OS0wLjE4NC0xLjIwNy0wLjA5MwoJCWMtMS44NzcsMC40MDctMy40MzEsMS40NjMtNSwyLjQ4MmMtMC40MDMsMC4yNjEtMC4zMzYsMC41MywwLjA1OCwwLjc5OGMwLjYwMSwwLjQwOSwxLjI5NywwLjcxNCwxLjY5MywxLjM2OAoJCWMwLjExLDAuMTgyLDAuMjk1LDAuNDI0LDAuMDk3LDAuNjQ2Yy0wLjE5LDAuMjEyLTAuNDMyLDAuMTAyLTAuNjQ3LTAuMDA2Yy0wLjU0OC0wLjI3NS0xLjA5OC0wLjU0Ni0xLjY0LTAuODMzCgkJQzkuMDgzLDQuMzQ3LDguNzI2LDQuMjUyLDguNDc4LDQuNDc5QzcuODA1LDUuMDkzLDcuODY2LDUuOTYxLDcuODI5LDYuNzcyQzcuODAzLDcuMzUsOC4zMTEsNy40MTIsOC43MSw3LjU4NAoJCWMwLjU2NSwwLjI0MywxLjIyNywwLjM5NSwxLjQyMywxLjI2NWMtMC45MDEtMC4yMTctMS43MjUtMC4zODYtMi41My0wLjYxOEM2LjkyNiw4LjAzNiw2LjU1LDguMzE0LDYuMjc0LDguODkyCgkJYy0wLjM3LDAuNzc0LTAuNTg5LDEuNTktMC42NzQsMi40MzVjLTAuMDQ1LDAuNDUzLTAuMTc5LDAuNjQ2LTAuNjc3LDAuNzAxYy0xLjAxNywwLjExNC0yLjA0MSwwLjI2OC0zLjAyNiwwLjUzNgoJCWMtMC43NTEsMC4yMDUtMS44NTgsMC4yODYtMS44OTYsMS4yNTVjLTAuMDM1LDAuODk1LDEuMDA0LDEuMTE3LDEuNzIsMS4zOTVjMi4wOTIsMC44MTQsNC4yOTcsMS4xMjUsNi41MTYsMS4zNDMKCQljMy44MjEsMC4zNzQsNy42MjksMC4xNjcsMTEuNDE5LTAuMzY5YzEuNjE5LTAuMjI5LDMuMjQ5LTAuNDcyLDQuNzQ4LTEuMTkzYzAuMjg4LTAuMTM4LDAuNjIzLTAuMjgsMC41OTUtMC42NzcKCQlDMjQuOTc1LDEzLjk4LDI0LjY3MywxMy44NTIsMjQuNDEzLDEzLjcyNXogTTE5LjY3MSw0LjMzNmwwLjIxNi0wLjQzOGwwLjIxNywwLjQzOGwwLjQ4MywwLjA3bC0wLjM1LDAuMzQxbDAuMDgyLDAuNDgxCgkJbC0wLjQzMy0wLjIyN2wtMC40MzIsMC4yMjdsMC4wODItMC40ODFsLTAuMzQ5LTAuMzQxTDE5LjY3MSw0LjMzNnogTTE0LjUsOC45NDNsMC43NDIsMC4xMDhsLTAuNTM3LDAuNTI0bDAuMTI3LDAuNzM5bC0wLjY2NC0wLjM1CgkJbC0wLjY2NCwwLjM1bDAuMTI3LTAuNzM5bC0wLjUzNy0wLjUyNGwwLjc0Mi0wLjEwOGwwLjMzMi0wLjY3M0wxNC41LDguOTQzeiBNMTIuODYsMy4wMTNsMC4yMzMtMC40NzFsMC4yMzIsMC40NzFsMC41MjEsMC4wNzYKCQlsLTAuMzc3LDAuMzY3bDAuMDg5LDAuNTE4bC0wLjQ2NS0wLjI0NWwtMC40NjYsMC4yNDVsMC4wODktMC41MThsLTAuMzc2LTAuMzY3TDEyLjg2LDMuMDEzeiBNNy4yMDksMTAuNTA5bDAuNzI5LTAuMTA1CgkJbDAuMzI3LTAuNjYxbDAuMzI2LDAuNjYxbDAuNzI5LDAuMTA1bC0wLjUyOCwwLjUxNWwwLjEyNSwwLjcyN2wtMC42NTItMC4zNDNMNy42MTIsMTEuNzVsMC4xMjUtMC43MjdMNy4yMDksMTAuNTA5eiIvPgo8L2c+Cjwvc3ZnPgo=';
	    add_menu_page( topsc_fullName, topsc_fullName, 'administrator', 'topsc', 'topsc_homeOutput', $topsc_icon, 1000 );
	}
	add_action( 'admin_menu', 'topsc_home' );
}

function topsc_homeOutput() {
	if ( isset( $_GET['post-type'] ) ) {
		$topsc_conditionalPostType = filter_var( $_GET['post-type'], FILTER_SANITIZE_STRIPPED );
	} else {
		// Fallback to default to first post type in array
		$topsc_conditionalPostType = array_shift( array_slice( get_post_types(), 0, 1 ) );
	}
	$topsc_args = array(
		'post_type' => $topsc_conditionalPostType,
		'posts_per_page' => 500,
		'orderby' => 'date',
		'order' => 'DESC'
	);
?>
	<div class="wrap">
		<h1><?php echo esc_attr( topsc_fullName ); ?></h1>
		<div id="topsc-main">
			<ul id="topsc-subsubsub-wrap" class="subsubsub">
			<?php
			foreach ( get_post_types() as $topsc_postType ) :
				$topsc_postTypeObject = get_post_type_object( $topsc_postType );
				if ( $topsc_postTypeObject->name !== 'attachment' ) :
					if ( $topsc_postTypeObject->publicly_queryable || $topsc_postTypeObject->name == 'page' ) :
						if ( $topsc_postTypeObject->name == $topsc_conditionalPostType ) {
							$topsc_postTypeClass = ' class="current"';
						} else {
							$topsc_postTypeClass = '';
						}
					?>
				<li>
					<a href="?page=topsc&post-type=<?php echo esc_attr( $topsc_postTypeObject->name ); ?>"<?php echo $topsc_postTypeClass; ?>>
						<?php echo esc_attr( $topsc_postTypeObject->label ); ?>
					</a>
				</li>
					<?php
					endif;
				endif;
			endforeach;
			?>
			</ul>
			<table class="wp-list-table widefat fixed striped">
				<thead>
					<tr>
						<td>Title</td>
						<td>Post Type</td>
						<td>Action</td>
					</tr>
				</thead>

				<tbody id="the-list">
				<?php
				$topsc_loop = new WP_Query( $topsc_args );
				if ( $topsc_loop->have_posts() ) :
					while ( $topsc_loop->have_posts() ) : $topsc_loop->the_post();
					?>
					<tr>
						<td class="column-title">
							<strong>
								<a href="<?php echo get_permalink(); ?>" class="row-title" target="_blank"><?php the_title(); ?></a>
							</strong>
							<div class="row-actions">
								<span>
									<a href="<?php echo get_permalink(); ?>" target="_blank">View</a>
								</span>
							</div>
						</td>
						<td><?php echo esc_attr( get_post_type_object( get_post_type() )->label ); ?></td>
						<td class="topsc_check" data-topsc="<?php echo get_the_ID(); ?>">
							<a class="button">Check SEO</a>
							<table class="topsc_result" style="display: none;"></table>
						</td>
					</tr>
					<?php
					endwhile;
				else :
					if ( ! empty( get_post_type_object( $topsc_conditionalPostType )->labels->not_found ) ) {
						$topsc_notFound = esc_attr( get_post_type_object( $topsc_conditionalPostType )->labels->not_found );
					} else {
						$topsc_notFound = 'No posts found.';
					}
				?>
					<tr>
						<td colspan="3"><?php echo $topsc_notFound; ?></td>
					</tr>
					<?php
				endif;
				wp_reset_postdata();
				?>
				</tbody>
				<tfoot>
					<tr>
						<td>Title</td>
						<td>Post Type</td>
						<td>Action</td>
					</tr>
				</tfoot>
			</table>
		</div>
		<aside id="topsc-aside">
			<h2>SEO cheat sheet</h2>
			<a href="https://wpza.net/developer-plugins/seo-checker/#meta-robots" class="topsc-help" target="_blank" rel="nofollow noopener">
				<div>
					<h3>Meta robots allowed</h3>
				</div>
			</a>
			<a href="https://wpza.net/developer-plugins/seo-checker/#meta-title" class="topsc-help" target="_blank" rel="nofollow noopener">
				<div>
					<h3>Meta title</h3>
				</div>
			</a>
			<a href="https://wpza.net/developer-plugins/seo-checker/#meta-description" class="topsc-help" target="_blank" rel="nofollow noopener">
				<div class="topsc-help">
					<h3>Meta description</h3>
				</div>
			</a>
			<a href="https://wpza.net/developer-plugins/seo-checker/#one-h1-tag" class="topsc-help" target="_blank" rel="nofollow noopener">
				<div class="topsc-help">
					<h3>One H1 tag</h3>
				</div>
			</a>
			<a href="https://wpza.net/developer-plugins/seo-checker/#h2-tag" class="topsc-help" target="_blank" rel="nofollow noopener">
				<div class="topsc-help">
					<h3>H2 tag</h3>
				</div>
			</a>
			<a href="https://wpza.net/developer-plugins/seo-checker/#alt-text" class="topsc-help" target="_blank" rel="nofollow noopener">
				<div>
					<h3>Alt text</h3>
				</div>
			</a>
			<a href="https://wpza.net/developer-plugins/seo-checker/#responsive-design" class="topsc-help" target="_blank" rel="nofollow noopener">
				<div>
					<h3>Responsive design</h3>
				</div>
			</a>
			<a href="https://wpza.net/developer-plugins/seo-checker/#inline-css" class="topsc-help" target="_blank" rel="nofollow noopener">
				<div>
					<h3>Inline CSS</h3>
				</div>
			</a>
			<a href="https://wpza.net/developer-plugins/seo-checker/#google-analytics" class="topsc-help" target="_blank" rel="nofollow noopener">
				<div>
					<h3>Google Analytics</h3>
				</div>
			</a>
			<a href="https://wpza.net/developer-plugins/seo-checker/#favicon" class="topsc-help" target="_blank" rel="nofollow noopener">
				<div>
					<h3>Favicon</h3>
				</div>
			</a>
			<a href="https://wpza.net/developer-plugins/seo-checker/#ssl-check" class="topsc-help" target="_blank" rel="nofollow noopener">
				<div>
					<h3>SSL check</h3>
				</div>
			</a>
			<a href="https://wpza.net/developer-plugins/seo-checker/#https-redirect" class="topsc-help" target="_blank" rel="nofollow noopener">
				<div>
					<h3>HTTPS redirect</h3>
				</div>
			</a>
			<a href="https://wpza.net/developer-plugins/seo-checker/#www-redirect" class="topsc-help" target="_blank" rel="nofollow noopener">
				<div>
					<h3>WWW redirect</h3>
				</div>
			</a>
			<a href="https://wpza.net/developer-plugins/seo-checker/#one-article-tag" class="topsc-help" target="_blank" rel="nofollow noopener">
				<div>
					<h3>One article tag</h3>
				</div>
			</a>
			<a href="https://wpza.net/developer-plugins/seo-checker/#schema-markup" class="topsc-help" target="_blank" rel="nofollow noopener">
				<div>
					<h3>Schema markup</h3>
				</div>
			</a>
			<a href="https://wpza.net/developer-plugins/seo-checker/#secure-links" class="topsc-help" target="_blank" rel="nofollow noopener">
				<div>
					<h3>Secure links</h3>
				</div>
			</a>
			<a href="https://wpza.net/developer-plugins/seo-checker/#broken-links" class="topsc-help" target="_blank" rel="nofollow noopener">
				<div>
					<h3>Broken links</h3>
				</div>
			</a>
			<a href="https://wpza.net/developer-plugins/seo-checker/#redirected-links" class="topsc-help" target="_blank" rel="nofollow noopener">
				<div>
					<h3>Redirected links</h3>
				</div>
			</a>
			<h2>About this plugin</h2>
			 <p><?php echo esc_attr( topsc_fullName ); ?> is WordPress plugin developed by <a href="//wpza.net" target="_blank" rel="nofollow noopener">WPZA</a>.</p>

			<p>This plugin is designed to better optimise your website's SEO, page-by-page, allowing them to rank better in search engines.</p>
		</aside>
	</div>
<?php
}

function topsc_styles() {
?>
	<style type="text/css">
		div#topsc-main,
		aside#topsc-aside {
			display: inline-block;
			vertical-align: top;}
		div#topsc-main {width: calc( 100% - 350px );}
		div#topsc-main #topsc-subsubsub-wrap {
			display: block;
			width: 100%;
			float: none;
			padding: 10px;
			margin: 10px 0;
			box-sizing: border-box;
			background-color: #36006D}
			div#topsc-main #topsc-subsubsub-wrap li a {
				font-weight: 600;
				color: #FFFFFF;}
			div#topsc-main #topsc-subsubsub-wrap li a.current {color: #52E4A7;}
			div#topsc-main #topsc-subsubsub-wrap li a:hover {color: #9B39EE;}
		aside#topsc-aside {
			width: 300px;
			padding-left: 25px;}
		aside#topsc-aside h2 {
			color: #36006D;
			font-size: 1.5em;
			border-bottom: 1px solid #36006D;
			padding-bottom: 1em;}
		aside#topsc-aside a.topsc-help:focus {box-shadow: none;}
		aside#topsc-aside a.topsc-help {
			border: none;
			width: 32%;
			display: inline-table;
			vertical-align: top;
			text-decoration: none;}
			aside#topsc-aside a.topsc-help div {
				width: 100%;
				display: table;
				vertical-align: top;
				background-color: #36006D;
				min-height: 90px;
				margin: 2px 0;
				text-align: center;
				box-shadow: 1px 1px 10px rgba( 0, 0, 0, .33 );}
			aside#topsc-aside a.topsc-help div:hover {background-color: #9B39EE;}
				aside#topsc-aside a.topsc-help div h3 {
					width: 100%;
					display: table-cell;
					vertical-align: middle;
					font-size: 1em;
					color: #FFFFFF;
					margin: 0;
					padding: 10px;}
		aside#topsc-aside p a {font-weight: 700;}
		aside#topsc-aside a.button.button-primary {
			color: #FFFFFF;
			font-size: 1.25em;
			font-weight: 600;
			padding: 10px 20px;
			height: auto;
			background-color: #52E4A7;
			text-shadow: none;
			border: none;
			border-bottom: 3px solid #36A576;
			box-shadow: 1px 1px 10px rgba( 0, 0, 0, .33 );
			margin: 10px 0;}
		aside#topsc-aside a.button.button-primary:hover {
			background-color: #3AA779;
			border-color: #277957;}
		aside#topsc-aside ul li {
			list-style-type: square;
			list-style-position: inside;}
	</style>
<?php
}
add_action( 'admin_head', 'topsc_styles' );