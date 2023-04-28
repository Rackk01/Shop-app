'use strict';
const formRecover = document.getElementById('id-form-recover');
const email = document.getElementById('id-input-email');
email.focus();
const recoverPassword = async (event) => {
    event.preventDefault();

    // showPopupLoading('Iniciando sesión...', '', 10000);
    showPopupLoading('info',
        '¡Verificando!',
        '',
        'Estamos corroborando su solicitud, espere unos segundos...',
        '');

    // return;

    if (email.value.trim() == '') {
        // showAlertToast('error', '¡CUIDADO! El email o la contraseña no son correctas, por favor revisa y vuelve a intentarlo...', '12000');
        showModal('error', 'CUIDADO!',
            'Debe ingresar un correo electrónico para continuar. Revise y vuelva a intentar...');
        email.focus();
        return;
    }

    let formData = new FormData();
    formData.append('funcion', 'recoverPaswword');
    formData.append('email', email.value.trim());

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
        setTimeout(function () {
            if (data == 'se_1') {
                setTimeout(function () {
                    showModal('error', 'CUIDADO!',
                        'El correo electrónico ingresado no se encuentra registrado. Puedes crear una nueva cuenta con tu correo electrónico: ' + email.value.trim() + '.');
                    email.focus();
                }, 2000);
                return;
            } else {
                // showAlertToast('success', 'EXCELENTE! Iniciando sesión con tus datos. Actualizando!', '12000');
                showModal('success', 'Excelente!',
                    'Enviando email <strong>email</strong> a tu cuenta de correo: <strong style="font-size: 20px;">' + email.value.trim() + '</strong> <br><br> Revisa tu bandeja de entrada y/o tu lista de spam. <br>Te redireccionaremos para que puedas iniciar sesión en unos segundos.');

                // Envío de email
                sendEmailRecoverPass(email.value.trim());
                // return;
                return;
            }
        }, 800);
    } catch (error) {
        console.log(error);
    }
}

const sendEmailRecoverPass = async (email) => {
    // Envío de email
    let formData = new FormData();
    formData.append('funcion', 'sendEmailRecoverPass');
    formData.append('email', email);
    try {
        const res = await fetch(URL_APP + 'php/modules/mail/mailer.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.text();
        console.log(data);

        if (data.trim() == 'fs_1') {
            showAlertToast('success', 'EMAIL ENVIADO! Revisa tu email <b>email</b>! Redireccionando...', '6000');

            setTimeout(function () {
                let locationPrevLogin = 'login';
                // if (localStorage.getItem('locationPrevLogin') != null) {
                //     locationPrevLogin = localStorage.getItem('locationPrevLogin');
                // } else if (data.trim() != null) {
                //     // locationPrevLogin = data;
                // }
                window.location.href = URL_APP + locationPrevLogin;
            }, 3000);

        } else {
            showAlertToast('error', 'ERROR al intentar enviar el correo, revise el email y vuelva a intentar.!<b></b>!', '4000');
        }

    } catch (error) {
        console.log(error);
    }
}

formRecover.addEventListener('submit', recoverPassword);