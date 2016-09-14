<? # archive no results #
  $type = _udyux_page_is();
  $message = get_field("{$type}_none", 'options');
  $title = get_field('title_none', 'options');
?>

<div class="archive__none">
  <h6 class="archive__message"><?= $title; ?></h6>
  <p><?= $message; ?></p>
</div>
