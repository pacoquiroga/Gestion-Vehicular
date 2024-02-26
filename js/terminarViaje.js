const abrirAlertaViaje = document.querySelector("#abrirAlertaViaje");
const cerrarFormTV = document.querySelector("#cerrarFormTV");
const terminarViaje = document.querySelector("#btnTerminarViaje");
const popupTerminarViaje = document.querySelector("#popupTerminarViaje");

btnTerminarViaje.addEventListener("click", () => {
    popupTerminarViaje.showModal();
});

cerrarFormTV.addEventListener("click", () => {
    popupTerminarViaje.close();
});

abrirAlertaViaje.addEventListener("click", () => {
    alert("El vehiculo ya se encuentra en ruta");
});





terminarViaje.addEventListener("click", function() {
    
    // Formatear la fecha en formato dd/mm/yyyy
    var fechaInicio = new Date().toISOString().split("T")[0];

    // Plasmar la fecha en el elemento h3
    //document.getElementById('fechaInicioP').textContent = fechaFormateada;

    // Obtener la hora actual
    var horaActual = new Date();

    // Formatear la hora en formato legible
    var horaFormateada = horaActual.toLocaleTimeString('es-ES');

    // Plasmar la hora en el elemento h3
    //document.getElementById('horaInicioP').textContent = horaFormateada;

    document.getElementById('fechaFinP').value = fechaInicio;
    document.getElementById('horaFinP').value = horaFormateada;
});


cerrarFormTV.addEventListener("click", function() {
    // Seleccionar todos los inputs dentro del formulario
    var inputs = document.querySelectorAll("#terminarViaje input");
    
    // Iterar sobre cada input y limpiar su valor
    inputs.forEach(function(input) {
        if(input.type != "submit") {
            input.value = ""; // Limpiar el valor del input
        }
    });
});
