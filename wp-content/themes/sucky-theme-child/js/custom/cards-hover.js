(function($){
 /**
  * handle card-type: solid color background hover styles so we don't gotta risk several style tags getting rendered on the pg
  */
 let $card = $('.card');

 if($card.length) {
  $card.each(function(){
   let _this = $(this),
       linkColor = _this.attr('data-color'),
       linkHover = _this.attr('data-hover-color'),
       cardOGBG = _this.attr('data-initial-bg'),
       cardHover = _this.attr('data-hover-bg');

   if(linkColor){
     _this.css('color', `${linkColor}`);
   }

   _this.on('mouseenter', function(){
    _this.css('color', `${linkHover}`);
    _this.css('background-color', `${cardHover}`);
   });

   _this.on('mouseleave', function(){
    _this.css('color', `${linkColor}`);
    _this.css('background-color', `${cardOGBG}`);
   });

  });
 }
})(jQuery);