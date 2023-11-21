(function($){
  if($('.bg-parallax').length) {
    console.log('parallax engaged!');
    $('.bg-parallax').each(function(){
        const dataSpeed = $(this).attr('data-scroll');
        $(this).bgParallax({
          speed: dataSpeed
        });
      });
    }
  }(jQuery));
