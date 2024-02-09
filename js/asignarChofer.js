const infoPopup = document.getElementById("infoPopup");
let IDVehiculo = document.getElementById("IDVehiculoAsignar").value;
const infoPopupEliminar = document.getElementById("infoPopupEliminar");

function abrirPopup() {
  document.getElementById("popupAsignarChofer").showModal();
}

function abrirPopupEliminar() {
  document.getElementById("popupEliminarAsignacion").showModal();
}

function cerrarPopup() {
  window.location.reload();
}

function crearContenidoPopup(chofer) {
  infoPopup.innerHTML = `
        <section class="infoChoferPopup">
          <article>
              <h1>Información del Chofer</h1>
              <p><strong class="titulo">Nombre: </strong>
                  ${chofer.nombreChofer}
              </p>
              <p><strong class="titulo">Apellido: </strong>
                  ${chofer.apellidoChofer}
              </p>
              <p><strong class="titulo">Numero de Cedula: </strong>
                  ${chofer.CI}
              </p>
          </article>
          <article style=" text-align:center; ">
              <h1>Foto del Chofer</h1>
              <img src="data:image/jpeg;base64,${chofer.foto}" class="fotoChofer" alt="foto-chofer">
              <a href="../chofer/chofer.php?busqueda=${chofer.CI}">Ver más información del chofer</a>
          </article>
        </section>
        <section class="botones">
          <button id="btnAsignar" onclick="asignarBitacora(${chofer.IDChofer})">Asignar</button>
          <button id="btnCancelar" onclick="Cancelar()">Cancelar</button>
        </section>
    `;
}

function AsignarChofer() {
  let numCedula = document.querySelector(".cedulaBuscada").value;
  // ======== PETICION AJAX =========
  if (window.XMLHttpRequest) {
    conexion = new XMLHttpRequest();
  } else if (window.ActiveXObject) {
    conexion = new ActiveXObject("Microsoft.XMLHTTP");
  }

  // Preparando la función de respuesta
  conexion.onreadystatechange = buscarChofer;

  // Realizando la petición HTTP con método POST
  conexion.open("POST", "../formularios/buscarChofer.php");
  conexion.setRequestHeader(
    "Content-Type",
    "application/x-www-form-urlencoded"
  );
  conexion.send("numCedula=" + numCedula + "&nocache=" + Math.random());

  // ======== FIN PETICION AJAX =========
}

function buscarChofer() {
  if (conexion.readyState == 4) {
    if (conexion.responseText === "No se encontró el chofer") {
      infoPopup.innerHTML = `
        <p class="mensajePopup" >${conexion.responseText}</p>
        <button id="btnAsignar" onclick="Cancelar()">Aceptar</button>
      `;
      return;
    }
    var chofer = JSON.parse(conexion.responseText);
    crearContenidoPopup(chofer);
  }
}

function Cancelar() {
  const infoPopup = document.getElementById("infoPopup");
  infoPopup.innerHTML = `
    <section id="infoPopup">
        <h1>Asignar Chofer</h1>
        <label>
            <font color="white">Buscar:</font>
        </label>
        <section class="buscarCedula">
            <input type="number" class="cedulaBuscada" placeholder="Ingresa Cedula" name="busqueda">
            <button id="btnBuscarChofer" onclick="AsignarChofer()"></button>
        </section>
    </section>
  `;
}

function asignarBitacora(IDChofer) {
  if (window.XMLHttpRequest) {
    conexion = new XMLHttpRequest();
  } else if (window.ActiveXObject) {
    conexion = new ActiveXObject("Microsoft.XMLHTTP");
  }

  let fecha = new Date().toISOString().split("T")[0];

  conexion.onreadystatechange = peticionBitacora;
  conexion.open("POST", "../formularios/insertarBitacora.php");
  conexion.setRequestHeader(
    "Content-Type",
    "application/x-www-form-urlencoded"
  );
  conexion.send(
    "IDChofer=" +
      IDChofer +
      "&IDVehiculo=" +
      IDVehiculo +
      "&fecha=" +
      fecha +
      "&nocache=" +
      Math.random()
  );
}

function peticionBitacora() {
  if (conexion.readyState == 4) {
    let infoPopup = document.getElementById("infoPopup");
    if (
      conexion.responseText ===
      "Ya existe un registro de bitacora para este chofer y vehiculo, no se puede asignar nuevamente."
    ) {
      infoPopup.innerHTML = `
      <p>${conexion.responseText}</p>
      <button id="btnCancelar" onclick="Cancelar()">Regresar</button>
      `;
      return;
    }
    infoPopup.innerHTML = `
      <p>${conexion.responseText}</p>
      <button id="btnAsignar" onclick="cerrarPopup()">Cerrar</button>
      `;
  }
}

function confirmarEliminacion() {
  const observacion = document.getElementById("observacion").value;
  infoPopupEliminar.innerHTML = `
    <h1>Eliminar Asignación</h1>
    <p>¿Estás seguro que deseas eliminar la asignación?</p>
    <input type="hidden" id="observacionBitacora" value="${observacion}">
    <button id="btnAsignar" onclick="eliminarAsignacion()">Si</button>
    <button id="btnCancelar" onclick="cerrarPopup()">No</button>
  `;
}

function eliminarAsignacion() {
  if (window.XMLHttpRequest) {
    conexion = new XMLHttpRequest();
  } else if (window.ActiveXObject) {
    conexion = new ActiveXObject("Microsoft.XMLHTTP");
  }

  let fechaFinalizacion = new Date().toISOString().split("T")[0];
  let observacion = document.getElementById("observacionBitacora").value;
  console.log(fechaFinalizacion);
  console.log(IDVehiculo);
  console.log(observacion);

  conexion.onreadystatechange = peticionEliminarAsignacion;
  conexion.open("POST", "../formularios/eliminarAsignacion.php");
  conexion.setRequestHeader(
    "Content-Type",
    "application/x-www-form-urlencoded"
  );
  conexion.send(
    "IDVehiculo=" +
      IDVehiculo +
      "&observacion=" +
      observacion +
      "&fechaFinalizacion=" +
      fechaFinalizacion +
      "&nocache=" +
      Math.random()
  );
}

function peticionEliminarAsignacion() {
  if (conexion.readyState == 4) {
    infoPopupEliminar.innerHTML = `
      <p>${conexion.responseText}</p>
      <button id="btnAsignar" onclick="abrirPopup()">Aceptar</button>
      `;
  }
}
