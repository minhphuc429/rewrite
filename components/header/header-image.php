<?php if ( has_post_thumbnail() ) : ?>
	<header class="main-header post-head " style="background-image: url(<?php the_post_thumbnail_url(); ?>)">
		<nav class="main-nav overlay clearfix">
		<?php else : ?>
			<header class="main-header post-head no-cover">
				<nav class="main-nav clearfix">
				<?php endif; ?>
				<?php if ( has_custom_logo() ) : ?>
					<a class="blog-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php $custom_logo_id = get_theme_mod( 'custom_logo' ); $image = wp_get_attachment_image_src( $custom_logo_id , 'full' ); echo $image[0]; ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
				<?php endif; ?>
				<?php if ( has_nav_menu( 'top-menu' ) ) : ?>
					<a class="menu-button icon-menu" href="#"><span class="word">Menu</span></a>
				<?php endif; ?>
			</nav>
		</header>