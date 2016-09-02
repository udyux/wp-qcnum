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

  // TODO: convert hex to rgba
  // colorize feed items
  Scripts.enqueue(function bgColors() {
    var colors = ['hsla(205,92.5%,42%,.9)','hsla(205,92.5%,47%,.9)','hsla(205,92.5%,47.5%,.9)','hsla(165,100%,40%,.9)','hsla(165,100%,42.5%,.9)','hsla(165,100%,45%,.9)'];
    [].forEach.call(document.querySelectorAll('.js-color'), function(node) {
      var i = Math.random()*colors.length>>0;
      node.style.backgroundColor = colors[i];
      colors.splice(i,1);
    });
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
