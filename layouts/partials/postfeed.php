<? # post feed # ?>

<section class="feed feed--post row">

  <?
    $posts = new WP_Query(array(
		  'post__not_in' 		=> array( get_the_ID() ),
		  'posts_per_page'	=> 3,
		  'post_type'				=> $data ?: 'article',
		  'post_status' 		=> 'publish'
	  ));

	  if ( $posts->have_posts() ): while ( $posts->have_posts() ) : $posts->the_post();

    $currentNode = array(
      'title'     => get_the_title(),
      'link'      => get_permalink(),
      'img'       => wp_get_attachment_url( get_post_thumbnail_id($post->ID) ),
      'excerpt'   => _udyux_get_excerpt(200),
      'start_date' => _udyux_format_date( get_field('start_date') ),
      'end_date'   => _udyux_format_date( get_field('end_date') )
    );

    list($start_date, $end_date) = array($currentNode['start_date'], $currentNode['end_date']); ?>

    <article class="feed__item row__item">
      <div class="feed__image" style="background-image:url(<?= $currentNode['img']; ?>)"></div>
      <div class="feed__content js-bgColor">
        <h3 class="feed__title">

          <? if ($start_date && $end_date): ?>
            <sup><?= "{$start_date['date']} {$start_date['month']} &mdash; {$end_date['date']} {$end_date['month']} {$end_date['year']}"; ?></sup><br>
          <? elseif ($start_date): ?>
            <sup><?= "{$start_date['date']} {$start_date['month']} {$start_date['year']}"; ?></sup><br>
          <? endif; ?>

          <?= $currentNode['title']; ?>

        </h3>
        <p class="feed__excerpt"><span class="feed__overlay js-bgColorTarget"></span><?= $currentNode['excerpt']; ?></p>
        <a class="feed__link" href="<?= $currentNode['link']; ?>"></a>
      </div>
    </article>

	<? endwhile; endif; wp_reset_query(); ?>

</section>
