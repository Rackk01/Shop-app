'use strict';

// ============================================================================================================
// VARIABLES
const spanSucursal = document.getElementById('id-span-sucursal');


// ============================================================================================================
// FUNCIONES
const setSDBrancheOfficeSelected = async (id, branche) => {
    // Función que setea la sucursal seleccionada.
    let formData = new FormData();
    formData.append('funcion', 'setSDBrancheOfficeSelected');
    formData.append('id', id);
    formData.append('branche', branche); // branche);

    try {
        const res = await fetch(URL_APP + 'php/services/' + 'session.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.text();
        // console.log(data);
        if (data == 's1') {
            showAlertToast('success', '¡EXCELENTE! Se guardó tu sucursal <b>' + branche + '</b>!', '4000');
            spanSucursal.innerText = 'Suc. ' + branche;
        }
    } catch (error) {
        console.log(error);
    }
}

const setInitialSDBrancheOfficeSelected = async () => {
    // Corrobora si el usuario ya había seleccionado a que sucursal correspondía y en caso de existir una suc. seleccionada sete el texto de la vista
    let formData = new FormData();
    formData.append('funcion', 'getInitialSDBrancheOfficeSelected');

    try {
        const res = await fetch(URL_APP + 'php/services/' + 'session.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.json();
        // console.log(data);
        // console.log(data['branche']);
        if (data['id'] != 0) {
            spanSucursal.innerText = 'Suc. ' + data['branche'];
        }
        //     showAlertToast('success','¡EXCELENTE! Se guardó tu sucursal <b>'+branche+'</b>!','4000');
    } catch (error) {
        console.log(error);
    }
}

// ============================================================================================================
// LLAMADAS A FUNCIONES
setInitialSDBrancheOfficeSelected();

// ============================================================================================================