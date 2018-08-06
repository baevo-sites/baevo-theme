import './scss/style.scss';
import 'bootstrap';
import jQuery from 'jquery';
//import 'parsleyjs';
//import 'parsleyjs/src/i18n/es';
import logoImageSrc from './assets/logo.png';
import coverImageSrc from './assets/cover_background.png';
import contactTitleImageSrc from './assets/contact-title.png';
/*
jQuery(document).ready(function($){
  $("#new-contact").parsley({
    errorClass: 'is-invalid text-danger',
    //successClass: 'is-valid', // Comment this option if you don't want the field to become green when valid. Recommended in Google material design to prevent too many hints for user experience. Only report when a field is wrong.
    errorsWrapper: '<span class="form-text text-danger"></span>',
    errorTemplate: '<span></span>',
    trigger: 'change'
  }); // If you want to validate fields right after page loading, just add this here : .validate()
});
*/

jQuery(document).ready(function($) {
  
  function removeMessage() {
    var $message = $('div#message');
    if ($message.length) {
      $message.remove(); 
    }
  }

  var $form = $('#new-contact');
  $form
    .find('input[id^="acf-field"]')
    .focus(removeMessage)
  
  $form
    .find('input[type="submit"]')
    .click(removeMessage)

});

var logoImage = document.querySelector('.navbar-brand img');
logoImage.src = logoImageSrc;

var coverImage = document.querySelector('#cover-image');
coverImage.src = coverImageSrc;

var contactTitleImage = document.querySelector('#contact-title');
contactTitleImage.src = contactTitleImageSrc;

