'use strict';

let domicilioDelCliente = '';

let forenvDefecto = 'domicilio';

function changeForenvSelected() {
    // 1 -- Envío a domicilio || 2 -- Retiro en sucursal
    let valueForenv = document.getElementById('id-select-forenv').value.trim();
    // console.log(valueForenv);

    let descriForenv = document.getElementById('id-select-forenv').options[document.getElementById('id-select-forenv').selectedIndex].text;
    // console.log(descriForenv);

    if (descriForenv.includes('domicilio') || descriForenv.includes('Domicilio')) {
        forenvDefecto = 'domicilio';
        document.getElementById('id-p-date-forenv').style.display = '';
    } else {
        forenvDefecto = 'retiro';
        document.getElementById('id-p-date-forenv').style.display = 'none';
    }

    // getDataTotalesCheckout(forenvDefecto, descriForenv);
    // getDataTotalesCheckout(valueForenv, descriForenv);


    // 1 -- Efectivo || 2 -- Transfer || 3/4/5 -- MP
    let valueForpag = document.getElementById('id-select-forpag').value.trim();
    // console.log(valueForpag);

    let descriForpag = document.getElementById('id-select-forpag').options[document.getElementById('id-select-forpag').selectedIndex].text;
    // console.log(descriForpag);

    getRecargoForpag(valueForpag, descriForpag);
}

function changeForpagSelected() {
    // 1 -- Efectivo || 2 -- Transfer || 3/4/5 -- MP
    let valueForpag = document.getElementById('id-select-forpag').value.trim();
    console.log(valueForpag);

    let descriForpag = document.getElementById('id-select-forpag').options[document.getElementById('id-select-forpag').selectedIndex].text;
    // console.log(descriForpag);

    getRecargoForpag(valueForpag, descriForpag);

    if (valueForpag == 5) {
        document.getElementById('id-txt-help-forpag').innerHTML = 'Abonarás el pedido en efectivo al momento de la entrega';
    } else if (valueForpag == 4) {
        document.getElementById('id-txt-help-forpag').innerHTML = 'Apenas confirmes el pedido te enviaremos un email con los datos para realizar la transferencia bancaria';
    } else {
        document.getElementById('id-txt-help-forpag').innerHTML = 'Apenas confirmes el pedido te enviaremos un email con los datos del pedido y con un botón para pagar mediante Mercado Pago';
    }
}

//Detecto cambio de selecciones en selects
document.getElementById('id-select-forenv').addEventListener('change', (event) => {
    changeForenvSelected();
});

document.getElementById('id-select-forpag').addEventListener('change', (event) => {
    changeForpagSelected();
});

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
            // console.log((data));
            // document.getElementById('id-input-domi').value = data.toUpperCase();
            // }
            domicilioDelCliente = data + ' | ';
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
        // console.log((data));

        if (data.trim() != '' && data.trim() != 0) {
            // if (document.getElementById('id-locali')) {
            // document.getElementById('id-input-locali').value = data.toUpperCase();
            // }
            domicilioDelCliente = domicilioDelCliente + data + ' | ';
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
        // console.log((data));

        if (data.trim() != '' && data.trim() != 0) {
            // if (document.getElementById('id-cpost')) {
            // document.getElementById('id-input-cpost').value = data.toUpperCase();
            // }
            domicilioDelCliente = domicilioDelCliente + data + ' | ';
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
            // document.getElementById('id-input-prov').value = data.toUpperCase();
            // }
            domicilioDelCliente = domicilioDelCliente + data + ' | ';
        }

    } catch (error) {
        console.log(error);
    }
}

function setDataDomicilio() {
    console.log('MI DOMICILIO');
    setTimeout(function () {
        getDomicilio();
    }, 500);

    setTimeout(function () {
        getLocalidad();
    }, 500);

    setTimeout(function () {
        getCodPost();
    }, 500);

    setTimeout(function () {
        getProvincia();
    }, 500);
}
setDataDomicilio();

