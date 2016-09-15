<? # archive page layout # ?>

<section class="archive">

  <?
    if ( have_posts() ):
      while ( have_posts() ) : the_post();
        _udyux_get_partial('archive', 'preview');
      endwhile;

    else:
      _udyux_get_partial('archive', 'none');
    endif;

    _udyux_get_partial('archive', 'nav');
  ?>

</section>
