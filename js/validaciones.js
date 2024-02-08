function validarCampo(campo) {
    var inputElement = document.getElementById(campo);
    var valor = inputElement.value.trim();
    var botonEnviar = document.getElementById('botonEnviar'); // Obtener referencia al botón de enviar
    botonEnviar.disabled = true;
    switch (campo) {
        case 'edad':
            if (valor === '' || isNaN(valor) || parseInt(valor) < 18 || parseInt(valor) > 60) {
                inputElement.classList.add('error');
                botonEnviar.disabled = true; // Bloquear botón
            } else {
                inputElement.classList.remove('error');
                botonEnviar.disabled = false; // Habilitar botón
            }
            break;

        case 'numCedula':
            if (valor === '' || isNaN(valor) || valor.length !== 10) {
                inputElement.classList.add('error');
                botonEnviar.disabled = true; // Bloquear botón
            } else {
                inputElement.classList.remove('error');
                botonEnviar.disabled = false; // Habilitar botón
            }
            break;
        
        case 'nombre':
            if (!/^[a-zA-Z]+$/.test(valor)) {
                inputElement.classList.add('error');
                botonEnviar.disabled = true; // Bloquear botón
            } else {
                inputElement.classList.remove('error');
                botonEnviar.disabled = false; // Habilitar botón
            }
            break;

        default:
            // Manejar un caso por defecto si es necesario
            break;
    }
}
