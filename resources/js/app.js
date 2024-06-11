import "./bootstrap";
import "~resources/scss/app.scss";
import * as bootstrap from "bootstrap";
import.meta.glob(["../img/**", "../fonts/**"]);

const deleteSubmitButtons = document.querySelectorAll(".delete-button");
deleteSubmitButtons.forEach((button)=>{
    button.addEventListener('click', (e)=>{
        e.preventDefault();

        const dataTitle = button.getAttribute("data-item-title");
        const dataId = button.getAttribute('data-item-id');

        const modal = document.getElementById("deleteModal");

        const bootstrapModal = new bootstrap.Modal(modal);
        bootstrapModal.show();

        const modalItemTitle = modal.querySelector("#modal-item-title");
        modalItemTitle.textContent = dataTitle;

        const buttonDelete = modal.querySelector("button.btn-danger");

        buttonDelete.addEventListener("click", () => {
            button.parentElement.submit();
        });
    })
});

//funzione per prendere i file

const image = document.getElementById("upload_image");

//verifica se esiste nella pagina
if (image) {
    image.addEventListener("change", () => {
        //prendo l'immagine
        const preview = document.getElementById("upload_preview");

        //creo nuovo oggetto file reader
        const oFReader = new FileReader();

        //uso il metodo readAsDataURL dell'oggetto creato per leggere il file
        oFReader.readAsDataURL(image.files[0]);

        //al termine della lettura del file uso l'evento onload
        oFReader.onload = function (event) {
            //metto nel src della preview l'immagine
            preview.src = event.target.result;
        };
    });
}