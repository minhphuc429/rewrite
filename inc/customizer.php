<?php
/**
 * Rewrite Theme Customizer.
 *
 * @package Rewrite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function rewrite_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	/***** Social Media Icons *****/
	// section
	$wp_customize->add_section( 'rewrite_social_media_icons', array(
		'title'       => __( 'Social Menu', 'rewrite' ),
		'priority'    => 25,
		'description' => __( 'Add the URL for each of your social profiles.', 'rewrite' )
	) );
	
	// get the social sites array
	$social_sites = rewrite_social_array();

	// set a priority used to order the social sites
	$priority = 5;	

	// create a setting and control for each social site
	foreach ( $social_sites as $social_site => $value ) {
		$label = ucfirst( $social_site );

		if ( $social_site == 'google-plus' ) {
			$label = 'Google Plus';
		} elseif ( $social_site == 'rss' ) {
			$label = 'RSS';
		}
		// setting
		$wp_customize->add_setting( $social_site, array(
			'sanitize_callback' => 'esc_url_raw'
		) );
		// control
		$wp_customize->add_control( $social_site, array(
			'type'     => 'url',
			'label'    => $label,
			'section'  => 'rewrite_social_media_icons',
			'priority' => $priority
		) );
		// increment the priority for next site
		$priority = $priority + 5;
	}
}
add_action( 'customize_register', 'rewrite_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function rewrite_customize_preview_js() {
	wp_enqueue_script( 'rewrite_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'rewrite_customize_preview_js' );

/***** Social Media Icons *****/
if ( ! function_exists( 'rewrite_social_array' ) ) {
	function rewrite_social_array() {

		$social_sites = array(
			'facebook'      => 'facebook_profile',
			'twitter'       => 'twitter_profile',
			'google-plus'   => 'googleplus_profile',
			'rss'           => 'rss_profile'
		);

		return apply_filters( 'rewrite_social_array_filter', $social_sites );
	}
}

if ( ! function_exists( 'rewrite_social_icons_output' ) ) {
	function rewrite_social_icons_output() {

		$social_sites = rewrite_social_array();

		foreach ( $social_sites as $social_site => $profile ) {

			if ( strlen( get_theme_mod( $social_site ) ) > 0 ) {
				$active_sites[ $social_site ] = $social_site;
			}
		}

		if ( ! empty( $active_sites ) ) {

			echo "<ul class='social-media-icons'>";

			foreach ( $active_sites as $key => $active_site ) {

				if ( $active_site == 'email-form' ) {
					$class = 'fa fa-envelope-o';
				} else {
					$class = 'fa fa-' . $active_site;
				}

				echo '<li>';
				if ( $active_site == 'email' ) { ?>
					<a class="email" target="_blank"
					   href="mailto:<?php echo antispambot( is_email( get_theme_mod( $key ) ) ); ?>">
						<i class="fa fa-envelope" title="<?php esc_attr_e( 'email', 'rewrite' ); ?>"></i>
					</a>
				<?php } elseif ( $active_site == 'skype' ) { ?>
					<a class="<?php echo esc_attr( $active_site ); ?>" target="_blank"
					   href="<?php echo esc_url( get_theme_mod( $key ), array( 'http', 'https', 'skype' ) ); ?>">
						<i class="<?php echo esc_attr( $class ); ?>"
						   title="<?php echo esc_attr( $active_site ); ?>"></i>
					</a>
				<?php } else { ?>
					<a class="<?php echo esc_attr( $active_site ); ?>" target="_blank"
					   href="<?php echo esc_url( get_theme_mod( $key ) ); ?>">
						<i class="<?php echo esc_attr( $class ); ?>"
						   title="<?php echo esc_attr( $active_site ); ?>"></i>
					</a>
					<?php
				}
				echo '</li>';
			}
			echo "</ul>";
		}
	}
}

/**
 * Change excerpt length. By default the excerpt length is set to return 55 words.
 */
function custom_excerpt_length( $length ) {
	return 26;
}
add_filter( 'excerpt_length', 'custom_excerpt_length' );// Changing excerpt more

/**
 * Change excerpt more string. By default it is set to echo '[…]' more string at the end of the excerpt.
 */
function custom_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'custom_excerpt_more' );

/**
 * next_posts_link customize class
 * @return [string] class
 */
function rewrite_next_posts_link_attributes() {
    return 'class="older-posts"';
}
add_filter('next_posts_link_attributes', 'rewrite_next_posts_link_attributes');

/**
 * previous_posts_link customize class
 * @return [string] class
 */
function rewrite_previous_posts_link_attributes() {
    return 'class="newer-posts"';
}
add_filter('previous_posts_link_attributes', 'rewrite_previous_posts_link_attributes');
