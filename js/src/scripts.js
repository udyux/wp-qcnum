/* main theme scripts */
(function mainScripts() {

  // script queue
  var Scripts = {
    queue: [],
    enqueue: function(script) {
      Scripts.queue.push(script);
    },
    execute: function() {
      Scripts.queue.forEach(function(script) {
        script();
      });
    }
  };


  // leverage browser caching by injecting svg sprite
  Scripts.enqueue(function loadSvg() {
    var ajax = new XMLHttpRequest();
    var url = getUrl('icons/sprite.svg');
    ajax.open('GET', url, true);
    ajax.send();
    ajax.onload = function() {
      var container = document.createElement('object');
      container.style.display = 'none';
      container.innerHTML = ajax.responseText;
      document.body.insertBefore(container, document.body.childNodes[0]);
    };
  });


  // clean posts of empty tags
  Scripts.enqueue(function cleanPosts() {
    var postContent = document.querySelector('.js-cleanPost');

    var outerLoop = function(node) {
      var links = node.querySelectorAll('a');

      if (!node.innerHTML && node.tagName !== 'IMG') node.parentNode.removeChild(node);
      if (node.classlist && node.classlist.contains('wp-caption')) node.style = null;
      if (links.length) innerLoop(links);
    };

    var innerLoop = function(links) {
      [].forEach.call(links, function(link) {
        var img = link.querySelector('img');

        if (img) {
          link.parentNode.insertBefore(img.cloneNode(), link);
          link.parentNode.removeChild(link);
        }
      });
    };

    if (postContent) {
      postContent.innerHTML = postContent.innerHTML.replace(/&nbsp;/g, ' ');

      [].forEach.call(postContent.children, function(node) {
        outerLoop(node);
      });
    }
  });


  // generic event handlers
  Scripts.enqueue(function genericHandlers() {
    [].forEach.call(document.querySelectorAll('.a[href^="#"], form button'), function(node) {
      node.addEventListener('click', function(e) {
        e.preventDefault();
      });
    });
  });


  $(document).ready(Scripts.execute);

})();
