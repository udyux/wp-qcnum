<? # newsletter signup form #
  $signupNode = array(
    'home'  => $data,
    'title' => get_field('signup_title', 'options'),
    'msg'   => get_field('signup_message', 'options'),
    'label' => get_field('signup_label', 'options')
  );
?>

<form class="signup <? if ($signupNode['home']) echo 'signup--home'; ?>">
  <h4 class="signup__title"><? echo $signupNode['title']; ?></h4>

  <? if (!$signupNode['home']): ?>

    <p><? echo $signupNode['msg']; ?></p>

  <? endif; ?>

  <fieldset class="signup__field">
    <input id="signup_email" name="signup_email" class="form__input" type="email" placeholder="Votre courriel" autocomplete="email" spellcheck="false"/>
    <button id="signup" class="form__button"><? echo $signupNode['label']; ?></button>
  </fieldset>
</form>
