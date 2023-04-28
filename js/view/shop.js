'use strict';
// console.log(window.location.href);

function selectBranche(element) {
    // console.log(element.text);
    // console.log(element.id);
    setSDBrancheOfficeSelected(element.id, element.text);
}

const orderShopBy = async (typeOrder) => {
    // Función que setea la sucursal seleccionada.
    let formData = new FormData();
    formData.append('funcion', 'orderShopBy');
    formData.append('typeOrder', typeOrder);

    try {
        const res = await fetch(URL_APP + 'php/services/' + 'session.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.text();
        // console.log(typeof (data));
        // console.log((data));

        if (data == 'sf') {
            location.reload(); // window.location.href = URL_APP + 'shop';
        }

    } catch (error) {
        console.log(error);
    }
}

function goToHome() {
    window.location.href = URL_APP + 'index';
}

function qtyUp(numero, stoact) {

    // console.log('Número ' + numero);
    // console.log('stoact ' + stoact);
    // return;

    let actualyAmount = document.getElementById('id-span-cantidad-' + numero).value;
    console.log('actualyAmount ' + actualyAmount);

    let updatedAmount = parseInt(actualyAmount) + 1;
    console.log('updatedAmount ' + updatedAmount);

    document.getElementById('id-span-cantidad-' + numero).value = updatedAmount;

    if (document.getElementById('idSpanStock')) {
        if ((stoact - updatedAmount) < 0) {
            document.getElementById('idSpanStock').innerHTML = 'Cantidad: ' + updatedAmount + '. Sin stock disponible, nos pondremos en contacto al confirmar el pedido.';
            document.getElementById('idSpanStock').classList.remove('text-brand');
            document.getElementById('idSpanStock').classList.add('text-warning');
        } else {
            document.getElementById('idSpanStock').innerHTML = 'Producto en stock.';
            document.getElementById('idSpanStock').classList.add('text-brand');
            document.getElementById('idSpanStock').classList.remove('text-warning');
        }
    }
}

function qtyDown(numero, stoact) {
    let actualyAmount = document.getElementById('id-span-cantidad-' + numero).value;
    console.log('actualyAmount ' + parseInt(actualyAmount));

    let updatedAmount = parseInt(actualyAmount) - 1;
    if (updatedAmount < 1) {
        updatedAmount = 1;
    }

    console.log('updatedAmount ' + updatedAmount);

    document.getElementById('id-span-cantidad-' + numero).value = updatedAmount;

    if (document.getElementById('idSpanStock')) {
        if ((stoact - updatedAmount) < 0) {
            document.getElementById('idSpanStock').innerHTML = 'Cantidad: ' + updatedAmount + '. Sin stock disponible, nos pondremos en contacto al confirmar el pedido.';
            document.getElementById('idSpanStock').classList.remove('text-brand');
            document.getElementById('idSpanStock').classList.add('text-warning');
        } else {
            document.getElementById('idSpanStock').innerHTML = 'Producto en stock.';
            document.getElementById('idSpanStock').classList.add('text-brand');
            document.getElementById('idSpanStock').classList.remove('text-warning');
        }
    }
}