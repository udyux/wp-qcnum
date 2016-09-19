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

    <h1 class="about__title about__title--main"><?= $beginning['date']; ?></h1>
    <div class="about__circle"></div>
    <div class="about__box">
      <h2 class="about__subtitle"><?= $beginning['title']; ?></h2>
      <p class="about__text about__text--beginning"><?= $beginning['text']; ?></p>
    </div>
  </header>

  <section class="about__section">
    <h2 class="about__title"><?= $waq['title']; ?></h2>
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
          <svg class="infographic__image"><use xlink:href="#about__volunteers"></use></svg>
        </div>
      </div>

      <div class="row__item col">
        <div class="col__item infographic infographic--small">
          <div class="infographic__image infographic__image--database"></div>
          <h3 class="infographic__title"><?= $waq['data']; ?> giga<br>bytes</h3>
        </div>

        <div class="col__item infographic infographic--small">
          <div class="infographic__image infographic__image--money"></div>
          <h3 class="infographic__title">budget<br>de <?= $waq['budget']; ?></h3>
        </div>

        <div class="col__item infographic infographic--small">
          <div class="infographic__image infographic__image--coffee"></div>
          <h3 class="infographic__title"><?= $waq['coffee']; ?><br>cafés</h3>
        </div>
      </div>
    </div>
  </section>

  <section class="about__section">

  </section>
</article>
