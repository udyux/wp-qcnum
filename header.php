<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _UdyUX
 */

?>
<!DOCTYPE html>
<html <? language_attributes(); ?>>
<head>
  <meta charset="<? bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<? bloginfo('pingback_url'); ?>">
  <link rel="shortcut icon" href="<? bloginfo('template_url') ?>/icons/favicon.ico"/>

  <? wp_head(); ?>

  <script type="text/javascript">function getUrl(path){return'<? bloginfo('template_url'); ?>'+'/'+path;}</script>
</head>

<body>
	<a class="skip-link screen-reader-text" href="#content"><? esc_html_e( 'Skip to content', '_udyux' ); ?></a>
	<main id="main">
    <!-- nav -->
  	<?php include('nav.php'); ?>
