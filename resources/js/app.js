import Dropzone  from "dropzone";

const input = document.querySelector("#imagen");


// If you are using an older version than Dropzone 6.0.0,
// then you need to disabled the autoDiscover behaviour here:
Dropzone.autoDiscover = false;


const dropzone = document.querySelector('#dropzone');
if (dropzone) {

  const input = document.querySelector('#imagen');

  let myDropzone = new Dropzone(dropzone, {
    directDefaultMessage: "Sube aca tu imagen",
    acceptedFiles: ".png, .jpg",
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar imagen',
    maxFiles:1,
    uploadMultiple:false,

    init: function(){
      if (input.value !== "") {
        const imagen = {}
        imagen.size = 1234;
        imagen.name = input.value;
        this.options.addedfile.call(this, imagen);
        this.options.thumbnail.call(this, imagen,`../uploads/${input.value}`);
        imagen.previewElement.classList.add("dz-success", "dz-complete");

      }
    }

});




myDropzone.on("success", function(file, xhr,formData) {
  const inputImagen = document.querySelector ("#imagen");
  inputImagen.value = xhr.img_name;
});
  
}
