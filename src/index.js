import './scss/style.scss';
import 'bootstrap';
import Logo from './assets/logo.png';
import CoverBackground from './assets/cover_background.png';

var logo = document.querySelector('.navbar-brand img');
logo.src = Logo;

var coverBackground = document.querySelector('#cover-background');
coverBackground.src = CoverBackground;

