import './bootstrap';
import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';

const swiper = new Swiper('.swiper', {
  loop: true,
  pagination: { el: '.swiper-pagination' },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
});

document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('image_file');
    const imagesContainer = document.getElementById('all-images');
    let newImageFiles = [];

    input.addEventListener('change', function () {
        Array.from(input.files).forEach((file, index) => {
            newImageFiles.push(file);

            const reader = new FileReader();
            reader.onload = function (e) {
                const wrapper = document.createElement('div');
                wrapper.classList.add('position-relative', 'd-inline-block', 'text-center');
                wrapper.setAttribute('data-new-image-index', newImageFiles.length - 1);

                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('preview-img');

                const closeBtn = document.createElement('button');
                closeBtn.type = 'button';
                closeBtn.classList.add('btn-close', 'position-absolute', 'top-0', 'end-0', 'bg-white');
                closeBtn.onclick = function () {
                    removeNewImage(wrapper);
                };

                const radioWrapper = document.createElement('div');
                radioWrapper.classList.add('form-check', 'mt-1', 'text-center');

                const radio = document.createElement('input');
                radio.type = 'radio';
                radio.name = 'main_image';
                radio.classList.add('form-check-input');
                radio.value = `new_${newImageFiles.length - 1}`;
                radio.id = `main_new_${newImageFiles.length - 1}`;

                const label = document.createElement('label');
                label.classList.add('form-check-label', 'small');
                label.htmlFor = radio.id;
                label.textContent = 'Главная';

                radioWrapper.appendChild(radio);
                radioWrapper.appendChild(label);

                wrapper.appendChild(img);
                wrapper.appendChild(closeBtn);
                wrapper.appendChild(radioWrapper);
                imagesContainer.appendChild(wrapper);
            };

            // ❗️ Ты забыл вызывать reader.readAsDataURL(file)
            reader.readAsDataURL(file);
        });

        // ❗️ Обновляем input.files после цикла
        const dataTransfer = new DataTransfer();
        newImageFiles.forEach(file => {
            if (file) dataTransfer.items.add(file);
        });
        input.files = dataTransfer.files;
    });

    window.removeExistingImage = function (id) {
        const container = document.querySelector(`[data-existing-image-id="${id}"]`);
        container.remove();
    };

    window.removeNewImage = function (wrapper) {
        const index = parseInt(wrapper.getAttribute('data-new-image-index'));
        newImageFiles[index] = null;

        const dataTransfer = new DataTransfer();
        newImageFiles.forEach(file => {
            if (file) dataTransfer.items.add(file);
        });
        input.files = dataTransfer.files;

        wrapper.remove();
    };
});
