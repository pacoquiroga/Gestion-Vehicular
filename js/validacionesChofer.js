function validarCedulaEcuatoriana(cedula) {
    if (!/^\d{10}$/.test(cedula)) {
        return false;
    }

    // Obtener los primeros 9 dígitos de la cédula
    var cedulaSinDigitoVerificador = cedula.substring(0, 9);

    // Calcular el dígito verificador esperado
    var digitoVerificadorEsperado = calcularDigitoVerificador(cedulaSinDigitoVerificador);

    var digitoVerificadorIngresado = parseInt(cedula.substring(9, 10));

    // Comparar el dígito verificador ingresado con el esperado
    return digitoVerificadorEsperado === digitoVerificadorIngresado;
}

function calcularDigitoVerificador(cedulaSinDigitoVerificador) {
    var coeficientes = [2, 1, 2, 1, 2, 1, 2, 1, 2];

    var suma = 0;
    for (var i = 0; i < 9; i++) {
        var producto = parseInt(cedulaSinDigitoVerificador.charAt(i)) * coeficientes[i];
        suma += (producto >= 10) ? (producto - 9) : producto;
    }

    var residuo = suma % 10;

    return (residuo !== 0) ? (10 - residuo) : residuo;
}


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
                if (valor === '' || isNaN(valor) || valor.length !== 10) {
                    inputElement.classList.add('error');
                    botonEnviar.disabled = true;
                } else if (!validarCedulaEcuatoriana(valor)) {
                    inputElement.classList.add('error');
                    botonEnviar.disabled = true;
                } else {
                    inputElement.classList.remove('error');
                    botonEnviar.disabled = false;
                }
                break;


        case 'telefono':
            if (valor === '' || isNaN(valor) || valor.length !== 10 || valor.length > 10 || !/^09\d{8}$/.test(valor)) {
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
        case 'costo':
            if (!/^(\d+(\.\d{1,2})?)?$/.test(valor)) {
                inputElement.classList.add('error');
                botonEnviar.style.backgroundColor = 'gray';
                botonEnviar.style.cursor = 'not-allowed';
                botonEnviar.disabled = true;
            } else {
                inputElement.classList.remove('error');
                botonEnviar.style.backgroundColor = '#1b3665';
                botonEnviar.style.cursor = 'pointer';
                botonEnviar.disabled = false;
            }
            break;
        default:

            break;
    }
}
