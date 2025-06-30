import './bootstrap';
import initImagePreview from './imagePreview';
import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';

document.addEventListener('DOMContentLoaded', () => {
    initImagePreview();
});

const swiper = new Swiper('.swiper', {
  loop: true,
  pagination: { el: '.swiper-pagination' },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
});