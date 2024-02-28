/* DECLARACION DE VARIABLES */
let abrirFormMantenimiento = document.getElementById("abrirFormMantenimiento");
let popupFormMantenimiento = document.getElementById("popupFormMantenimiento");
let cerrarFormMantenimiento = document.getElementById(
  "cerrarFormMantenimiento"
);
let fechaInicioMantenimiento = document.getElementById(
  "fechaInicioMantenimiento"
);
let nombreMantenimiento = document.getElementById("nombreMantenimiento");

/* EVENTOS */
abrirFormMantenimiento.addEventListener("click", () => {
  popupFormMantenimiento.showModal();
  peticionMostrarMantenimientos();
});

function cerrarPopupMantenimiento() {
  popupFormMantenimiento.close();
}

fechaInicioMantenimiento.setAttribute(
  "value",
  new Date().toISOString().split("T")[0]
);

/* FUNCIONES */

/* FUNCION DE PETICION AJAX PARA PEDIR TODOS LOS MANTENIMIENTOS DE LA BD */
function peticionMostrarMantenimientos() {
  // ======== PETICION AJAX =========
  if (window.XMLHttpRequest) {
    conexion = new XMLHttpRequest();
  } else if (window.ActiveXObject) {
    conexion = new ActiveXObject("Microsoft.XMLHTTP");
  }

  // Preparando la función de respuesta
  conexion.onreadystatechange = mostrarTodosLosMantenimientos;

  // Realizando la petición HTTP con método POST
  conexion.open("POST", "../formularios/buscarMantenimientos.php");
  conexion.setRequestHeader(
    "Content-Type",
    "application/x-www-form-urlencoded"
  );
  conexion.send("nocache=" + Math.random());

  // ======== FIN PETICION AJAX =========
}

/* FUNCION PARA MOSTRAR LOS MANTENIMIENTOS RECIBIDOS DE LA BD EN EL SECTION DEL FORMULARIO */
function mostrarTodosLosMantenimientos() {
  if (conexion.readyState == 4) {
    if (conexion.responseText === "No existen mantenimientos") {
      nombreMantenimiento.innerHTML = `
        <option value="" selected disabled>No existen mantenimientos registrados en la Base de Datos</option>
      `;
      return;
    } else {
      nombreMantenimiento.innerHTML = `
        <option value="" selected disabled>Seleccione el nombre del mantenimiento</option>
      `;
      var mantenimientos = JSON.parse(conexion.responseText);
      for (let i = 0; i < mantenimientos.length; i++) {
        nombreMantenimiento.innerHTML += `
                <option value="${mantenimientos[i].IDMantenimiento}">${mantenimientos[i].nombreMantenimiento}</option>
            `;
      }
    }
  }
}

/* FORMULARIOS: VALIDACIONES Y OTROS */

/* AGREGAR NUEVO MANTENIMIENTO CON SU TIPO */
let nuevoMantenimiento = document.getElementById("nuevoMantenimiento");
let contenedorTodosMantenimientos = document.getElementById(
  "contenedorTodosMantenimientos"
);
let contenedorNuevoMantenimiento = document.getElementById(
  "contenedorNuevoMantenimiento"
);
nuevoMantenimiento.addEventListener("change", () => {
  if (nuevoMantenimiento.checked) {
    contenedorNuevoMantenimiento.removeAttribute("hidden");
    contenedorTodosMantenimientos.setAttribute("hidden", "");
    nombreMantenimiento.value = "";
  } else {
    contenedorNuevoMantenimiento.setAttribute("hidden", "");
    contenedorTodosMantenimientos.removeAttribute("hidden");
    nombreNuevoMantenimiento.value = "";
    tipoNuevoMantenimiento.value = "";
  }
});

/* VALIDACION DE CAMPOS DEL FORMULARIO */
let formularioMantenimiento = document.getElementById(
  "formularioMantenimiento"
);
let nombreNuevoMantenimiento = document.getElementById(
  "nombreNuevoMantenimiento"
);
let tipoNuevoMantenimiento = document.getElementById("tipoNuevoMantenimiento");
let costoMantenimiento = document.getElementById("costoMantenimiento");

let enviarFormularioMantenimiento = document.getElementById(
  "enviarFormularioMantenimiento"
);

formularioMantenimiento.addEventListener("submit", (e) => {
  e.preventDefault();

  validarCamposMantenimiento();
});

