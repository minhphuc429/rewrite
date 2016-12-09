<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Rewrite
 */

get_header(); ?>

	<main id="content" class="content" role="main">

		<?php
		if ( have_posts() ) : ?>

			<article class="post">
				<header class="post-header">
					<?php
						the_archive_title( '<h2 class="post-title">', '</h2>' );
					?>
				</header>
				<section class="post-excerpt">
					<?php
						the_archive_description();
					?>
				</section>
			</article>
			<?php

			echo '<div class="extra-pagination inner">';
		    rewrite_paging_nav();
			echo '</div>';

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'components/post/content', get_post_format() );

			endwhile;

			rewrite_paging_nav();

		else :

			get_template_part( 'components/post/content', 'none' );

		endif; ?>

		</main>
	</div>
<?php
get_footer();