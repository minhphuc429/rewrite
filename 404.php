<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Rewrite
 */

get_header(); ?>
	
	<main class="content" role="main">
		<article class="post">
			<header class="post-header">
				<h1><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'rewrite' ); ?></h1>
			</header>
			
			<section class="post-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'rewrite' ); ?></p>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Go to the front page &raquo;', 'rewrite' ); ?></a>
			</section>
		</article>
	</main>	
	
<?php
get_footer();
