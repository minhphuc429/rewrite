<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Rewrite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
	<header class="post-header">
		<?php the_title( '<h1 class="post-title">', '</h1>' ); ?>
		<section class="post-meta">
            <?php rewrite_posted_on(); rewrite_posted_in(); ?>
        </section>
	</header>

	<div class="post-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'rewrite' ),
				'after'  => '</div>',
			) );
		?>
	</div>
	<footer class="post-footer">
		<figure class="author-image">
		<?php
	        echo '<a class="img" href="'. esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) .'" style="background-image: url('.get_avatar_url( get_the_author_meta( 'ID' ), 24 ).')"><span class="hidden">'. get_the_author() .'&#8242;s Picture</span></a>';
	        ?>
	    </figure>

	    <section class="author">
	    
            <h4><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo get_the_author(); ?></a></h4>

            <?php if( get_the_author_meta( 'description' ) ) : ?>
                <p><?php echo get_the_author_meta( 'description' ); ?></p>
            <?php else : ?>
                <p>Read <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">more posts</a> by this author.</p>
            <?php endif; ?>
            
            <div class="author-meta">
            <?php if( get_the_author_meta( 'email' ) ) : ?>
                <span class="author-location icon-location"><?php echo get_the_author_meta( 'email' ); ?></span>
            <?php endif; ?>
            <?php if( get_the_author_meta( 'url' ) ) : ?>
                <span class="author-link icon-link"><a href="<?php echo get_the_author_meta( 'url' ); ?>"><?php echo get_the_author_meta( 'url' ); ?></a></span>
            <?php endif; ?>
            </div>
        
        </section>

        <section class="share">
            <h4>Share this post</h4>
            <a class="icon-twitter" href="https://twitter.com/intent/tweet?text=<?php echo urlencode( get_the_title() ); ?>&amp;url=<?php echo esc_url( get_permalink() ); ?>"
                onclick="window.open(this.href, 'twitter-share', 'width=550,height=235');return false;">
                <span class="hidden">Twitter</span>
            </a>
            <a class="icon-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( get_permalink() ); ?>"
                onclick="window.open(this.href, 'facebook-share','width=580,height=296');return false;">
                <span class="hidden">Facebook</span>
            </a>
            <a class="icon-google-plus" href="https://plus.google.com/share?url=<?php echo esc_url( get_permalink() ); ?>"
               onclick="window.open(this.href, 'google-plus-share', 'width=490,height=530');return false;">
                <span class="hidden">Google+</span>
            </a>
        </section>
	</footer>
</article><!-- #post-## -->