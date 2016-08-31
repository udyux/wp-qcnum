<? # file head ?>

<!DOCTYPE html>
<html <? language_attributes(); ?>>
<head>
  <meta charset="<? bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="pingback" href="<? bloginfo('pingback_url'); ?>">
  <link rel="shortcut icon" href="<? the_field('favicon', 'options'); ?>"/>

  <? wp_head(); ?>

  <script>function getUrl(path){return'<? bloginfo('template_url'); ?>/'+path;}</script>
</head>

<body>
	<main id="content">
