'use strict';

const formularioRegisterUser = document.getElementById("id-form-register-user");
const datosFormRegisterUser = new FormData(formularioRegisterUser); // Contiene los datos del formulario

formularioRegisterUser.addEventListener("submit", (e) => {
    e.preventDefault();

    // console.log(document.getElementById('id-in-name').value);
    // console.log(datosFormRegisterUser.get("username"));
    // console.log(datosFormRegisterUser.get("email"));

    // showAlertToast('success', 'WOOW! El <b>email</b> ya está registrado en nuestro newsletter!', '5000');

    const nombre = (document.getElementById('id-in-name').value).trim();
    const email = (document.getElementById('id-in-email').value).trim();
    const dnicuit = (document.getElementById('id-in-dnicuit').value).trim();
    const tel = (document.getElementById('id-in-tel').value).trim();
    const pass = (document.getElementById('id-in-pass').value).trim();
    const retypepass = (document.getElementById('id-in-retypepass').value).trim();

    registerClient(nombre, email, dnicuit, tel, pass, retypepass);
});

const registerClient = async (nombre, email, dnicuit, tel, pass, retypepass) => {

    let formData = new FormData();
    formData.append('funcion', 'registerClient');
    formData.append('nombre', nombre);
    formData.append('email', email);
    formData.append('dnicuit', dnicuit);
    formData.append('tel', tel);
    formData.append('pass', pass);
    formData.append('retypepass', retypepass);

    try {
        const res = await fetch(URL_APP + 'php/backend/' + 'cli-web.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.text();
        console.log(data);
        // console.log(typeof (data['cantidadProdutos']));

        if (data == 'ef_1') {
            showAlertToast('error', 'ERROR! Revisa todos los <b>datos</b>.. Falta alguno!', '5000');
            return;
        } else if (data == 'ef_2') {
            showAlertToast('error', 'ERROR! Las <b>passwords</b> (contraseñas) no coinciden. Revise y vuelve a intentar!', '9000');
            document.getElementById('id-in-pass').focus();
            return;
        } else if (data == 'ef_3') {
            showAlertToast('error', 'ERROR! Número de DNI/CUIT inválido. Debe contener formato correcto sólo con números. Revise y vuelve a intentar!', '12000');
            document.getElementById('id-in-dnicuit').focus();
            return;
        } else if (data == 'se1' || data == 'se2') {
            showAlertToast('error', '¡CUIDADO! Ya existe una cuenta con ese email, dni o cuit registrada. Verifica los datos y vuelve a intentar...', '12000');
            return;
        } else {
            showAlertToast('success', 'EXCELENTE! Cuenta creada con éxito! Bienvenido/a ' + nombre + '. Actualizando!', '12000');
            setTimeout(function () {

                let locationPrevLogin = 'index';

                if (localStorage.getItem("locationPrevLogin") != null) locationPrevLogin = localStorage.getItem("locationPrevLogin");

                window.location.href = URL_APP + locationPrevLogin;
            }, 1500);

            return;
        }

    } catch (error) {
        console.log(error);
    }
}