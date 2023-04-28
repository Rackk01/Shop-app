'use strict';

const greeting = document.getElementById('id-greeting-data-account');
// const domicilio = document.getElementById('id-domi');
// const localidad = document.getElementById('id-locali');
// const codPost = document.getElementById('id-cpost');
// const provin = document.getElementById('id-prov');

const inputNombre = document.getElementById('idInputNombre'),
    inputEmail = document.getElementById('idInputEmail'),
    inputCurrentPassword = document.getElementById('idInputPasswordActual'),
    inputNewPassword = document.getElementById('idInputPasswordNueva'),
    inputConfirmNewPassword = document.getElementById('idInputConfirmarPassword'),
    formDatosCuenta = document.getElementById('formDatosCuenta');

let tabla = $('#tabla-pedidos').DataTable({
    language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }
    },
    // "searching": false,
    // paging: false,
    // info: false,
    "responsive": true,
    "lengthChange": false,
    "autoWidth": false,
    // columns: [
    //     { data: 'lista' },
    //     { data: 'precio' },
    //     {
    //         "defaultContent":
    //             `<div class="d-flex justify-content-around">
    //             <button type="button" class="btn btn-success" id="idBtnModificarLista"><i class="fa-solid fa-pen"></i></button>
    //             <button type="button" class="btn btn-danger" id="idBtnBorrarLista"><i class="fa-solid fa-trash"></i></button>
    //         </div>`
    //     }
    // ],
    tabIndex: -1 //?    Permite que el `tab` no pase por todas las columnas de una tabla
});