function validarCamposMantenimiento() {
  let IDVehiculo = document.getElementById("IDVehiculoFormMantenimiento").value;
  let valorNuevoMantenimiento = nuevoMantenimiento.checked;
  let IDMantenimiento = nombreMantenimiento.value;
  let valorNombreNuevoMantenimiento = nombreNuevoMantenimiento.value;
  let valorTipoNuevoMantenimiento = tipoNuevoMantenimiento.value;
  let valorCostoMantenimiento = costoMantenimiento.value;
  let camposValidos = true;

  if (valorNuevoMantenimiento) {
    if (valorNombreNuevoMantenimiento === "") {
      mostrarError(
        nombreNuevoMantenimiento,
        "Ingrese un nombre para el nuevo mantenimiento"
      );
      camposValidos = false;
    } else if (!esNombreValido(valorNombreNuevoMantenimiento)) {
      mostrarError(
        nombreNuevoMantenimiento,
        "El nombre del mantenimiento no puede contener números ni caracteres especiales"
      );
      camposValidos = false;
    } else {
      mostrarCampoValido(nombreNuevoMantenimiento);
    }

    if (valorTipoNuevoMantenimiento === "") {
      mostrarError(
        tipoNuevoMantenimiento,
        "Seleccione un tipo para el nuevo mantenimiento"
      );
      camposValidos = false;
    } else {
      mostrarCampoValido(tipoNuevoMantenimiento);
    }
  } else {
    if (IDMantenimiento === "") {
      mostrarError(nombreMantenimiento, "Seleccione un mantenimiento");
      camposValidos = false;
    } else {
      mostrarCampoValido(nombreMantenimiento);
    }
  }

  if (valorCostoMantenimiento == "") {
    mostrarError(costoMantenimiento, "Ingrese el costo del mantenimiento");
    camposValidos = false;
  } else if (
    isNaN(valorCostoMantenimiento) ||
    valorCostoMantenimiento < 0 ||
    valorCostoMantenimiento > 3000
  ) {
    mostrarError(costoMantenimiento, "El costo debe ser un número");
    camposValidos = false;
  } else {
    mostrarCampoValido(costoMantenimiento);
  }

  if (camposValidos) {
    if (valorNuevoMantenimiento) {
      peticionNuevoMantenimiento(
        valorNombreNuevoMantenimiento,
        valorTipoNuevoMantenimiento
      );
    } else {
      peticionAsignarMantenimiento(
        IDMantenimiento,
        IDVehiculo,
        valorCostoMantenimiento
      );
    }
  }
}

function mostrarError(elemento, mensaje) {
  const contenedorInput = elemento.parentElement;
  const contenedorMensaje = contenedorInput.querySelector(".error");

  contenedorMensaje.innerText = mensaje;
  contenedorInput.classList.add("error");
  contenedorInput.classList.remove("valido");
}

function mostrarCampoValido(elemento) {
  const contenedorInput = elemento.parentElement;
  const contenedorError = contenedorInput.querySelector(".error");

  contenedorError.innerText = "";
  contenedorInput.classList.add("valido");
  contenedorInput.classList.remove("error");
}

function esNombreValido(nombre) {
  const validacion = /^[a-zA-ZÀ-ÿ\s]{1,70}$/;
  return validacion.test(nombre);
}

/* FUNCIONES CON PETICIONES AJAX A BD */

/*===============================================
INICIO FUNCIONES PARA AGREGAR NUEVO MANTENIMIENTO
=================================================*/
function peticionNuevoMantenimiento(nombreMantenimiento, tipoMantenimiento) {
  // ======== PETICION AJAX =========
  if (window.XMLHttpRequest) {
    conexion = new XMLHttpRequest();
  } else if (window.ActiveXObject) {
    conexion = new ActiveXObject("Microsoft.XMLHTTP");
  }

  // Preparando la función de respuesta
  conexion.onreadystatechange = ingresarNuevoMantenimiento;

  // Realizando la petición HTTP con método POST
  conexion.open("POST", "../formularios/nuevoMantenimiento.php");
  conexion.setRequestHeader(
    "Content-Type",
    "application/x-www-form-urlencoded"
  );
  conexion.send(
    "nombreMantenimiento=" +
      nombreMantenimiento +
      "&tipoMantenimiento=" +
      tipoMantenimiento +
      "&nocache=" +
      Math.random()
  );

  // ======== FIN PETICION AJAX =========
}

function ingresarNuevoMantenimiento() {
  if (conexion.readyState == 4) {
    if (conexion.responseText === "repetido") {
      Swal.fire({
        title: "MANTENIMIENTO REPETIDO!",
        text: "Ya existe un mantenimiento con ese nombre y tipo en la base de datos.",
        icon: "error",
        confirmButtonText: "Ingresar otro Mantenimiento",
        target: "#popupFormMantenimiento",
      });
    } else if (conexion.responseText === "Error al insertar mantenimiento") {
      Swal.fire({
        title: "NO SE PUDO INSERTAR EL MANTENIMIENTO!",
        text: `¡${conexion.responseText}!`,
        icon: "error",
        confirmButtonText: "Regresar",
        target: "#popupFormMantenimiento",
      }).then((result) => {
        if (result.isConfirmed) {
          loader("#popupFormMantenimiento");
          window.location.reload();
        }
      });
    } else {
      peticionAsignarMantenimiento(
        conexion.responseText,
        IDVehiculoFormMantenimiento.value,
        costoMantenimiento.value
      );
    }
  }
}
/*===============================================
FIN FUNCIONES PARA AGREGAR NUEVO MANTENIMIENTO
=================================================*/

