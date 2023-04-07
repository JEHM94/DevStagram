import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Arrastra una imagen para subir',
    acceptedFiles: '.png,.jpg,.jpeg,.gif',
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar Imagen',
    maxFiles: 1,
    uploadMultiple: false,

    // Para cargar la imagen subida si falla la validación
    init: function () {
        if (document.querySelector('[name="imagen"]').value.trim()) {
            const imagenPrevia = {};
            imagenPrevia.size = 1234;
            imagenPrevia.name = document.querySelector('[name="imagen"]').value;

            this.options.addedfile.call(this, imagenPrevia);
            this.options.thumbnail.call(this, imagenPrevia, `/uploads/${imagenPrevia.name}`);
            
            imagenPrevia.previewElement.classList.add('dz-success', 'dz-complete');
        }
    }
});

dropzone.on('success', function (response, file) {
    document.querySelector('[name="imagen"]').value = file.imagen;
});

dropzone.on('removedfile', function (response, file) {
    document.querySelector('[name="imagen"]').value = '';
});