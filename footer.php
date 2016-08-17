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

		</div>

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="site-info">
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', '_udyux' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', '_udyux' ), 'WordPress' ); ?></a>

				<span class="sep"> | </span>

				<?php printf( esc_html__( 'Theme: %1$s by %2$s.', '_udyux' ), '_udyux', '<a href="http://udy.io" rel="designer">Nicolas Udy</a>' ); ?>
			</div><!-- .site-info -->
		</footer>

	</div>

	<?php wp_footer(); ?>

	</div><!-- #page -->

	<?php include('nav.php'); ?>


	<?php if ( get_post_type() == 'event' ) : ?>
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
		<script src="<? echo bloginfo('stylesheet_directory'); ?>/js/event-scripts.js"></script>
	<? endif; ?>

</body>
</html>
