'use strict';

const closeSessionAdmin = async () => {
    let formData = new FormData();
    formData.append('funcion', 'closeSessionAdmin');

    try {
        const res = await fetch(URL_APP + 'php/services/' + 'session.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.text();
        // console.log(typeof (data));
        // console.log((data));

        // showAlertToast('success', '¡ESPERAMOS VERTE DE REGRESO PRONTO!', '5000');
        setTimeout(function () {
            window.location.href = URL_APP + 'admin/login';
        }, 1000);

        return;

    } catch (error) {
        console.log(error);
    }
}