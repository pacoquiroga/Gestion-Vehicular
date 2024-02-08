const enProcesoV = document.getElementById('enProcesoViaje');
const historialV = document.getElementById('historialViaje');
const enProcesoContentV = document.getElementById('enProceso-contentV');
const historialContentV = document.getElementById('historial-contentV');

let choseViaje = 2;

const changeOptionV = () => {
    choseViaje == 1 ? (
        enProcesoContentV.classList.value = 'contentV content-activeV',
        enProcesoV.classList.value = 'optionV option-activeV',
        historialV.classList.value = 'optionV',
        historialContentV.classList.value = 'contentV'
    )
    : (
        console.log(choseViaje)
    )

    choseViaje == 2 ? (
        enProcesoV.classList.value = 'optionV',
        enProcesoContentV.classList.value = 'contentV',
        historialV.classList.value = 'optionV option-activeV',
        historialContentV.classList.value = 'contentV content-activeV'
        
        
    )
    : (
        console.log(choseViaje)
    )
}

enProcesoViaje.addEventListener('click', () => {
    choseViaje = 1;
    changeOptionV();
});

historialViaje.addEventListener('click', () => {
    choseViaje = 2;
    console.log("epaaa");
    changeOptionV();
});