'use strict';

// ################################################################################################
//#region DOM Elements
// const formLogin = document.getElementById('id-form-login');
const email = document.getElementById('id-input-email');
const password = document.getElementById('id-input-password');
const btnLogin = document.getElementById('id-btn-login');
//#endregion
// ################################################################################################

const loginUser = async (event) => {
    event.preventDefault();

    // showPopupLoading('Iniciando sesión...', '', 10000);
    //const datosFormLogin = new FormData(formLogin); // Contiene los datos del formulario

    if (email.value.trim() == '' || password.value.trim() == '') {
        showAlertToast('error', '¡CUIDADO! El email o la contraseña no son correctas, por favor revisa y vuelve a intentarlo...', '12000');
        return;
    }

    let formData = new FormData();
    formData.append('funcion', 'loginAdmin');
    formData.append('email', email.value.trim());
    formData.append('password', password.value.trim());

    try {
        const res = await fetch(URL_APP + 'php/backend/' + 'cli-web.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.text();
        console.log(data);
        // console.log(JSON.parse(data));
        // console.log(data['data']);
        // return;

        // setTimeout(function () {
            if (data == 'es_1') {
                showAlertToast('error', '¡CUIDADO! El email o la contraseña no son correctas, por favor revisa y vuelve a intentarlo...', '12000');
                return;
            } else {
                showAlertToast('success', 'EXCELENTE! Iniciando sesión con tus datos. Actualizando!', '12000');
                // setTimeout(function () {
                    window.location.href = URL_APP + 'admin/index';
                // }, 1000);
                return;
            }
        // }, 3000);
    } catch (error) {
        console.log(error);
    }
}

function click() {
    console.log('CLICK');
}
// formLogin.addEventListener('submit', loginUser);
btnLogin.addEventListener('click', loginUser);

window.addEventListener('DOMContentLoaded', (event) => {
    email.focus();
});