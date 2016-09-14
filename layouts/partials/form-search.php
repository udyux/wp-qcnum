<form id="search-form" role="search" method="GET" class="search" action="<?= home_url( '/' ); ?>">
  <input id="search-input" class="search__input" type="text" placeholder="Rechercher ..." value="<?= get_search_query(); ?>" name="s" autocomplete="off" required>
  <label class="search__label" for="search-input">
    <svg class="search__icon"><use xlink:href="#search"></use></svg>
  </label>
  <input id="search-submit" class="search__submit" type="submit" value="">
</form>
