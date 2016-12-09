<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Rewrite
 */

get_header(); ?>

	<main id="content" class="content" role="main">

		<?php
		if ( have_posts() ) : ?>
			
			<article class="post">
				<header class="post-header">
					<h1 class="post-title"><?php printf( esc_html__( 'Search Results for: %s', 'rewrite' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header>
			</article>
			<?php

			echo '<div class="extra-pagination inner">';
		    rewrite_paging_nav();
			echo '</div>';

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'components/post/content', 'search', get_post_format() );

			endwhile;

			rewrite_paging_nav();

		else :

			get_template_part( 'components/post/content', 'none' );

		endif; ?>

	</main>
<?php
get_footer();