/*====================================================
INICIO FUNCIONES PARA ASIGNAR MANTENIMIENTO A VEHICULO
======================================================*/
function peticionAsignarMantenimiento(
  IDMantenimiento,
  IDVehiculo,
  costoMantenimiento
) {
  // ======== PETICION AJAX =========
  if (window.XMLHttpRequest) {
    conexion = new XMLHttpRequest();
  } else if (window.ActiveXObject) {
    conexion = new ActiveXObject("Microsoft.XMLHTTP");
  }

  // Preparando la función de respuesta
  conexion.onreadystatechange = asignarMantenimiento;

  // Realizando la petición HTTP con método POST
  conexion.open("POST", "../formularios/asignarMantenimiento.php");
  conexion.setRequestHeader(
    "Content-Type",
    "application/x-www-form-urlencoded"
  );
  conexion.send(
    "IDMantenimiento=" +
      IDMantenimiento +
      "&IDVehiculo=" +
      IDVehiculo +
      "&costo=" +
      costoMantenimiento +
      "&fechaInicio=" +
      fechaInicioMantenimiento.value +
      "&nocache=" +
      Math.random()
  );

  // ======== FIN PETICION AJAX =========
}

function asignarMantenimiento() {
  if (conexion.readyState == 4) {
    if (conexion.responseText === "Mantenimiento asignado correctamente") {
      Swal.fire({
        title: "Mantenimiento asignado!",
        text: `${conexion.responseText}`,
        icon: "success",
        confirmButtonText: "Aceptar",
        target: "#popupFormMantenimiento",
      }).then((result) => {
        if (result.isConfirmed) {
          loader("#popupFormMantenimiento");
          window.location.reload();
        }
      });
    } else {
      Swal.fire({
        title: "Error!",
        text: `${conexion.responseText}`,
        icon: "error",
        confirmButtonText: "Regresar",
        target: "#popupFormMantenimiento",
      }).then((result) => {
        if (result.isConfirmed) {
          loader("#popupFormMantenimiento");
          window.location.reload();
        }
      });
    }
  }
}

/* ELIMINAR ASIGNACION DE MANTENIMIENTO */

/* ================================================
DECLARACION DE VARIABLES DE INPUTS DEL FORMULARIO
DE ELIMINAR ASIGNACION DE MANTENIMIENTO
==================================================== */

let IDVehiculoMANTENIMIENTOForm = document.getElementById(
  "IDVehiculoMANTENIMIENTOForm"
);

let nombreEliminarMantenimiento = document.getElementById(
  "nombreEliminarMantenimiento"
);

let tipoEliminarMantenimiento = document.getElementById(
  "tipoEliminarMantenimiento"
);

let fechaInicioEliminarMantenimiento = document.getElementById(
  "fechaInicioEliminarMantenimiento"
);

let nuevoCosto = document.getElementById("nuevoCosto");

let fechaFinMantenimiento = document.getElementById("fechaFinMantenimiento");

let enviarFormularioFinMantenimiento = document.getElementById(
  "enviarFormularioFinMantenimiento"
);

let popupFormEliminarMantenimiento = document.getElementById(
  "popupFormEliminarMantenimiento"
);

/* ================================================
FIN DE DECLARACION DE VARIABLES DE FORMULARIO
==================================================== */

/* ================================================
INICIO FUNCION CERRAR POPUP ELIMINAR MANTENIMIENTO
==================================================== */

function cerrarPopupEliminarMantenimiento() {
  popupFormEliminarMantenimiento.close();
  formularioTerminarMantenimiento.reset();

  nuevoCosto.setAttribute("readonly", "");

  const contenedorInput = nuevoCosto.parentElement;
  const contenedorError = contenedorInput.querySelector(".error");

  contenedorError.innerText = "";
  contenedorInput.classList.remove("error");
}

/* ================================================
FIN FUNCION CERRAR POPUP ELIMINAR MANTENIMIENTO
==================================================== */

/* ================================================
INICIO FUNCION ABRIR POPUP ELIMINAR MANTENIMIENTO
INCLUYENDO LOS DATOS DEL MANTENIMIENTO CORRESPONDIENTE
==================================================== */

