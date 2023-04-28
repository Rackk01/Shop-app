'use strict';

// document.getElementById("id-form-newsletter").addEventListener('submit', validarFormulario);
const btnSubmitNewsletter = document.getElementById('idBtnNewsletter');

btnSubmitNewsletter.addEventListener("click", function (event) {
    // Aquí todo el código que se ejecuta cuando se da click al botón
    // alert("Le has dado click");
    validarFormulario(event);
});

const SendEmailSuscribeNewsletter = async (emailSuscribe) => {
    // let emailDestinatario = 'maxidepetris.hls@gmail.com';
    let formData = new FormData();
    formData.append('funcion', 'registerSuscribe');
    formData.append('emailSuscribe', emailSuscribe);
    try {
        const res = await fetch(URL_APP + 'php/middleware/suscribe.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.text();
        // console.log(data);

        if (data.trim() == 'e_s_1') {
            showAlertToast('success', 'WOOW! El <b>email</b> ya está registrado en nuestro newsletter!', '5000');
            document.getElementById('id-email-newsletter').focus();
            return;
        } else {
            showAlertToast('success', 'EXCELENTE! <b>Suscripción</b> exitosa!', '4000');
        }

    } catch (error) {
        console.log(error);
    }
}

function validarFormulario(event) {
    event.preventDefault();

    const email = document.getElementById('id-email-newsletter').value;
    if (email.trim().length == 0) {
        showAlertToast('error', 'CUIDADO! Debes ingresar tu <b>email</b>!', '4000'); // alert('No has escrito nada en el usuario');
        document.getElementById('id-email-newsletter').focus();
        return;
    }

    SendEmailSuscribeNewsletter(email.trim());
}