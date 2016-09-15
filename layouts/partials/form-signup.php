<? # newsletter signup form #
  $home  = _udyux_page_is('home');
  $title = get_field('signup_title', 'options');
  $msg   = get_field('signup_message', 'options');
  $label = $home ? get_field('signup_label', 'options') : 'GO!';

  $classlist = array(
    'form'   => array('signup'),
    'button' => array('button', 'button--signup')
  );

  if ($home) {
    $classlist['form'][]   = 'signup--home';
    $classlist['button'][] = 'button--home';
  }
?>

<form class="<?= implode(' ', $classlist['form']); ?>">
  <h4 class="signup__title"><?= $title; ?></h4>

  <? if (!$home): ?>

    <p class="signup__message"><?= $msg; ?></p>

  <? endif; ?>

  <div class="signup__field">
    <input id="signup_email" name="signup_email" class="signup__input" type="email" placeholder="Votre courriel" autocomplete="email" spellcheck="false"/>
    <button id="signup" class="<?= implode(' ', $classlist['button']); ?>"><?= $label; ?></button>
  </div>
</form>
