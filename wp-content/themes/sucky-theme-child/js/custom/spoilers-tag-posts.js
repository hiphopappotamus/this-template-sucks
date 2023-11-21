(function($){
 if($('.spoiler-content').length) {
  // uses the custom attribute attached to the 'article.spoiler-content' element in order to utilize WordPress string translations
  const spoilerText = $('.spoiler-content').attr('data-warning'); 

  const spoilerTag = `
    <div class="position-relative d-flex card__spoilers w-100 moveUpDown justify-content-center align-items-center mt-3 mt-md-5">
          <span class="top-0 card__spoilers--txt small shadow p-2 position-relative text-bg-spoilers">
        ${spoilerText}
      </span>
    </div>
  `;

  let $subtitle = $('.hero__subtitle');
  $subtitle.append(spoilerTag);
 }
})(jQuery);