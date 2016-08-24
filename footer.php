<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _UdyUX
 */
?>

    <!-- newsletter form -->
    <form class="newsletterForm">
      <h3 class="newsletterForm__title">abonnez-vous à l'infolettre</h3>
      <input class="newsletterForm__input" type="email" name="new_sub" placeholder="Votre courriel" autocomplete="email" autocorrect="off" autocapitalize="none" spellcheck="false"/>
      <button class="newsletterForm__button button--form" id="newsletter_sub">S'inscrire</button>
    </form>

  	<!-- footer -->
  	<footer id="colophon" class="footer" role="contentinfo">
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

  </main>

  <? if ( get_post_type() == 'event' ):?>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
	<script src="<? echo bloginfo('stylesheet_directory'); ?>/js/event-scripts.js"></script>
  <? endif; wp_footer(); ?>
</body>
</html>
