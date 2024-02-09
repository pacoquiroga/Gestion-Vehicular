function validarCampo(campo) {
    var inputElement = document.getElementById(campo);
    var valor = inputElement.value.trim();
    var botonEnviar = document.getElementById('botonEnviar');

    switch (campo) {
        case 'edad':
            if (valor === '' || isNaN(valor) || parseInt(valor) < 18 || parseInt(valor) > 60) {
                inputElement.classList.add('error');
                botonEnviar.disabled = true;
            } else {
                inputElement.classList.remove('error');
                botonEnviar.disabled = false; 
            }
            break;

        case 'numCedula':
            if (valor === '' || isNaN(valor) || valor.length !== 10 || valor.length > 10) {
                inputElement.classList.add('error');
                botonEnviar.disabled = true; 
            } else {
                inputElement.classList.remove('error');
                botonEnviar.disabled = false; 
            }
            break;


        case 'telefono':
            if (valor === '' || isNaN(valor) || valor.length !== 10 || valor.length > 10) {
                inputElement.classList.add('error');
                botonEnviar.disabled = true; 
            } else {
                inputElement.classList.remove('error');
                botonEnviar.disabled = false; 
            }
            break;



        case 'nombre':
            if (!/^[a-zA-Z]+$/.test(valor)) {
                inputElement.classList.add('error');
                botonEnviar.disabled = true; 
            } else {
                inputElement.classList.remove('error');
                botonEnviar.disabled = false; 
            }
            break;
        case 'apellido':
            if (!/^[a-zA-Z]+$/.test(valor)) {
                inputElement.classList.add('error');
                botonEnviar.disabled = true; 
            } else {
                inputElement.classList.remove('error');
                botonEnviar.disabled = false; 
            }
            break;
        case 'correo':
            if (!/^[a-zA-Z0-9._-]+@[a-zA-Z]+\.(com|net|ec)$/.test(valor)) {
                inputElement.classList.add('error');
                botonEnviar.disabled = true; 
            } else {
                inputElement.classList.remove('error');
                botonEnviar.disabled = false; 
            }
            break;


        default:

            break;
    }
}
