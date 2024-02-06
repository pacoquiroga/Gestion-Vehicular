function validarCampo(campo) {
    var inputElement = document.getElementById(campo);
    var valor = inputElement.value.trim();

    if (campo === 'edad') {
        if (valor === '' || isNaN(valor) || parseInt(valor) < 18 || parseInt(valor) > 60) {
            inputElement.classList.add('error');
        } else {
            inputElement.classList.remove('error');
        }
    } else if (campo === 'numCedula') {
        if (valor === '' || isNaN(valor) || valor.length !== 10) {
            inputElement.classList.add('error');
        } else {
            inputElement.classList.remove('error');
        }
    } else if (campo === 'fecha_entrada') {
        if (valor === '' || valor < '2000-01-01') {
            inputElement.classList.add('error');
        } else {
            inputElement.classList.remove('error');
        }
    } else {
        if (!/^[a-zA-Z]+$/.test(valor)) {
            inputElement.classList.add('error');
        } else {
            inputElement.classList.remove('error');
        }
    }
}
