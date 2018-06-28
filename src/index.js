import './scss/style.scss';
import 'bootstrap';
import logoImageSrc from './assets/logo.png';
import coverImageSrc from './assets/cover_background.png';

var logoImage = document.querySelector('.navbar-brand img');
logoImage.src = logoImageSrc;

var coverImage = document.querySelector('#cover-image');
coverImage.src = coverImageSrc;

