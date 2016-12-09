<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Rewrite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
	<header class="post-header">
	<?php the_title( '<h2 class="post-title"><a href="' . esc_url( get_permalink() ) . '" data-wpel-link="internal">', '</a></h2>' ); ?>
	</header>
	<section class="post-excerpt">
		<?php
			the_excerpt( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'rewrite' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'rewrite' ),
				'after'  => '</div>',
			) );
		?>
	</section>
	<footer class="post-meta">
	<?php get_template_part( 'components/post/content', 'meta' ); ?>
	</footer>
</article><!-- #post-## -->