const getDataTotalesCheckout = async (forenv, descriForenv = null, descriForpag = null, porcentajeIncremento = null) => {
    // type --> domicilio | retiro --> Domicilio hacer referencia a envío a domicilio. Retiro en sucursal

    console.log('FORMA DE ENVÍO ' + forenv + ' || PORCENTAJE DE INCREMENTO ' + porcentajeIncremento);

    let formData = new FormData();
    formData.append('funcion', 'getDataTotalesCheckout');
    formData.append('forenv', forenv);
    formData.append('descriForenv', descriForenv);
    formData.append('descriForpag', descriForpag);
    formData.append('porcentajeIncremento', porcentajeIncremento);
    // formData.append('forpag', forpag);
    try {
        const res = await fetch(URL_APP + 'php/services/' + 'session.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.json();
        console.log(data);
        // console.log(typeof (data['cantidadProdutos']));

        document.getElementById('id-costo-envio-checkout').innerHTML = '$ ' + round(data['costoRealDeEnvio'], 2);
        document.getElementById('id-checkout-total').innerHTML = '$ ' + data['acumuladorTotalConDescuentoGral'];

        document.getElementById('id-span-cart-accumulator-price').innerHTML = '$ ' + data['acumuladorTotalConDescuentoGral'];

        /*
            'porcentajeIncremento' => number_format($porcentajeIncremento, 2),
            'montoPorcentajeIncremento' => number_format($montoPorcentajeIncremento, 2)
        */

        document.getElementById('id-costo-recargo-checkout').innerHTML = '$ ' + data['montoPorcentajeIncremento'];
        document.getElementById('id-costo-recargo').innerHTML = data['porcentajeIncremento'] + ' %';

    } catch (error) {
        console.log(error);
    }
}

//Seteo todos los datos por defecto iniciales.
getDataTotalesCheckout('domicilio', 'Envío a domicilio', 'Efectivo');

const registrarPedido = async () => {
    // showPopupLoading('¡EXCELENTE! Registrando el pedido...', '', 15000);

    // console.log(document.getElementById('id-input-date').value);
    // console.log(document.getElementsByClassName('class-date-picker').value);
    // return;

    let descriForenv = document.getElementById('id-select-forenv').options[document.getElementById('id-select-forenv').selectedIndex].text;
    let descriForpag = document.getElementById('id-select-forpag').options[document.getElementById('id-select-forpag').selectedIndex].text;

    console.log(descriForenv);
    console.log(descriForpag);

    let valueForenv = document.getElementById('id-select-forenv').value.trim(); // 1 Envío a domicilio | 2 Retiro en sucursal
    let valueForpag = document.getElementById('id-select-forpag').value.trim(); // 1 efect. 2 transfer. 3/4/5 MP
    let infoAdic = document.getElementById('id-info-adic').value.trim();

    if (descriForenv.includes('domicilio') || descriForenv.includes('Domicilio')) {
        console.log('valueForenv == 1');
        if (document.getElementById('id-input-date').value.trim() == '') {
            showAlertToast('info', 'CUIDADO! Debes seleccionar el día en que quieres recibir tu pedido. Selecciona una fecha entre lunes y viernes para proceder!', '12000');
            // showAlertToast('success', 'EXCELENTE! Iniciando sesión con tus datos. Actualizando!', '12000');
            document.getElementById('id-info-adic').focus();
            return;
        } else {
            if (domicilioDelCliente.trim() != '' || infoAdic != '') {
                infoAdic = ' | ENVÍO A DOMICILIO ' + ' ' + domicilioDelCliente + '. ' + infoAdic + ' | FECHA SELECCIONADA ' + document.getElementById('id-input-date').value;
                console.log('infoAdic: ' + infoAdic);
            } else {
                console.log('error: ' + 'CUIDADO! Debes ingresar un domicilio para la entrega. Agregá tu domicilio en el apartado Información adicional para proceder!');
                showAlertToast('error', 'CUIDADO! Debes ingresar un domicilio para la entrega. Agregá tu domicilio en el apartado Información adicional para proceder!', '12000');
                document.getElementById('id-info-adic').focus();
                return;
            }
        }
    } else {
        console.log('valueForenv != 1');
        let sel = document.getElementById('id-select-forenv');
        let text = sel.options[sel.selectedIndex].text;
        infoAdic = infoAdic + ' | ' + text.toUpperCase();
    }

    let selForPag = document.getElementById('id-select-forpag');
    let textForPag = selForPag.options[selForPag.selectedIndex].text;
    infoAdic = infoAdic + ' | FORMA DE PAGO: ' + textForPag.toUpperCase();

    if (valueForpag < 4) {
        infoAdic = infoAdic + ' | PAGO PENDIENTE DE VERIFICACIÓN';
    }

    // console.log(infoAdic);
    // return;

    let formData = new FormData();
    formData.append('funcion', 'registrarPedido');
    formData.append('valueForenv', valueForenv);
    formData.append('valueForpag', valueForpag);
    formData.append('infoAdic', infoAdic);
    try {
        const res = await fetch(URL_APP + 'php/backend/' + 'pedido.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.text();
        console.log(data);

        if (data == 1) {
            // window.location.href = URL_APP + 'response-checkout';

            // Envío de email
            let formData = new FormData();
            formData.append('funcion', 'sendEmailPedido');
            try {
                const res = await fetch(URL_APP + 'php/modules/mail/mailer.php', {
                    method: 'POST',
                    body: formData
                });
                const data = await res.text();
                console.log(data);

                if (data.trim() == 'fs_1') {
                    showAlertToast('success', 'PEDIDO REGISTRADO! Revisa tu email <b>email</b>! Redireccionando...', '2000');

                    setTimeout(function () {
                        window.location.href = URL_APP + 'response-checkout';
                    }, 2000);
                } else {
                    showAlertToast('error', 'ERROR! Revisa tus <b>datos</b>!', '4000');
                }

            } catch (error) {
                console.log(error);
            }
        }
    } catch (error) {
        console.log(error);
    }
}

const getRecargoForpag = async (idForpag, descriForpag) => {
    // console.log(descriForpag);
    let formData = new FormData();
    formData.append('funcion', 'getRecargoForpag');
    formData.append('idForpag', idForpag);
    formData.append('descriForpag', descriForpag);

    try {
        const res = await fetch(URL_APP + 'php/backend/' + 'forpag.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.json();
        // console.log(typeof (data));
        // console.log((data[0]['recargo']));

        // if (Number(data[0]['recargo']) > 0) {
        getDataTotalesCheckout(forenvDefecto, null, descriForpag, Number(data[0]['recargo']));
        // }

        if (Number(data[0]['recargo']) > 0) {
            document.getElementById('id-txt-help-forpag-recargo').innerHTML = 'Esta forma de pago tiene un recargo del ' + Number(data[0]['recargo']) + ' %';
        } else {
            document.getElementById('id-txt-help-forpag-recargo').innerHTML = '';
        }

    } catch (error) {
        console.log(error);
    }
}