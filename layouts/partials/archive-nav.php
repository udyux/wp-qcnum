<? # archive paged nav #
  $next  = _udyux_get_next_paged_link();
  $prev  = _udyux_get_prev_paged_link();
?>

<nav class="archive__nav">

  <? if ($next['link']): ?>
    <a class="postNav__link" href="<?= $next['link']; ?>"><?= $next['label']; ?></a>
  <? endif; if ($prev['link']): ?>
    <a class="postNav__link" href="<?= $prev['link']; ?>"><?= $prev['label']; ?></a>
  <? endif; ?>

</nav>
