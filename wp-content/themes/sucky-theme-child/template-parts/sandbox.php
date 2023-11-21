<?php
/**
 * Template Name: The Sandbox!
 */

get_header();
?>
<div 
class="position-relative z-2 p-5 d-flex justify-content-center align-items-center bg-warning"
>
<div class="container sandbox__container">
 <div class="time-converter">
    <form action="" class="w-100 d-flex" id="sandboxFormSecToMin">
      <input type="number" step="any" placeholder="Enter amount of seconds to convert to minutes" class="w-100" id="userInputSecToMin">
      <button type="submit" id="submitBtnSecToMin" class="ms-3 btn btn-primary shadow-md shadow-hover-md">
        Convert!
      </button>
      <button type="submit" id="clearBtnSecToMin" class="ms-3 btn btn-primary shadow-md shadow-hover-md">
        Clear!
      </button>
    </form>

    <form action="" class="w-100 d-flex mt-5" id="sandboxFormMinToSec">
      <input type="number" step="any" placeholder="Enter amount of minutes to convert to seconds" class="w-100" id="userInputMinToSec">
      <button type="submit" id="submitBtnMinToSec" class="ms-3 btn btn-primary shadow-md shadow-hover-md">
        Convert!
      </button>
      <button type="submit" id="clearBtnMinToSec" class="ms-3 btn btn-primary shadow-md shadow-hover-md">
        Clear!
      </button>
    </form>

    <p class="mt-3">Output: </p>
    <p id="sandboxOutput" class="bg-info mt-1 lead p-2"></p>
 </div>
</div>

</div>
<?php
// the_content();
get_footer();