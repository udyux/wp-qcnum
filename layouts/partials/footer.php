<? # site-wide footer #
  $footerNode = array(
    'homeUrl'     => home_url(),
    'logo'        => get_field('logo', 'options'),
    'msgTitle'    => get_field('footer_message_title', 'options'),
    'msg'         => get_field('footer_message', 'options'),
    'socialTitle' => get_field('social_title', 'options')
  );
?>

<footer class="footer">
  <a href="<? echo $footerNode['homeUrl']; ?>" rel="home">
    <img class="logo" src="<? echo $footerNode['logo']; ?>"/>
  </a>

  <div class="footer__message">
    <h6 class="footer__title"><? echo $footerNode['msgTitle']; ?></h6>
    <p><? echo $footerNode['msg']; ?></p>
  </div>

  <div>
    <h6 class="footer__title">Plan du site</h6>
    <?// TODO: add footer sitemap?>
  </div>

  <div>
    <h6 class="footer__title"><? echo $footerNode['socialTitle']; ?></h6>
    <ul>

      <?
        if ( have_rows('social_links', 'options') ) : while ( have_rows('social_links', 'options') ) : the_row();

        $currentNode = array(
          'link' => get_sub_field('social_link'),
          'icon' => get_sub_field('social_icon')
        ); ?>

        <li class="footer__social">
          <a href="<? echo $currentNode['link']; ?>" target="_blank">
            <svg class="icon"><use xlink:href="#<? echo $currentNode['icon']; ?>"></use></svg>
          </a>
        </li>

      <? endwhile; endif; ?>

    </ul>
  </div>

  <h5 class="footer__copyright"><? echo date('Y'); ?> &copy; Québec Numérique</h5>
</footer>
