<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Rewrite
 */

if ( ! function_exists( 'rewrite_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @return void
 */
function rewrite_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	global $wp_query;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	?>
	<nav class="pagination" role="navigation">
		<div class="nav-links">
			<?php if ( get_previous_posts_link() ) : ?>
			<?php previous_posts_link( __( '<span class="meta-nav">&larr;</span> Newer Posts', 'rewrite' ) ); ?>
			<?php endif; ?>
				<span class="page-number"><?php printf( __( 'Page', 'rewrite' ).' %1$s '.__( 'of', 'rewrite' ).' %2$s', $paged, $wp_query->max_num_pages ); ?></span>
			<?php if ( get_next_posts_link() ) : ?>
			<?php next_posts_link( __( 'Older Posts <span class="meta-nav">&rarr;</span>', 'rewrite' ) ); ?>
			<?php endif; ?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'rewrite_posted_by' ) ) :
/**
 * Prints HTML with meta information for author.
 */
function rewrite_posted_by() {
	$byline = sprintf( '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'
	);

	echo '<img class="author-thumb" src="'.get_avatar_url( get_the_author_meta( 'ID' ), 24 ).'" alt="'.get_the_author().'" nopin="nopin" />'.$byline;
}
endif;

if ( ! function_exists( 'rewrite_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time.
 */
function rewrite_posted_on() {
	$time_string = '<time class="post-date" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="post-date" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'Y-m-d' ) ),
		esc_html( get_the_date( 'j F Y' ) ),
		esc_attr( get_the_modified_date( 'Y-m-d' ) ),
		esc_html( get_the_modified_date( 'j F Y' ) )
	);

	echo $time_string;
}
endif;

if ( ! function_exists( 'rewrite_posted_in' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function rewrite_posted_in() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'rewrite' ) );
		if ( $categories_list && rewrite_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( ' in %1$s', 'rewrite' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		/*$tags_list = get_the_tag_list( '', esc_html__( ', ', 'rewrite' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'rewrite' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}*/
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'rewrite' ), esc_html__( '1 Comment', 'rewrite' ), esc_html__( '% Comments', 'rewrite' ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'rewrite' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

if ( ! function_exists( 'rewrite_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function rewrite_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'rewrite' ) );
		if ( $categories_list && rewrite_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'rewrite' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'rewrite' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'rewrite' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'rewrite' ), esc_html__( '1 Comment', 'rewrite' ), esc_html__( '% Comments', 'rewrite' ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'rewrite' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function rewrite_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'rewrite_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'rewrite_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so rewrite_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so rewrite_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in rewrite_categorized_blog.
 */
function rewrite_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'rewrite_categories' );
}
add_action( 'edit_category', 'rewrite_category_transient_flusher' );
add_action( 'save_post',     'rewrite_category_transient_flusher' );
