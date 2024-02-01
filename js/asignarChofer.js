function abrirPopup() {
  document.getElementById("popupAsignarChofer").showModal();
}

function cerrarPopup() {
  document.getElementById("popupAsignarChofer").close();
}

function crearContenidoPopup(chofer) {
  return `
        <section class="infoChoferPopup">
          <article>
              <h1>Información del Chofer</h1>
              <p><strong class="titulo">Nombre: </strong>
                  ${chofer.nombre}
              </p>
              <p><strong class="titulo">Apellido: </strong>
                  ${chofer.apellido}
              </p>
              <p><strong class="titulo">Numero de Cedula: </strong>
                  ${chofer.cedula}
              </p>
          </article>
          <article style=" text-align:center; ">
              <h1>Foto del Chofer</h1>
              <img src="img/${chofer.foto}" width="35%" alt="foto-chofer">
              <a href="chofer.php?busqueda=${chofer.cedula}">Ver más información del chofer</a>
          </article>
        </section>
        <section class="botones">
          <button id="btnAsignar" onclick="Asignar('${chofer.cedula}', '${chofer.nombre}', '${chofer.apellido}')">Asignar</button>
          <button id="btnCancelar" onclick="Cancelar()">Cancelar</button>
        </section>
    `;
}

function AsignarChofer() {
  const infoPopup = document.getElementById("infoPopup");

  let cedulaChofer = document.querySelector(".cedulaBuscada").value;
  let encontrado = false;
  fetch("datos/choferes.json")
    .then((repuesta) => repuesta.json())
    .then((choferes) => {
      choferes.forEach((chofer) => {
        if (cedulaChofer == chofer.cedula) {
          encontrado = true;
          infoPopup.innerHTML = crearContenidoPopup(chofer);
        }
      });
    });
  if (!encontrado) {
    infoPopup.innerHTML += `
      <h1>NO SE ENCONTRÓ AL CHOFER</h1>
    `;
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

function Asignar(cedulaChofer, nombreChofer, apellidoChofer) {
  cerrarPopup();
  const contenedorChofer = document.getElementById("contenedorChofer");
  contenedorChofer.innerHTML = `
      <p>Chofer Asignado:</p>
      <a href="http://localhost/Gestion-Local/chofer.php?busqueda=${cedulaChofer}">
      ${nombreChofer} ${apellidoChofer}
      </a>
    `;
}
