<? # about page layout #
  /* Template Name: about */
  $header = get_field('header');

  $beginning = array(
    'date'  => get_field('beginning_date'),
    'title' => get_field('beginning_title'),
    'text'  => get_field('beginning_text')
  );

  $waq = array(
    'title' => get_field('waq_title'),
    'text'  => get_field('waq_text'),

    'guest'     => get_field('guest'),
    'volunteer' => get_field('volunteer'),
    'data'      => get_field('data'),
    'budget'    => get_field('budget'),
    'coffee'    => get_field('coffee')
  );
?>

<article id="organisation" class="about">
  <header class="about__header">
    <div class="about__background" style="background-image:url(<?= $header; ?>);"></div>

    <h1 class="about__title"><?= $beginning['date']; ?></h1>
    <div class="about__circle"></div>

    <div class="about__box">
      <h2 class="about__subtitle"><?= $beginning['title']; ?></h2>
      <p class="about__text about__text--beginning"><?= $beginning['text']; ?></p>
    </div>
  </header>

  <section class="about__section">
    <h2 class="about__title about__title--waq"><?= $waq['title']; ?></h2>
    <p class="about__text about__text--waq"><?= $waq['text']; ?></p>

    <div class="row">
      <div class="row__item row__item--double col">
        <div class="col__item col__item--double infographic">
          <h3 class="infographic__title"><?= $waq['guest']; ?> participants</h3>
          <div class="infographic__image infographic__image--guests"></div>
        </div>

        <div class="col__item infographic">
          <h3 class="infographic__title"><?= $waq['volunteer']; ?> bénévoles</h3>
          <div class="infographic__image infographic__image--volunteers"></div>
        </div>
      </div>

      <div class="row__item col">
        <div class="col__item infographic infographic--small">
          <div class="infographic__image infographic__image--database"></div>
          <h3 class="infographic__title"><?= $waq['data']; ?> giga bytes</h3>
        </div>

        <div class="col__item infographic infographic--small">
          <div class="infographic__image infographic__image--money"></div>
          <h3 class="infographic__title">budget de <?= $waq['budget']; ?></h3>
        </div>

        <div class="col__item infographic infographic--small">
          <div class="infographic__image infographic__image--coffee"></div>
          <h3 class="infographic__title"><?= $waq['coffee']; ?> cafés</h3>
        </div>
      </div>
    </div>
  </section>

  <div>

    <?
      if ( have_rows('milestones') ) : while ( have_rows('milestones') ) : the_row();

      $date  = get_sub_field('date');
      $title = get_sub_field('title');
      $text  = get_sub_field('text');
      $image = get_sub_field('background');
      $noImg = empty($image); ?>

      <section class="milestone<? if ($noImg) echo ' milestone--noImg' ?>">
        <div class="milestone__background" style="background-image:url(<?= $image; ?>);"></div>

        <h1 class="milestone__title"><?= $date; ?></h1>
        <div class="milestone__circle"></div>

        <div class="milestone__box">
          <h2 class="milestone__subtitle"><?= $title; ?></h2>
          <p class="milestone__text"><?= $text; ?></p>
        </div>
      </section>

    <? endwhile; endif; ?>

  </div>

</article>
