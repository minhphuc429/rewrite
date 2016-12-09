<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Rewrite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
	<header class="post-header">
		<?php the_title( sprintf( '<h2 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header>
	<section class="post-excerpt">
		<?php the_excerpt(); ?>
	</section>
	<footer class="post-meta">
	<?php get_template_part( 'components/post/content', 'meta' ); ?>
	</footer>
</article>
