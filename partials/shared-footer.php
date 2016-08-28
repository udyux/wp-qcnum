<? # site-wide footer ?>

<footer class="footer">
  <a href="<? echo esc_url( home_url( '/' ) ); ?>" rel="home">
    <img class="logo" src="<? the_field('logo', 'options'); ?>"/>
  </a>

  <div class="footer__message">
    <h6 class="footer__title"><? the_field('footer_message_title', 'options'); ?></h6>
    <p><? the_field('footer_message', 'options') ?></p>
  </div>

  <div>
    <h6 class="footer__title">Plan du site</h6>
    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
  </div>

  <div>
    <h6 class="footer__title"><? the_field('social_title', 'options') ?></h6>

    <ul>

      <? if ( have_rows('social_links', 'options') ) : while ( have_rows('social_links', 'options') ) : the_row(); ?>

      <li class="footer__social">
        <a href="<? the_sub_field('social_link') ?>" target="_blank">
          <svg class="icon"><use xlink:href="#<? the_sub_field('social_icon') ?>"></use></svg>
        </a>
      </li>

      <? endwhile; endif; ?>

    </ul>
  </div>

  <h5 class="footer__copyright"><? echo date('Y'); ?> &copy; Québec Numérique</h5>
</footer>
