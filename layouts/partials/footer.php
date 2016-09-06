<? # site-wide footer #
  $footerNode = array(
    'home_url'      => home_url(),
    'logo'          => get_field('logo', 'options'),
    'message_title' => get_field('footer_message_title', 'options'),
    'message'           => get_field('footer_message', 'options'),
    'social_title'   => get_field('social_title', 'options')
  );
?>

<footer class="footer">
  <a href="<?= $footerNode['home_url']; ?>" rel="home">
    <img class="logo" src="<?= $footerNode['logo']; ?>"/>
  </a>

  <div class="footer__message">
    <h6 class="footer__title"><?= $footerNode['message_title']; ?></h6>
    <p><?= $footerNode['message']; ?></p>
  </div>

  <div>
    <h6 class="footer__title">Plan du site</h6>
    <?// TODO: add footer sitemap?>
  </div>

  <div>
    <h6 class="footer__title"><?= $footerNode['social_title']; ?></h6>
    <ul>

      <?
        if ( have_rows('social_links', 'options') ) : while ( have_rows('social_links', 'options') ) : the_row();

        $currentNode = array(
          'link' => get_sub_field('social_link'),
          'icon' => get_sub_field('social_icon')
        ); ?>

        <li class="footer__social">
          <a href="<?= $currentNode['link']; ?>" target="_blank">
            <svg class="icon"><use xlink:href="#<?= $currentNode['icon']; ?>"></use></svg>
          </a>
        </li>

      <? endwhile; endif; ?>

    </ul>
  </div>

  <h5 class="footer__copyright"><?= date('Y'); ?> &copy; Québec Numérique</h5>
</footer>
