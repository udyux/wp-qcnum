<? # newsletter signup form #
  $signupNode = array(
    'home'  => $data,
    'title' => get_field('signup_title', 'options'),
    'msg'   => get_field('signup_message', 'options'),
    'label' => get_field('signup_label', 'options')
  );
?>

<form class="signup<? if ($signupNode['home']) echo ' signup--home'; ?>">
  <h4 class="signup__title"><? echo $signupNode['title']; ?></h4>

  <? if (!$signupNode['home']): ?>

    <p class="signup__message"><? echo $signupNode['msg']; ?></p>

  <? endif; ?>

  <fieldset>
    <input id="signup_email" name="signup_email" class="signup__input" type="email" placeholder="Votre courriel" autocomplete="email" spellcheck="false"/>
    <button id="signup" class="signup__button"><? echo $signupNode['home'] ? $signupNode['label'] : 'GO!'; ?></button>
  </fieldset>
</form>
