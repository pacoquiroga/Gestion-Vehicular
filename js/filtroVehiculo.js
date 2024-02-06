document.addEventListener("DOMContentLoaded", function () {
    const inputBusqueda = document.getElementById('busquedaVehiculos');
    const filtroSelect = document.getElementById('filtroVehiculos');
    const vehiculos = document.querySelectorAll('.vehiculo');

    // Función para aplicar el filtro de búsqueda
    function aplicarFiltroBusqueda() {
        const filtro = inputBusqueda.value.toLowerCase();

        // Itera sobre todos los vehículos
        vehiculos.forEach(function (vehiculo) {
            const placa = vehiculo.querySelector('h1').textContent.toLowerCase();
            const categoriaVehiculo = vehiculo.querySelector('.estado').classList[1].toLowerCase();

            // Verifica si coincide con el filtro de búsqueda y la categoría seleccionada
            const coincideConFiltro = placa.includes(filtro);
            const coincideConCategoria = (categoriaVehiculo === filtroSelect.value.toLowerCase() || filtroSelect.value.toLowerCase() === 'todos');

            if (coincideConCategoria && (coincideConFiltro || filtro === '')) {
                vehiculo.style.display = 'flex';
            } else {
                vehiculo.style.display = 'none'; // Ocultar vehiculo
            }
        });
    }

    // Agrega un evento de entrada al campo de búsqueda
    inputBusqueda.addEventListener('input', aplicarFiltroBusqueda);

    // Agregar evento de cambio al select
    filtroSelect.addEventListener('change', function () {
        // Aplicar el filtro de búsqueda después de cambiar la categoría
        aplicarFiltroBusqueda();
    });

});