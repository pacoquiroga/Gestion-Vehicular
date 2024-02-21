const abrirform = document.querySelector("#abrirForm");
const cerrarForm = document.querySelector("#cerrarForm");
const form = document.querySelector("#popupform-container");



abrirform.addEventListener("click", () => {
    form.showModal();
});

cerrarForm.addEventListener("click", () => {
    form.close();
});

