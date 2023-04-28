'use strict';

const formSearch = document.getElementById('id-form-search-header');
const btnSearch = document.getElementById('idBtnSearch');

const getDataCart = async () => {
    let formData = new FormData();
    formData.append('funcion', 'getDataCart');
    try {
        const res = await fetch(URL_APP + 'php/services/' + 'session.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.json();
        console.log(data);
        // console.log(typeof (data['cantidadProdutos']));

        if (data['cantidadProdutos'] == 0) {
            document.getElementById('id-span-cart-amount-product').innerHTML = '0';
            document.getElementById('id-span-cart-accumulator-price').innerHTML = '$ 00.00';

            if (document.getElementById('id-span-cart-amount-product-mobile')) {
                document.getElementById('id-span-cart-amount-product-mobile').innerHTML = '0';
            }

            if (document.getElementById('id-span-cart-accumulator-price-dropdown')) {
                document.getElementById('id-span-cart-accumulator-price-dropdown').innerHTML = '$ 00.00';
            }
        } else {
            document.getElementById('id-span-cart-accumulator-price').innerHTML = '$ ' + (data['acumuladorTotalConDescuentoGral']);
            document.getElementById('id-span-cart-amount-product').innerHTML = (data['cantidadProdutos']);

            if (document.getElementById('id-span-cart-amount-product-mobile')) {
                document.getElementById('id-span-cart-amount-product-mobile').innerHTML = (data['cantidadProdutos']);
            }

            if (document.getElementById('id-span-cart-accumulator-price-dropdown')) {
                document.getElementById('id-span-cart-accumulator-price-dropdown').innerHTML = '$ ' + (data['acumuladorTotalConDescuentoGral']);
            }
        }

        // Si la página es cart.php
        if (data['cantidadProdutos'] == 0 && document.getElementById('id-cart-resumen-subtotal')) {
            document.getElementById('id-cart-resumen-subtotal').innerHTML = '$ 00.00';
            document.getElementById('id-cart-porcentaje-descuento').innerHTML = data['porcentajeDescuentoGral'] + ' %'; // document.getElementById('id-cart-resumen-descuento').innerHTML = data['porcentajeDescuentoGral'] + ' % | $ 00.00';
            document.getElementById('id-cart-resumen-descuento').innerHTML = '- $ ' + data['montoDescuento'];

            if (document.getElementById('id-cart-resumen-total')) {
                document.getElementById('id-cart-resumen-total').innerHTML = '$ 00.00';
            }
        } else if (document.getElementById('id-cart-resumen-subtotal')) {
            document.getElementById('id-cart-resumen-subtotal').innerHTML = '$ ' + data['acumuladorTotal'];
            document.getElementById('id-cart-porcentaje-descuento').innerHTML = data['porcentajeDescuentoGral'] + ' %';
            document.getElementById('id-cart-resumen-descuento').innerHTML = '- $ ' + data['montoDescuento'];

            if (document.getElementById('id-cart-resumen-subtotal-con-descuento')) {
                document.getElementById('id-cart-resumen-subtotal-con-descuento').innerHTML = '$ ' + data['acumuladorTotalConDescuentoGral'];
            }

            if (document.getElementById('id-cart-resumen-total')) {
                document.getElementById('id-cart-resumen-total').innerHTML = '$ ' + data['acumuladorTotalConDescuentoGral'];
            }
        }
    } catch (error) {
        console.log(error);
    }
}
getDataCart();

const setEmailHeaderAccount = async () => {
    let formData = new FormData();
    // formData.append('funcion', 'getEmailLoggedClient');
    formData.append('funcion', 'getNameLoggedClient');

    try {
        const res = await fetch(URL_APP + 'php/services/' + 'session.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.text();
        // console.log(typeof (data));
        console.log((data));

        if (data.trim() != '' && data.trim() != 0) {
            if (document.getElementById('id-email-account-header')) {
                document.getElementById('id-email-account-header').textContent = data; // .split('@')[0];
            }
            if (document.getElementById('id-email-account-header-mobile')) {
                document.getElementById('id-email-account-header-mobile').textContent = data; // .split('@')[0];
            }
        }

    } catch (error) {
        console.log(error);
    }
}
setEmailHeaderAccount();

const closeSession = async () => {
    let formData = new FormData();
    formData.append('funcion', 'closeSession');

    try {
        const res = await fetch(URL_APP + 'php/services/' + 'session.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.text();
        // console.log(typeof (data));
        // console.log((data));

        showAlertToast('success', '¡ESPERAMOS VERTE DE REGRESO PRONTO!', '5000');
        setTimeout(function () {
            window.location.href = URL_APP + 'login';
        }, 3000);

        return;

    } catch (error) {
        console.log(error);
    }
}

formSearch.addEventListener('submit', searchResults);
btnSearch.addEventListener('click', searchResults);

function searchResults(event) {
    event.preventDefault();
    let txt = (document.getElementById('id-input-text-search').value).trim();
    // console.log(txt);
    // console.log(URL_APP + 'shop?tx=' + txt);
    window.location.href = URL_APP + 'shop.php?tx=' + txt;
}

if (document.getElementById('id-btn-search-mobile')) {
    document.getElementById('id-btn-search-mobile').addEventListener("click", function (event) {
        event.preventDefault();
        let txt = document.getElementById('id-input-text-search-mobile');
        // console.log(txt.value);
        window.location.href = URL_APP + 'shop.php?tx=' + txt.value.trim();
    });
}