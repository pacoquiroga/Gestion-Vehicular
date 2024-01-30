const enProceso = document.getElementById('enProceso');
const historial = document.getElementById('historial');
const enProcesoContent = document.getElementById('enProceso-content');
const historialContent = document.getElementById('historial-content');

let chose = 1;

const changeOption = () => {
    chose ==1 ? (
        enProcesoContent.classList.value = 'content content-active',
        enProceso.classList.value = 'option option-active',
        historial.classList.value = 'option',
        historialContent.classList.value = 'content'
    )
    : (
        console.log(chose)
    )

    chose == 2 ? (
        enProceso.classList.value = 'option',
        enProcesoContent.classList.value = 'content',
        historial.classList.value = 'option option-active',
        historialContent.classList.value = 'content content-active'
        
        
    )
    : (
        console.log(chose)
    )
}

enProceso.addEventListener('click', () => {
    chose = 1;
    changeOption();
});

historial.addEventListener('click', () => {
    chose = 2;
    changeOption();
});