function abrirPopupEliminarMantenimiento(
  IDVehiculoMANTENIMIENTO,
  nombreMantenimiento,
  tipoMantenimiento,
  fechaInicio,
  costo
) {
  IDVehiculoMANTENIMIENTOForm.value = IDVehiculoMANTENIMIENTO;
  nombreEliminarMantenimiento.value = nombreMantenimiento;
  tipoEliminarMantenimiento.value = tipoMantenimiento;
  fechaInicioEliminarMantenimiento.value = fechaInicio;
  nuevoCosto.value = costo;
  costoOriginal = costo;
  popupFormEliminarMantenimiento.showModal();
  fechaFinMantenimiento.value = new Date().toISOString().split("T")[0];
}

/* ================================================
FIN FUNCION ABRIR POPUP ELIMINAR MANTENIMIENTO
==================================================== */

/* ================================================
INICIO FUNCIONALIDAD PARA ALTERNAR CHECKBOX 
PARA CAMBIAR EL COSTO
==================================================== */

let actualizarCosto = document.getElementById("actualizarCosto");

actualizarCosto.addEventListener("change", () => {
  if (actualizarCosto.checked) {
    nuevoCosto.removeAttribute("readonly");
  } else {
    nuevoCosto.setAttribute("readonly", "");
    nuevoCosto.value = costoOriginal;
  }
});

/* ================================================
FIN ALTERACION DE CHECKBOX PARA CAMBIAR EL COSTO
==================================================== */

/* ================================================
VALIDACION DE CAMPOS DEL FORMULARIO DE ELIMINAR
LLAMAR A LAS FUNCIONES AJAX CUANDO SE ENVIE EL FORMULARIO
==================================================== */

let formularioTerminarMantenimiento = document.getElementById(
  "formularioTerminarMantenimiento"
);

formularioTerminarMantenimiento.addEventListener("submit", (e) => {
  e.preventDefault();

  validarCamposTerminarMantenimiento();
});

function validarCamposTerminarMantenimiento() {
  let valorActualizarCosto = actualizarCosto.checked;
  let valorNuevoCosto = nuevoCosto.value;
  let camposValidos = true;

  if (valorActualizarCosto) {
    if (valorNuevoCosto == "") {
      mostrarError(nuevoCosto, "Ingrese el nuevo costo del mantenimiento");
      camposValidos = false;
    } else if (
      isNaN(valorNuevoCosto) ||
      valorNuevoCosto < 0 ||
      valorNuevoCosto > 3000
    ) {
      mostrarError(nuevoCosto, "El costo debe ser un número");
      camposValidos = false;
    } else {
      mostrarCampoValido(nuevoCosto);
    }
  }

  if (camposValidos) {
    peticionTerminarMantenimiento();
  }
}

/* ================================================
FIN VALIDACION DE CAMPOS DEL FORMULARIO DE ELIMINAR
==================================================== */

/*===============================================
INICIO FUNCIONES AJAX PARA TERMINAR MANTENIMIENTO
=================================================*/

function peticionTerminarMantenimiento() {
  // ======== PETICION AJAX =========
  if (window.XMLHttpRequest) {
    conexion = new XMLHttpRequest();
  } else if (window.ActiveXObject) {
    conexion = new ActiveXObject("Microsoft.XMLHTTP");
  }

  // Preparando la función de respuesta
  conexion.onreadystatechange = terminarMantenimiento;

  // Realizando la petición HTTP con método POST
  conexion.open("POST", "../formularios/terminarMantenimiento.php");
  conexion.setRequestHeader(
    "Content-Type",
    "application/x-www-form-urlencoded"
  );
  conexion.send(
    "IDVehiculoMANTENIMIENTO=" +
      IDVehiculoMANTENIMIENTOForm.value +
      "&costo=" +
      nuevoCosto.value +
      "&fechaFin=" +
      fechaFinMantenimiento.value +
      "&nocache=" +
      Math.random()
  );

  // ======== FIN PETICION AJAX =========
}

function terminarMantenimiento() {
  if (conexion.readyState == 4) {
    if (conexion.responseText === "Mantenimiento terminado con éxito") {
      // cerrarPopupEliminarMantenimiento();
      Swal.fire({
        title: "Mantenimiento terminado",
        text: `${conexion.responseText}`,
        icon: "success",
        confirmButtonText: "Aceptar",
        target: "#popupFormEliminarMantenimiento",
      }).then((result) => {
        if (result.isConfirmed) {
          loader("#popupFormEliminarMantenimiento");
          window.location.reload();
        }
      });
    } else {
      Swal.fire({
        title: "Error!",
        text: `${conexion.responseText}`,
        icon: "error",
        confirmButtonText: "Regresar",
        target: "#popupFormEliminarMantenimiento",
      }).then((result) => {
        if (result.isConfirmed) {
          loader("#popupFormEliminarMantenimiento");
          window.location.reload();
        }
      });
    }
  }
}

function loader(target) {
  Swal.fire({
    target: target,
    didOpen: () => {
      Swal.showLoading();
    },
  });
}
