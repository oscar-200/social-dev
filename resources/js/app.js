import Dropzone from 'dropzone';

Dropzone.autoDiscover = false;



const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Sube tu imagen aqui',
    acceptedFiles: '.png,.jpg,.jpeg,.gif',
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar archivo',
    maxFiles: 1,
    uploadMultiple: false,

    init: function () {
        const value = document.querySelector('[name="imagen"]').value;

        if (value.trim()) {
            const imagenPublicada = {};

            imagenPublicada.size = 1234;
            imagenPublicada.name = value;

            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`);

            

            imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete');
        }
    }
});


dropzone.on('success', (file, response) => {
    document.querySelector('[name="imagen"]').value = response.imagen;
});

dropzone.on('removedfile', (file) => { 
    document.querySelector('[name="imagen"]').value = "";
 });



