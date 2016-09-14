<? # newsletter signup form #
  $home  = _udyux_page_is('home');
  $title = get_field('signup_title', 'options');
  $msg   = get_field('signup_message', 'options');
  $label = get_field('signup_label', 'options');
?>

<form class="signup<? if ($home) echo ' signup--home'; ?>">
  <h4 class="signup__title"><?= $title; ?></h4>

  <? if (!$home): ?>

    <p class="signup__message"><?= $msg; ?></p>

  <? endif; ?>

  <div class="signup__field">
    <input id="signup_email" name="signup_email" class="signup__input" type="email" placeholder="Votre courriel" autocomplete="email" spellcheck="false"/>
    <button id="signup" class="signup__button"><?= $home ? $label : 'GO!'; ?></button>
  </div>
</form>
