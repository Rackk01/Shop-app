'use strict';

// ============================================================================================================
// VARIABLES

// ============================================================================================================
// FUNCIONES
const getSDError = async () => {
    //
    let formData = new FormData();
    formData.append('funcion', 'getSDError');

    try {
        const res = await fetch(URL_APP + 'php/services/' + 'session.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.json();
        // console.log(data['branche']);
        // spanSucursal.innerText = 'Suc. ' + data['branche'];
        // if(data == 's1'){
        //     showAlertToast('success','¡EXCELENTE! Se guardó tu sucursal <b>'+branche+'</b>!','4000');
        //     document.getElementById('id-span-sucursal').innerText = branche;
        // }
    } catch (error) {
        console.log(error);
    }
}