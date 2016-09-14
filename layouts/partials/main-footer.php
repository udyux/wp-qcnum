<? # main footer #
  $home_url      = home_url();
  $logo          = get_field('logo', 'options');
  $message_title = get_field('footer_message_title', 'options');
  $message       = get_field('footer_message', 'options');
  $social_title  = get_field('social_title', 'options');
?>

<footer class="footer">
  <a href="<?= $home_url; ?>" rel="home">
    <img class="logo" src="<?= $logo; ?>"/>
  </a>

  <div class="footer__message">
    <h6 class="footer__title"><?= $message_title; ?></h6>
    <p><?= $message; ?></p>
  </div>

  <div>
    <h6 class="footer__title">Plan du site</h6>
    <ul>

      <?
        if ( have_rows('footer_sitemap', 'options') ) : while ( have_rows('footer_sitemap', 'options') ) : the_row();

        $link  = get_sub_field('link');
        $label = get_sub_field('label'); ?>

        <li>
          <a href="<?= $link; ?>"><?= $label; ?></a>
        </li>

      <? endwhile; endif; ?>

    </ul>
  </div>

  <div>
    <h6 class="footer__title"><?= $social_title; ?></h6>
    <ul>

      <?
        if ( have_rows('social_links', 'options') ) : while ( have_rows('social_links', 'options') ) : the_row();

        $link = get_sub_field('social_link');
        $icon = get_sub_field('social_icon'); ?>

        <li class="footer__social">
          <a href="<?= $link; ?>" target="_blank">
            <svg class="icon"><use xlink:href="#<?= $icon; ?>"></use></svg>
          </a>
        </li>

      <? endwhile; endif; ?>

    </ul>
  </div>

  <h5 class="footer__copyright"><?= date('Y'); ?> &copy; Québec Numérique</h5>
</footer>
