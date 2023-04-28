'use strict';
const formLogin = document.getElementById('id-form-login');

const email = document.getElementById('id-input-email');
const password = document.getElementById('id-input-password');

email.focus();

const loginUser = async (event) => {
    event.preventDefault();

    // showPopupLoading(type, title, tipoTransaccion, message, background, time)
    // showPopupLoading('info','Iniciando sesión...', '', 10000);
    showAlertToast('info', 'Iniciando sesión', 5000);
    //const datosFormLogin = new FormData(formLogin); // Contiene los datos del formulario

    if (email.value.trim() == '' || password.value.trim() == '') {
        showAlertToast('error', '¡CUIDADO! El email o la contraseña no son correctas, por favor revisa y vuelve a intentarlo...', '12000');
        return;
    }

    let formData = new FormData();
    formData.append('funcion', 'login');
    formData.append('email', email.value.trim());
    formData.append('password', password.value.trim());

    try {
        const res = await fetch(URL_APP + 'php/backend/' + 'cli-web.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.text();
        // console.log(data);
        // console.log(JSON.parse(data));
        // console.log(data['data']);

        // return;
        setTimeout(function () {
            if (data == 'ef_1' || data == 'ef_2' || data == 'es_1') {
                showAlertToast('error', '¡CUIDADO! El email o la contraseña no son correctas, por favor revisa y vuelve a intentarlo...', '12000');
                return;
            } else {
                showAlertToast('success', 'EXCELENTE! Iniciando sesión con tus datos. Actualizando!', '12000');
                setTimeout(function () {

                    let locationPrevLogin = 'index';

                    if (localStorage.getItem('locationPrevLogin') != null) {
                        locationPrevLogin = localStorage.getItem('locationPrevLogin');
                    } else if (data.trim() != null) {
                        // locationPrevLogin = data;
                    }
                    window.location.href = URL_APP + locationPrevLogin;
                }, 1500);

                return;
            }
        }, 200);
    } catch (error) {
        console.log(error);
    }
}

formLogin.addEventListener('submit', loginUser);