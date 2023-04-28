'use strict';

function addProductToCart(obj) {
    let idProducto = obj.dataset.num;
    let denom = obj.dataset.denom;
    let stopro = obj.dataset.stopro;
    let stoact = obj.dataset.stoact;
    let idestado = obj.dataset.idestado;
    let prefin = obj.dataset.prefin;
    let bonfija = obj.dataset.bonfija;
    let tipbonifi = obj.dataset.tipbonifi;
    let idPresentacion = obj.dataset.idpresentacion;
    let pesopres = obj.dataset.pesopres;

    // let cantidad = document.getElementById('id-span-cantidad-' + idProducto).textContent;
    let cantidad = document.getElementById('id-span-cantidad-' + idProducto).value;

    if (cantidad < 1) {
        showAlertToast('warning', '¡CUIDADO! Verifique la cantidad que desea agregar al carrito.', '12000');
        return;
    }

    let preciofinalpresentconbonifi = obj.dataset.preciofinalpresentconbonifi;

    console.log('preciofinalpresentconbonifi ---> ' + preciofinalpresentconbonifi);
    console.log('idPresentacion ---> ' + idPresentacion);
    console.log('pesopres ---> ' + pesopres);
    // return;

    let preciofinal = obj.dataset.preciofinal;

    if (preciofinalpresentconbonifi > 0) {
        preciofinal = preciofinalpresentconbonifi;
    }

    // console.log('DENOM: ' + denom);
    // console.log(typeof(parseInt(stoact)) + ' | ' + typeof(parseInt(cantidad)));

    // console.log('Stoact ==> ' + stoact);
    // console.log('Cantidad ==> ' + cantidad);
    // console.log('Resultado ==> ' + (stoact - cantidad));

    // return;

    addSDNewProductToCart(idProducto, denom, stopro, stoact, idestado, prefin, preciofinal, bonfija, tipbonifi,
        idPresentacion, pesopres, cantidad);
}

function addComboToCart(obj) {
    let idCombo = obj.dataset.id; // ID DEL COMBO
    let denom = obj.dataset.denom;

    let fecvenci = obj.dataset.fecvenci;
    let tipobonifi = obj.dataset.tipobonifi;

    let bonifi = obj.dataset.bonifi;
    let pretot = obj.dataset.pretot;

    let prefin = obj.dataset.prefin;

    let stoact = obj.dataset.stoact;
    let stoini = obj.dataset.stoini;

    // let cantidad = document.getElementById('id-span-cantidad-' + idCombo).textContent;
    let cantidad = document.getElementById('id-span-cantidad-' + idCombo).value;

    // console.log('cantidad --- > ' + cantidad);
    // console.log('pretot --- > ' + pretot);
    // console.log('prefin --- > ' + prefin);
    // return;

    // let preciofinalpresentconbonifi = obj.dataset.preciofinalpresentconbonifi;
    // let preciofinal = obj.dataset.preciofinal;

    // if (preciofinalpresentconbonifi > 0) {
    //     preciofinal = preciofinalpresentconbonifi;
    // }

    // console.log('DENOM: ' + denom);
    // console.log(typeof(parseInt(stoact)) + ' | ' + typeof(parseInt(cantidad)));

    addSDNewComboToCart(idCombo, denom, fecvenci, tipobonifi, bonifi, pretot, prefin, cantidad, stoact, stoini);
}

function setPresSelectedToProductData(element) {
    /*
    Setea el dataset del href correspondiente con el dato del id de la presentación seleccionada
    */

    console.log('element ---> ' + element);
    console.log('PRECIO PRESENTACIÓN SIN BONIFICACIÓN ---> ' + element.dataset.preciofinalpresentsinbonifi);
    console.log('PRECIO PRESENTACIÓN CON BONIFICACIÓN ---> ' + element.dataset.preciofinalpresentconbonifi);

    let idPresentacionSeleccionada = element.dataset.codpres;
    let idProducto = element.dataset.numero;
    let pesoPres = element.dataset.pesopres;

    let e = document.getElementById('id-href-addproductcart-' + idProducto);
    e.dataset.idpresentacion = idPresentacionSeleccionada;
    e.dataset.pesopres = pesoPres;

    e.dataset.preciofinalpresentconbonifi = element.dataset.preciofinalpresentconbonifi;

    document.getElementById('id-span-precio-present-con-bonifi-card-' + idProducto).innerHTML = '$ ' + round(element.dataset.preciofinalpresentconbonifi, 2);
    // document.getElementById('id-span-precio-present-con-bonifi-card-' + idProducto).innerHTML = '$ ' + round(element.dataset.preciofinalpresentsinbonifi, 2);

    if (document.getElementById('id-span-precio-present-sin-bonifi-card-' + idProducto)) {
        document.getElementById('id-span-precio-present-sin-bonifi-card-' + idProducto).innerHTML = '$ ' + round(element.dataset.preciofinalpresentsinbonifi, 2);
    }
}

