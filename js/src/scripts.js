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


  Scripts.enqueue(function genericHandlers() {
    [].forEach.call(document.querySelectorAll('.a[href^="#"], form button'), function(node) {
      node.addEventListener('click', function(e) {
        e.preventDefault();
      });
    });
  });

  // Scripts.enqueue(function cleanPosts() {
  //   [].forEach.call(document.querySelectorAll('.js-post'), function(node) {
  //   	[].forEach.call(node.children ,function(child) {
  //   		if (!child.children.length && !child.innerText.length) node.removeChild(child);
  //   	});
  //
  //     [].forEach.call(node.querySelectorAll('img'), function(image) {
  //       var parentNode = image.parentNode;
  //       parentNode.style.zIndex = 1;
  //       parentNode.style.margin = 0;
  //     });
  //   });
  // });


  $(document).ready(Scripts.execute);

})();
