// preview image create_pet

const imageInput = document.getElementById('imageInput');
const previewDiv = document.querySelector('.create-pet-image-preview');

imageInput.addEventListener('change', function (event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            previewDiv.style.backgroundImage = `url(${e.target.result})`;
        }
        reader.readAsDataURL(file);
    }
});