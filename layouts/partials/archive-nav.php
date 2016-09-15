<? # archive paged nav #
  $next  = _udyux_get_next_paged_link();
  $prev  = _udyux_get_prev_paged_link();
?>

<nav class="archive__nav">

  <? if ($next['link']): ?>
    <a href="<?= $next['link']; ?>">
      <button class="button"><?= $next['label']; ?></button>
    </a>
  <? endif; if ($prev['link']): ?>
    <a href="<?= $prev['link']; ?>">
      <button class="button"><?= $prev['label']; ?></button>
    </a>
  <? endif; ?>

</nav>
