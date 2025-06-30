import './bootstrap';
import initImagePreview from './imagePreview';

document.addEventListener('DOMContentLoaded', () => {
    initImagePreview();
});

// или для обычного JS:
import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';

// Инициализация (если plain JS)
const swiper = new Swiper('.swiper', {
  loop: true,
  pagination: { el: '.swiper-pagination' },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
});