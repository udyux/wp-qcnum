<? # home page template #
  $homeNode = array(
    'banner'        => get_field('home_banner', 'options'),
    'bgImg'         => get_field('home_background', 'options'),
    'activityTitle' => get_field('activity_title', 'options'),
    'clientsTitle'  => get_field('clients_title', 'options')
  );

  $showSignup = get_field('show_signup', 'options');
?>

<header class="header header--homepage" role="banner" style="background-image:url(<? echo $homeNode['bgImg']; ?>)">
  <h1 class="header__title"><? echo $homeNode['banner']; ?></h1>
</header>

<section class="section activity">
  <h2 class="section__title"><? echo $homeNode['activityTitle']; ?></h2>
  <div class="row--md activity__row">

    <?
      if ( have_rows('activity_blocks', 'options') ) : while ( have_rows('activity_blocks', 'options') ) : the_row();

      $currentNode = array(
        'title' => get_sub_field('block_title'),
        'img'   => get_sub_field('block_icon'),
        'desc'  => get_sub_field('block_description')
      ); ?>

      <div class="activity__block row__item">
        <img class="activity__icon" src="<? echo $currentNode['img']; ?>" alt="<? echo $currentNode['title']; ?>"/>
        <h3 class="activity__title"><? echo $currentNode['title']; ?></h3>
        <p class="activity__desc"><? echo $currentNode['desc']; ?></p>
      </div>

    <? endwhile; endif; ?>

  </div>
</section>

<? if ($showSignup) _udyux_get_partial('signup', true); ?>

<section class="row">
  <!-- articles -->
  <aside class="row__item feed feed--news">

    <?
      $articles = new WP_Query(array(
        'posts_per_page'	=> 3,
        'post_type'				=> 'article',
        'post_status' 		=> 'publish'
      ));

      $c = 0;

      if ( $articles->have_posts() ): while ( $articles->have_posts() ) : $articles->the_post();

      $max = $c == 0 ? 750 : 350;
      $c++;

      $currentNode = array(
        'title'   => get_the_title(),
        'link'    => get_permalink(),
        'img'     => wp_get_attachment_url( get_post_thumbnail_id($post->ID) ),
        'excerpt' => _udyux_get_excerpt($max)
      ); ?>

      <article class="feed__item">
        <div class="feed__image" style="background-image:url(<? echo $currentNode['img']; ?>)"></div>
        <div class="feed__content js-bgColor">
          <h3 class="feed__title"><? echo $currentNode['title']; ?></h3>
          <p class="feed__excerpt"><span class="feed__overlay js-bgColorTarget"></span><? echo $currentNode['excerpt']; ?></p>
          <a class="feed__link" href="<? echo $currentNode['link']; ?>"></a>
        </div>
      </article>

    <? endwhile; endif; wp_reset_query();?>

  </aside>

  <!-- events -->
  <aside class="row__item feed feed--events">

    <?
      $events = new WP_Query( array(
        'posts_per_page'	=> 3,
        'post_type'				=> 'event',
        'post_status' 		=> 'publish'
      ));

      if ( $events->have_posts() ): while ( $events->have_posts() ) : $events->the_post();

      $currentNode = array(
        'title'   => get_the_title(),
        'link'    => get_permalink(),
        'img'     => wp_get_attachment_url( get_post_thumbnail_id($post->ID) ),
        'excerpt' => _udyux_get_excerpt(350)
      ); ?>

      <article class="feed__item">
        <div class="feed__image" style="background-image:url(<? echo $currentNode['img']; ?>)"></div>
        <div class="feed__content js-bgColor">
          <h3 class="feed__title"><? echo $currentNode['title']; ?></h3>
          <p class="feed__excerpt"><span class="feed__overlay js-bgColorTarget"></span><? echo $currentNode['excerpt']; ?></p>
          <a class="feed__link" href="<? echo $currentNode['link']; ?>"></a>
        </div>
      </article>

    <? endwhile; endif; wp_reset_query(); ?>

  </aside>
</section>