function round(num, decimales) {
    var signo = (num >= 0 ? 1 : -1);
    num = num * signo;
    if (decimales === 0) //con 0 decimales
        return signo * Math.round(num);
    // round(x * 10 ^ decimales)
    num = num.toString().split('e');
    num = Math.round(+(num[0] + 'e' + (num[1] ? (+num[1] + decimales) : decimales)));
    // x * 10 ^ (-decimales)
    num = num.toString().split('e');
    return signo * (num[0] + 'e' + (num[1] ? (+num[1] - decimales) : -decimales));
}

const addSDNewProductToCart = async (idProducto, denom, stopro, stoact, idestado, prefin, preciofinal, bonfija, tipbonifi,
    idPresentacion, pesopres, cantidad) => {
    // Función que setea la sucursal seleccionada.
    let formData = new FormData();
    formData.append('funcion', 'addSDNewProductToCart');
    formData.append('idProducto', idProducto);
    formData.append('type', 'producto');
    formData.append('denom', denom);
    formData.append('stopro', stopro);
    formData.append('stoact', stoact);
    formData.append('idestado', idestado);
    formData.append('prefin', prefin);
    formData.append('preciofinal', preciofinal);
    formData.append('bonfija', bonfija);
    formData.append('tipobonifi', tipbonifi);
    formData.append('idPresentacion', idPresentacion);
    formData.append('pesopres', pesopres);
    formData.append('cantidad', cantidad);

    try {
        const res = await fetch(URL_APP + 'php/services/' + 'session.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.json();
        console.log(typeof (data));
        console.log((data));

        if (document.getElementById('id-span-cart-accumulator-price-dropdown')) {
            document.getElementById('id-span-cart-accumulator-price-dropdown').innerHTML = '$ ' + (data['acumuladorTotal']);
        }

        if (document.getElementById('id-span-cart-accumulator-price')) {
            document.getElementById('id-span-cart-accumulator-price').innerHTML = '$ ' + (data['acumuladorTotal']);
        }

        if (document.getElementById('id-span-cart-amount-product')) {
            document.getElementById('id-span-cart-amount-product').innerHTML = (data['cantidadProdutos']);
        }

        if (document.getElementById('id-span-cart-amount-product-mobile')) {
            document.getElementById('id-span-cart-amount-product-mobile').innerHTML = (data['cantidadProdutos']);
        }

        if ((stoact - cantidad) < 0) {
            showAlertToast('info', '¡ATENCIÓN! Agregamos el producto correctamente a tu carrito, pero actualmente el stock es insuficiente. Nos pondremos en contacto contigo cuando confirmes el pedido.', '12000');
        } else {
            showAlertToast('success', 'EXCELENTE! Agregamos el producto correctamente a tu carrito.', '6000');
        }

        const urlLocal = window.location.href;
        if (urlLocal.includes('product-detail')) {
            window.location.href = URL_APP + 'cart';
        }

    } catch (error) {
        console.log(error);
    }
}

const addSDNewComboToCart = async (idCombo, denom, fecvenci, tipobonifi, bonifi, pretot, prefin, cantidad, stoact, stoini) => {
    // Función que setea la sucursal seleccionada.
    let formData = new FormData();
    formData.append('funcion', 'addSDNewComboToCart');
    formData.append('type', 'combo');
    formData.append('idCombo', idCombo);
    formData.append('idPresentacion', 0);
    formData.append('denom', denom);
    formData.append('fecvenci', fecvenci);
    formData.append('tipobonifi', tipobonifi);
    formData.append('bonifi', bonifi); // ---
    formData.append('pretot', pretot);
    formData.append('prefin', prefin);
    formData.append('cantidad', cantidad);
    formData.append('stoact', stoact);
    formData.append('stoini', stoini);

    try {
        const res = await fetch(URL_APP + 'php/services/' + 'session.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.json();
        console.log(typeof (data));
        console.log((data));

        if (document.getElementById('id-span-cart-accumulator-price-dropdown')) {
            document.getElementById('id-span-cart-accumulator-price-dropdown').innerHTML = '$ ' + (data['acumuladorTotal']);
        }

        if (document.getElementById('id-span-cart-accumulator-price')) {
            document.getElementById('id-span-cart-accumulator-price').innerHTML = '$ ' + (data['acumuladorTotal']);
        }

        if (document.getElementById('id-span-cart-amount-product')) {
            document.getElementById('id-span-cart-amount-product').innerHTML = (data['cantidadProdutos']);
        }

        if (document.getElementById('id-span-cart-amount-product-mobile')) {
            document.getElementById('id-span-cart-amount-product-mobile').innerHTML = (data['cantidadProdutos']);
        }

        if ((stoact - cantidad) < 0) {
            showAlertToast('info', '¡ATENCIÓN! Agregamos el combo correctamente a tu carrito, pero actualmente el stock es insuficiente. Nos pondremos en contacto contigo cuando confirmes el pedido.', '12000');
        } else {
            showAlertToast('success', 'EXCELENTE! Agregamos el combo correctamente a tu carrito.', '6000');
        }

        const urlLocal = window.location.href;
        if (urlLocal.includes('product-detail')) {
            window.location.href = URL_APP + 'cart';
        }

    } catch (error) {
        console.log(error);
    }
}