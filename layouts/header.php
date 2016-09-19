<? # page layout header #
  $theme_uri = get_template_directory_uri();
  $html_lang = get_language_attributes();
  $charset   = get_bloginfo('charset');
  $pingback  = get_bloginfo('pingback_url');
  $favicon   = get_field('favicon', 'options');

  $get_header = !_udyux_page_is('about');
?>

<!DOCTYPE html>
<html <?= $html_lang; ?>>
<head>
  <meta charset="<?= $charset; ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="pingback" href="<?= $pingback; ?>">
  <link rel="shortcut icon" href="<?= $favicon; ?>"/>

  <? wp_head(); ?>

  <script>function getUrl(path){return'<?= $theme_uri; ?>/'+path;}</script>
</head>

<body>
  <main id="content">

    <?
      _udyux_get_partial('main', 'nav');
      if ($get_header) _udyux_get_partial('main', 'header');
    ?>
