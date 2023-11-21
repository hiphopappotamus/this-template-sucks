(function($){
  // get all the links on the page and add a "new tab" icon next to any that have a target="_blank" attribute
 let $links = $('a');

 if($links.length) {
  $links.each(function(){
   let _this = $(this);

   if(_this.attr('target') === '_blank') {
    _this.append('<i class="fas fa-external-link-alt"></i>');
    specialClass(_this, 'target-blank position-relative');
   }

  });
 }

 function specialClass(elem, nameOfClass) {
   return elem.addClass(nameOfClass);
 }

})(jQuery);