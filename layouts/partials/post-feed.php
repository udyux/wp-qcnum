<? # post feed #
  $post_type = get_post_type();

  $posts = new WP_Query(array(
    'post__not_in' 	 => array( get_the_ID() ),
    'posts_per_page' => 3,
    'post_type'			 => $post_type,
    'post_status' 	 => 'publish'
  ));
?>

<section class="feed feed--post row">

  <?
	  if ( $posts->have_posts() ): while ( $posts->have_posts() ) : $posts->the_post();

    $title   = get_the_title();
    $link    = get_permalink();
    $excerpt = _udyux_get_excerpt(200);
    $img        = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
    $featured   = $img ?: get_field("{$post_type}_header", 'options');

    $start_date = _udyux_format_date( get_field('start_date') );
    $end_date   = _udyux_format_date( get_field('end_date') ); ?>

    <article class="feed__item row__item">
      <div class="feed__image" style="background-image:url(<?= $featured; ?>)"></div>
      <div class="feed__content js-bgColor">
        <h3 class="feed__title">

          <? if ($start_date && $end_date): ?>
            <sup><?= "{$start_date['date']} {$start_date['month']} &mdash; {$end_date['date']} {$end_date['month']} {$end_date['year']}"; ?></sup><br>
          <? elseif ($start_date): ?>
            <sup><?= "{$start_date['date']} {$start_date['month']} {$start_date['year']}"; ?></sup><br>
          <? endif; ?>

          <?= $title; ?>

        </h3>
        <p class="feed__excerpt"><span class="feed__overlay js-bgColorTarget"></span><?= $excerpt; ?></p>
        <a class="feed__link" href="<?= $link; ?>"></a>
      </div>
    </article>

	<? endwhile; endif; wp_reset_query(); ?>

</section>
