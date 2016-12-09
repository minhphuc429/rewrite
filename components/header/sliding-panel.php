<?php if ( is_active_sidebar( 'sidebar-1' ) || has_nav_menu( 'top-menu' ) || has_nav_menu( 'social' ) ) : ?>
	<div class="nav">
		<h3 class="nav-title">Menu</h3>
		<a href="#" class="nav-close">
			<span class="hidden">Close</span>
		</a>
		<?php if ( has_nav_menu( 'top-menu' ) ) : ?>
			<nav id="site-navigation" class="main-navigation" role="navigation">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'top-menu',
				'menu_class' => 'nav-menu',
				) );
				?>
				</nav>
			<?php endif; ?>
			<?php rewrite_social_icons_output(); ?>
			<?php get_search_form(); ?>
		</div>
		<span class="nav-cover"></span>
	<?php endif; ?>