/**
 * inspirational sites: 
 *    - https://www.proudlyportugal.pt/
 *          - using jquery's draggable ui, and has an animated favicon
 *          - has loading pages, they might be using nextjs and wpgraphql
 */
(function($){
 if($('.sandbox').length) {
  var $output = $('#sandboxOutput'); // use var instead of let or const so this element's available to all function blocks (not super great practice, but for convenience's sake this is just how it do)

  const $btnSecToMin = $('#submitBtnSecToMin');
  const $clearBtnSecToMin = $('#clearBtnSecToMin');
  const $submitBtnMinToSec = $('#submitBtnMinToSec');
  const $clearBtnMinToSec = $('#clearBtnMinToSec');

 // prevent form submission (no need for e.preventDefault()) 
 $('.sandbox__container form').each(function(){
  $(this).submit(false);
 });

 $clearBtnSecToMin.on('click', function() {
  clearContents('#userInputSecToMin');
 });

 $clearBtnMinToSec.on('click', function(){
  clearContents('#userInputMinToSec');
 });

 $submitBtnMinToSec.on('click', function(){
  $output.append(convertToSeconds(userInputMinToSec));
 });

 $btnSecToMin.on('click', function(){
   $output.append(convertToMinutes(userInputSecToMin));
 });

}

 // functions!
 function clearContents(elem) {
  $output.empty();
  $(elem).val('');
 }

 function convertToMinutes(seconds) {
  const userInputSecToMin = $('#userInputSecToMin').val();
  const units = 60;

  seconds = userInputSecToMin;

  if(!$output.empty()) {
   return false;
  } else {
   return (`${seconds / units} minutes`);
  }
 }

 function convertToSeconds(minutes) {
  const userInputMinToSec = $('#userInputMinToSec').val();
  const units = 60;

  minutes = userInputMinToSec;

  if(!$output.empty()) {
   return false;
  } else {
   return (`${minutes * units} seconds`);
  }
 }

})(jQuery);