/* main theme scripts */

// native scripts
(function() {

  // levergae browser caching by injecting svg sprite
  (function loadSvg() {
    var ajax = new XMLHttpRequest();
    var url = getUrl('icons/sprite.svg');
    ajax.open('GET', url, true);
    ajax.send();
    ajax.onload = function() {
      var div = document.createElement('div');
      div.innerHTML = ajax.responseText;
      document.body.insertBefore(div, document.body.childNodes[0]);
    };
  })();

})();


// jquery scripts
$(document).ready(function() {

  // prevent default for on-page anchors and form buttons
  $(document).on('click', 'a[href^="#"], form button', false);


  // force images above paragraphs
	$('.entry-content p').each(function() {
		if ($(this).find('img').length) $(this).css({'z-index': 1, 'margin': 0});
	});


  // remove empty post content tags
	$('.entry-content article').children().each(function() {
		if (!$(this).html().length) $(this).remove();
	});

});
