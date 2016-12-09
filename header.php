<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Rewrite
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>
<body <?php body_class('nav-closed'); ?>>

<?php get_template_part( 'components/header/sliding', 'panel' ); ?>
<div class="site-wrapper">
	<?php if ( is_home() ) : ?>
		<?php get_template_part( 'components/header/header', 'fullscreen-image' ); ?>
	<?php else : ?>
		<?php get_template_part( 'components/header/header', 'image' ); ?>
	<?php endif; ?>