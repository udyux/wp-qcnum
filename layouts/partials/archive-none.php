<? # archive no results #
  $message = is_search() ?
    ":(<br>on n'a rien trouver pour votre recherche" :
    ":(<br>quelque chose qu'on a pas prévu c'est produit.<br>retournez en arrière et gardez ça secret!";
?>

<div class="archive__none">
  <h5 class="archive__message"><?= $message; ?></h5>
</div>