const setInitialGreeting = async () => {
    console.log('setInitialGreeting');
    let formData = new FormData();
    formData.append('funcion', 'getEmailLoggedClient');

    try {
        const res = await fetch(URL_APP + 'php/services/' + 'session.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.text();
        // console.log(typeof (data));
        // console.log((data));

        if (data.trim() != '' && data.trim() != 0) {
            if (greeting) {
                greeting.innerHTML = 'Hola ' + (data.split('@')[0]).toUpperCase() + '!';
            }
        }

    } catch (error) {
        console.log(error);
    }
}
setInitialGreeting();

const getDomicilio = async () => {
    let formData = new FormData();
    formData.append('funcion', 'getDomicilio');

    try {
        const res = await fetch(URL_APP + 'php/services/' + 'session.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.text();
        // console.log(typeof (data));
        // console.log((data));

        if (data.trim() != '' && data.trim() != 0) {
            // if (document.getElementById('id-domi')) {
            console.log((data));
            document.getElementById('id-input-domi').value = data.toUpperCase();
            // }
        }

    } catch (error) {
        console.log(error);
    }
}
const getLocalidad = async () => {
    let formData = new FormData();
    formData.append('funcion', 'getLocalidad');

    try {
        const res = await fetch(URL_APP + 'php/services/' + 'session.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.text();
        // console.log(typeof (data));
        console.log((data));

        if (data.trim() != '' && data.trim() != 0) {
            // if (document.getElementById('id-locali')) {
            document.getElementById('id-input-locali').value = data.toUpperCase();
            // }
        }

    } catch (error) {
        console.log(error);
    }
}
const getCodPost = async () => {
    let formData = new FormData();
    formData.append('funcion', 'getCodPost');

    try {
        const res = await fetch(URL_APP + 'php/services/' + 'session.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.text();
        // console.log(typeof (data));
        console.log((data));

        if (data.trim() != '' && data.trim() != 0) {
            // if (document.getElementById('id-cpost')) {
            document.getElementById('id-input-cpost').value = data.toUpperCase();
            // }
        }

    } catch (error) {
        console.log(error);
    }
}
const getProvincia = async () => {
    let formData = new FormData();
    formData.append('funcion', 'getProvincia');

    try {
        const res = await fetch(URL_APP + 'php/services/' + 'session.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.text();
        // console.log(typeof (data));
        console.log((data));

        if (data.trim() != '' && data.trim() != 0) {
            // if (document.getElementById('id-prov')) {
            document.getElementById('id-input-prov').value = data.toUpperCase();
            // }
        }

    } catch (error) {
        console.log(error);
    }
}

function setDataDomicilio() {
    console.log('MI DOMICILIO');
    // setTimeout(function () {
    getDomicilio();
    getLocalidad();
    getCodPost();
    getProvincia();
    // }, 500);
}

const formDomicilio = document.getElementById('id-form-domicilio');

const updateDomicilio = async (event) => {
    event.preventDefault();

    showPopupLoading('Actualizando domicilio...', '', 10000);
    //const datosFormLogin = new FormData(formLogin); // Contiene los datos del formulario

    const domicilio = document.getElementById('id-input-domi');
    const localidad = document.getElementById('id-input-locali');
    const codPost = document.getElementById('id-input-cpost');
    const provin = document.getElementById('id-input-prov');

    if (domicilio.value.trim() == '' || localidad.value.trim() == '' || codPost.value.trim() == '' || provin.value.trim() == '') {
        showAlertToast('error', '¡CUIDADO! Faltan datos, por favor revisa y vuelve a intentarlo...', '12000');
        return;
    }

    let formData = new FormData();
    formData.append('funcion', 'updateDomicilio');
    formData.append('domicilio', domicilio.value.trim());
    formData.append('localidad', localidad.value.trim());
    formData.append('codPost', codPost.value.trim());
    formData.append('provin', provin.value.trim());

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
            if (data == 'ef_1' || data == 'ef_2' || data == 'es_1') {
                showAlertToast('error', '¡CUIDADO! Faltan datos para actualizar, por favor revisa y vuelve a intentarlo...', '12000');
                return;
            } else {
                showAlertToast('success', 'EXCELENTE! Datos actualizados correctamente!', '12000');
                return;
            }
        }, 200);
    } catch (error) {
        console.log(error);
    }
}
formDomicilio.addEventListener('submit', updateDomicilio);

const setDatosCuenta = async () => {
    let formData = new FormData();
    formData.append('funcion', 'getDatosClienteWeb');

    try {
        const res = await fetch(URL_APP + 'php/services/' + 'session.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.json();
        // console.log(typeof (data));
        // console.log(data);

        if (data != '' && data != 0) {
            inputNombre.value = data.nombre.trim();
            inputEmail.value = data.email.trim();
        }

    } catch (error) {
        console.log(error);
    }
}

formDatosCuenta.addEventListener('submit', async e => {
    e.preventDefault();

    if (inputNombre.value.trim() == '' || inputEmail.value.trim() == '') {
        showModal('error', '¡CUIDADO!', 'Faltan datos para actualizar, por favor revise y vuelve a intentarlo...');
    }

    let formData = new FormData();
    formData.append('funcion', 'updateDatosCuenta');
    formData.append('nombre', inputNombre.value.trim());
    formData.append('email', inputEmail.value.trim());
    formData.append('currentPassword', inputCurrentPassword.value.trim());
    formData.append('newPassword', inputNewPassword.value.trim());
    formData.append('confirmPassword', inputConfirmNewPassword.value.trim());

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
        if (data == 'ef_1'  || data == 'es_1') {
            showModal('error', '¡CUIDADO!', ' Faltan datos para actualizar, por favor revisa y vuelve a intentarlo...');
            return;
        } else if (data == 'ef_2'){
            showModal('error', '¡CUIDADO!', 'La confirmación de la contraseña no coincide, por favor revisa y vuelve a intentarlo...');
            return;
        } else if (data == 'es_2' || data == 'es_3') {
            showModal('error', '¡CUIDADO!', 'Hubo un error al actualizar los datos, por favor revisa y vuelve a intentarlo...');
            return;
        } else {
            showModal('success', 'EXCELENTE!', 'Datos actualizados correctamente!');
            return;
        }
    } catch (error) {
        console.log(error);
    }

})