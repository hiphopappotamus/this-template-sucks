/**
 * Name: jquery.background-parallax-scroll
 * Author: Takashi Kitajima (inc2734)
 * Author URI: https://2inc.org
 * License: MIT
 * https://www.jqueryscript.net/demo/Background-Parallax-Effect-With-jQuery-CSS/
 * @param { speed }
 */
(function($){
  $.fn.bgParallax = function(params) {
    params = $.extend({
      speed: 3 // default
    }, params);

    return this.each(function(i, e){
      const target = $(e);
      let bpy = 0;

      init();
      setPosition(0);

      $(window).resize(() => {
        init();
        setPosition($(window).scrollTop());
      });

      $(window).scroll(() => {
        setPosition($(window).scrollTop());
      });

      function init() {
        target.css('background-position-y', '');
        bpy = target.css('background-position-y');
      }

      function setPosition(scroll) {
        if ('fixed' === target.css('background-attachment')) {
          scroll = parseInt(scroll);
          const offset = target.offset().top;
          const parallax = ((scroll - offset) / params.speed);
          const newBpy = `calc(${bpy} - ${parallax}px)`;
          target.css('background-position-y', newBpy);
        }
      }
    });
  };
}(jQuery));
