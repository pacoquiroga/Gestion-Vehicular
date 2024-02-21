const abrirformV = document.querySelector("#abrirFormV");
const cerrarFormV = document.querySelector("#cerrarFormV");
const formV = document.querySelector("#popupformViajes");

abrirformV.addEventListener("click", () => {
    formV.showModal();
});

cerrarFormV.addEventListener("click", () => {
    formV.close();
});

function bloquearSelectUbiI() {
    var selectI = document.getElementById("ubiInicioS");
    var inputI = document.getElementById("nuevaUbiI-container");
    var bloquearSelectI = document.getElementById("nuevaUbiI");
    var selectF = document.getElementById("ubiFinS");
    var bloquearSelectF = document.getElementById("nuevaUbiF");
    var inputF = document.getElementById("nuevaUbiF-container");

    if (bloquearSelectI.checked) {
        selectI.disabled = true;
        selectI.value = "";
        selectF.value = "";
        bloquearSelectF.checked = true;
        inputI.style.display = "block";
        inputF.style.display = "block";
        bloquearSelectF.disabled = true;
        selectF.disabled = true;

    } else {
        selectI.disabled = false;
        inputI.style.display = "none";
        inputF.style.display = "none";
        selectF.disabled = false;
        bloquearSelectF.checked = false;
        bloquearSelectF.disabled = false;
        selectF.disabled = false;

    }
}

function bloquearSelectUbiF() {
    var selectI = document.getElementById("ubiInicioS");
    var selectF = document.getElementById("ubiFinS");
    var inputF = document.getElementById("nuevaUbiF-container");
    var bloquearSelectF = document.getElementById("nuevaUbiF");

    if (bloquearSelectF.checked) {
        selectF.disabled = true;
        selectF.value = "";
        inputF.style.display = "block";
        
    } else {
        selectF.disabled = false;
        inputF.style.display = "none";
    }
}

document.getElementById("abrirFormV").addEventListener("click", function() {
    
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

    document.getElementById('fechaInicio').value = fechaInicio;
    document.getElementById('horaInicio').value = horaFormateada;
});



document.getElementById("cerrarFormV").addEventListener("click", function() {
    // Seleccionar todos los inputs dentro del formulario
    var inputs = document.querySelectorAll("#popupformViajes input");
    
    // Iterar sobre cada input y limpiar su valor
    inputs.forEach(function(input) {
        if(input.type != "submit") {
            input.value = ""; // Limpiar el valor del input
        }
    });

    // Opcionalmente, también podrías limpiar los selects
    var selects = document.querySelectorAll("#popupformViajes select");
    selects.forEach(function(select) {
        select.selectedIndex = 0; // Reiniciar la selección del select
    });
});

