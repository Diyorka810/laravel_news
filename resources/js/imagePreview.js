export default function initImagePreview() {
    const fileInput  = document.getElementById('image_file');
    const preview    = document.getElementById('imagePreview');
    const overlay    = document.getElementById('imgOverlay');
    const overlayImg = document.getElementById('overlayImg');

    if (!fileInput || !preview) return;

    fileInput.addEventListener('change', e => {
        const [file] = e.target.files;
        if (!file) return;
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    });

    preview.addEventListener('click', () => {
        if (preview.style.display === 'none') return;
        overlayImg.src = preview.src;
        overlay.style.display = 'flex';
    });

    overlay.addEventListener('click', () => {
        overlay.style.display = 'none';
        overlayImg.src = '';
    });
}
