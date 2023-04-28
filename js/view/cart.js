'use strict';

localStorage.setItem('locationPrevLogin', '');

const deleteOneProductInCart = async (type, numero, idPresentacion) => {
    console.log(numero);
    console.log(type);
    console.log(idPresentacion);
    // return;

    let formData = new FormData();
    formData.append('funcion', 'deleteOneProductInCart');
    formData.append('type', type);
    formData.append('numero', numero);
    formData.append('idPresentacion', idPresentacion);

    try {
        const res = await fetch(URL_APP + 'php/services/' + 'session.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.text();
        // console.log(typeof (data));
        // console.log((data));

        if (data === '1') {
            location.reload();
        } else {
            location.reload();
        }
    } catch (error) {
        console.log(error);
    }
}

function goToHome() {
    window.location.href = URL_APP + 'index';
}

function goToLogin() {
    window.location.href = URL_APP + 'login';
    localStorage.setItem('locationPrevLogin', 'cart');
}

function goToCreateAccount() {
    window.location.href = URL_APP + 'create-account';
    localStorage.setItem('locationPrevLogin', 'cart');
}

const cleanCart = async () => {
    let formData = new FormData();
    formData.append('funcion', 'cleanCart');

    try {
        const res = await fetch(URL_APP + 'php/services/' + 'session.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.text();
        // console.log(typeof (data));
        // console.log((data));
        location.reload();
    } catch (error) {
        console.log(error);
    }
}

function confirmCleanCart() {
    // const swalWithBootstrapButtons = Swal.mixin({
    //     customClass: {
    //         confirmButton: 'btn btn-success',
    //         cancelButton: 'btn btn-danger'
    //     },
    //     buttonsStyling: false
    // })

    Swal.fire({
        title: '¿Estás seguro?',
        text: 'Vaciarás tu carrito de compras completamente...',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, vaciar!',
        cancelButtonText: 'No, cancelar!',
        confirmButtonColor: '#60A3D9', // '#3085d6',
        cancelButtonColor: '#F27474', // '#d33',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Ok!',
                'Vaciando tu carrito...',
                'success'
            );
            setTimeout(function () {
                cleanCart();
            }, 1000);
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            // swalWithBootstrapButtons.fire(
            //     'Cancelled',
            //     'Your imaginary file is safe :)',
            //     'error'
            // )
        }
    });
}

//
const addCountProductInCart = async (type, numero, idPresentacion) => {

    // console.log('CANTIDAD ACTUAL ==> ' + cantidadActual);

    // return;

    let cantidad = 1;

    let formData = new FormData();
    formData.append('funcion', 'addSDNewProductToCart');
    formData.append('type', type);
    formData.append('idProducto', numero);
    formData.append('cantidad', cantidad);
    formData.append('idPresentacion', idPresentacion);

    try {
        const res = await fetch(URL_APP + 'php/services/' + 'session.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.text();
        // console.log(typeof (data));
        // console.log((data));
        location.reload();
    } catch (error) {
        console.log(error);
    }
}

const lessCountProductInCart = async (type, numero, idPresentacion, cantidadActual) => {

    console.log('CANTIDAD ACTUAL ==> ' + cantidadActual);

    if(cantidadActual <= 1){
        // console.log('NO PUEDE SER MENOR A 1');
        return;
    }

    // return;

    let cantidad = -1;

    let formData = new FormData();
    formData.append('funcion', 'addSDNewProductToCart');
    formData.append('type', type);
    formData.append('idProducto', numero);
    formData.append('cantidad', cantidad);
    formData.append('idPresentacion', idPresentacion);

    try {
        const res = await fetch(URL_APP + 'php/services/' + 'session.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.text();
        // console.log(typeof (data));
        // console.log((data));
        location.reload();
    } catch (error) {
        console.log(error);
    }
}

const goToCheckout = async () => {
    let formData = new FormData();
    formData.append('funcion', 'validateCanCheckout');

    try {
        const res = await fetch(URL_APP + 'php/services/' + 'session.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.text();
        // console.log(typeof (data));
        // console.log((data));

        if (data == 'e0') {
            showAlertToast('error', 'ATENCIÓN! No tienes productos en tu carrito. Agrega los productos que deseas al carrito para confirmar tu pedido!', '12000');
        } else if (data == 'e1') {
            showAlertToast('error', 'ATENCIÓN! Inicia sesión para proceder con la confirmación de tu pedido!', '12000');
        } else {
            window.location.href = URL_APP + 'checkout';
        }
    } catch (error) {
        console.log(error);
    }
}