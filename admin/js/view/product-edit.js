'use strict';

// **************************************************************************************************************
// ELEMENTOS DEL DOM
const selectDiscountSinDescuento = document.getElementById('id-seelct-discount-sindescuento');
const selectDiscountFijo = document.getElementById('id-seelct-discount-fijo');
const selectDiscountPorcentaje = document.getElementById('id-seelct-discount-porcentaje');

const inputDenomProd = document.getElementById('id-input-product-name');
const inputDescriProd = document.getElementById('id-input-product-denom');
const selectEstadoProd = document.getElementById('kt_ecommerce_add_product_status_select');
const inputDescuentoMontoFijo = document.getElementById('id-input-descuento-monto-fijo');
const inputDescuentoPorcentaje = document.getElementById('kt_ecommerce_add_product_discount_label');
const inputCalculadoPrecioFinal = document.getElementById('id-input-product-precio-final');
const inputStowebProd = document.getElementById('id-input-stoweb');

// **************************************************************************************************************
// VARIABLES
let numeroProducto = getParameterByName('num');
let prefinProduct = 0;
let tipoBonifi = '';

let typeDiscountSelected = '';
let canSaveChanges = true;

/**Variables de presentaciones */
let pres1 = '';
let pres2 = '';
let pres3 = '';
let pres4 = '';
// **************************************************************************************************************

function updateTypeDiscountSelected(type) {
    /*
    s - Sin descuento
    p - Porcentaje: Porcentaje sobre el precio del producto
    f - Fijo: Monto fijo sobre el precio del producto
    */
    if (type === 's' || type === 'p' || type === 'f') {
        typeDiscountSelected = type;
    } else {
        typeDiscountSelected = 's';
    }
}

function saveChangeProduct() {

    console.log(inputDescriProd.value.trim());

    // return;

    console.log(inputDenomProd.value.trim());

    console.log(selectEstadoProd.value.trim());
    let idEstadoProducto = selectEstadoProd.value.trim();

    console.log(typeDiscountSelected); // s|p|f
    let bonfija = 0;
    if (typeDiscountSelected == 'p') {
        bonfija = inputDescuentoPorcentaje.innerHTML.trim();
    } else if (typeDiscountSelected == 'f') {
        bonfija = inputDescuentoMontoFijo.value.trim();
    }

    console.log('BONFIJA ---> ' + bonfija);

    console.log(inputCalculadoPrecioFinal.value.replace('$', '').trim());
    let precioFinal = inputCalculadoPrecioFinal.value.replace('$', '').trim();

    console.log(inputStowebProd.value);

    getAllPresentations();
    console.log(pres1);
    console.log(pres2);
    console.log(pres3);
    console.log(pres4);

    if (inputDenomProd.value == '' || inputDenomProd.value == null) {
        console.log('ALGO VACÍO O NULLO')
        return;
    }
    if (inputDenomProd.value == '' || inputDenomProd.value == null) {
        console.log('ALGO VACÍO O NULLO')
        return;
    }

    if (!canSaveChanges) {
        return;
    }

    updateDataProduct(inputDenomProd.value.trim(), inputDescriProd.value.trim(), idEstadoProducto, typeDiscountSelected, bonfija, precioFinal,
        pres1, pres2, pres3, pres4, inputStowebProd.value.trim());

    // let divDescrip = document.querySelector('.ql-editor').childNodes; // .getElementsByTagName('p'); // .getElementsByTagName('ul')[0];
    // console.log(document.querySelector('.ql-editor'));
    // for (let i = 0; i < divDescrip.length; i++) {
    //     console.log(divDescrip[i].innerHTML);
    // }

}

const getOneProductOfCod = async (numeroProd) => {
    console.log('el nro prodicto es ' + numeroProd);

    if (numeroProd.trim() == '') {
        // showAlertToast('error', '¡CUIDADO! El email o la contraseña no son correctas, por favor revisa y vuelve a intentarlo...', '12000');
        console.log('vacío');
        return;
    }

    let formData = new FormData();
    formData.append('funcion', 'getOneProductOfCod');
    formData.append('numero', numeroProd.trim());

    try {
        const res = await fetch(URL_APP + 'php/backend/' + 'producto.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.json();
        console.log(data[0]['stoweb']);
        console.log(data);
        prefinProduct = parseFloat(data[0]['prefin']);

        document.getElementById('id-input-product-cod').value = data[0]['numero'];
        document.getElementById('id-input-codbarras').value = data[0]['codcom'];
        document.getElementById('id-input-stoact').value = parseInt(data[0]['stoact']);

        inputDescuentoPorcentaje.innerHTML = parseInt(data[0]['bonfija']);

        if (data[0]['stoweb'] != null && data[0]['stoweb'] != '') {
            document.getElementById('id-input-stoweb').value = data[0]['stoweb'];
        } else {
            document.getElementById('id-input-stoweb').value = '0';
        }

        const paragraph = document.createElement('p');
        const textNode = document.createTextNode(data[0]['denom1'].trim());
        paragraph.appendChild(textNode);
        document.querySelector('.ql-editor').appendChild(paragraph);

        document.querySelector('.ql-code-block').style.display = 'none';
        document.getElementById('id-input-product-name').value = data[0]['denom'].trim();
        document.getElementById('id-input-product-denom').value = decodeURIComponent(escape(data[0]['denom1'].trim()));
        document.getElementById('id-input-product-precio-base').value = '$ ' + data[0]['prefin'].trim();

        const punteroSliderDescuentoProcentaje = document.querySelector('.noUi-handle');

        if (data[0]['tipboni'].trim() == 's') {
            tipoBonifi = 's';
            // id-seelct-discount-sindescuento
            selectDiscountSinDescuento.classList.add("active");
            selectDiscountFijo.classList.remove("active");
            selectDiscountPorcentaje.classList.remove("active");

            document.getElementById('id-check-descuento-sin').setAttribute('checked', 'checked');
            document.getElementById('id-check-descuento-fijo').removeAttribute('checked', 'checked');
            document.getElementById('id-check-descuento-porcentaje').removeAttribute('checked', 'checked');

            document.getElementById('kt_ecommerce_add_product_discount_percentage').classList.add('d-none');
            document.getElementById('kt_ecommerce_add_product_discount_fixed').classList.add('d-none');
        } else if (data[0]['tipboni'].trim() == 'f') {
            tipoBonifi = 'f';
            // id-seelct-discount-fijo
            selectDiscountSinDescuento.classList.remove("active");
            selectDiscountFijo.classList.add("active");
            selectDiscountPorcentaje.classList.remove("active");

            document.getElementById('id-check-descuento-sin').removeAttribute('checked', 'checked');
            document.getElementById('id-check-descuento-fijo').setAttribute('checked', 'checked');
            document.getElementById('id-check-descuento-porcentaje').removeAttribute('checked', 'checked');

            document.getElementById('kt_ecommerce_add_product_discount_percentage').classList.add('d-none');
            document.getElementById('kt_ecommerce_add_product_discount_fixed').classList.remove('d-none');

            if (data[0]['bonfija'] > 0) {
                let precioFinal = parseFloat(data[0]['prefin']) - parseFloat(data[0]['bonfija']);

                document.getElementById('id-input-descuento-monto-fijo').value = (parseFloat(data[0]['bonfija']));
                document.getElementById('id-input-product-precio-final').value = '$ ' + round(precioFinal, 2);
                updateEndPriceFixedDiscount();
            }

        } else if (data[0]['tipboni'].trim() == 'p') {
            tipoBonifi = 'p';
            // id-seelct-discount-porcentaje
            selectDiscountSinDescuento.classList.remove("active");
            selectDiscountFijo.classList.remove("active");
            selectDiscountPorcentaje.classList.add("active");

            document.getElementById('id-check-descuento-sin').removeAttribute('checked', 'checked');
            document.getElementById('id-check-descuento-fijo').removeAttribute('checked', 'checked');
            document.getElementById('id-check-descuento-porcentaje').setAttribute('checked', 'checked');

            document.getElementById('kt_ecommerce_add_product_discount_percentage').classList.remove('d-none');
            document.getElementById('kt_ecommerce_add_product_discount_fixed').classList.add('d-none');

            if (data[0]['bonfija'] > 0) {
                punteroSliderDescuentoProcentaje.setAttribute('aria-valuenow', data[0]['bonfija']);
                punteroSliderDescuentoProcentaje.setAttribute('aria-valuetext', data[0]['bonfija']);

                let precioFinal = parseFloat(data[0]['prefin']) - parseFloat(data[0]['prefin']) * (parseInt(data[0]['bonfija']) / 100);

                document.getElementById('id-input-product-precio-final').value = '$ ' + round(precioFinal, 2);
            }
        }

        typeDiscountSelected = tipoBonifi;

        // checked="checked"


    } catch (error) {
        console.log(error);
    }
}

getOneProductOfCod(getParameterByName('num'));

//----------------------------------------------------

function callback(mutationList, observer) {
    mutationList.forEach((mutation) => {
        switch (mutation.type) {
            case 'childList':
                console.log('childList');
                /* Uno o mas hijos han sido añadidos y/o eliminados del árbol;
                   vea mutation.addedNodes y mutation.removedNodes */
                break;
            case 'attributes':
                // console.log('change on attributes');
                updateEndPricePercentDiscount();
                /* El valor de un atributo en mutation.target ha cambiado;
                   El nombre del atributo esta en mutation.attributeName y
                   su valor anterior en mutation.oldValue */
                break;
        }
    });
}

var targetNode = document.getElementById('kt_ecommerce_add_product_discount_slider');
var observerOptions = {
    childList: false,
    attributes: true,
    subtree: true //Omita o ponga false si no quiere controlar los cambios en los hijos
}

var observer = new MutationObserver(callback);
observer.observe(targetNode, observerOptions);

function updateEndPricePercentDiscount() {
    // Realiza el calculo con el porentaje de descuento de descuento
    let porcentajeDescuento = document.getElementById('kt_ecommerce_add_product_discount_label').innerHTML;
    let precioBase = (document.getElementById('id-input-product-precio-base').value).replace('$', '').trim();
    let precioFinal = precioBase - precioBase * (porcentajeDescuento / 100);

    document.getElementById('id-input-product-precio-final').value = '$ ' + round(precioFinal, 2);
}

function updateEndPriceFixedDiscount() {
    if (document.getElementById('id-input-descuento-monto-fijo').value.trim() == '') {
        document.getElementById('idMontoFormatoMoneda').innerText = '$ 0';
    } else {
        document.getElementById('idMontoFormatoMoneda').innerText = '$ ' + setFormatoMoneda(document.getElementById('id-input-descuento-monto-fijo').value);
    }

    // Realiza el calculo con el monto fijo de descuento
    let montoDescuento = document.getElementById('id-input-descuento-monto-fijo').value;
    if (parseFloat(montoDescuento) < 1) {
        montoDescuento = 0;
    }

    let precioBase = (document.getElementById('id-input-product-precio-base').value).replace('$', '').trim();
    let precioFinal = precioBase - montoDescuento;

    if (precioFinal < 0) {
        document.getElementById('id-help-txt-monto-fijo').style.display = 'block';
        document.getElementById('id-help-txt-monto-fijo').innerHTML = 'EL MONTO DE DESCUENTO NO PUEDE SUPERAR EL PRECIO BASE DEL PRODUCTO. REVISE Y VUELVA A INTENTAR.';
        document.getElementById('id-input-product-precio-final').value = '$ ' + round(precioBase, 2);
        canSaveChanges = false;
        return;
    }

    canSaveChanges = true;

    document.getElementById('id-help-txt-monto-fijo').style.display = 'none';
    document.getElementById('id-input-product-precio-final').value = '$ ' + round(precioFinal, 2);
}

function updateEndPriceOutDiscount() {
    // Setea datos sin ningún descuento
    let precioBase = (document.getElementById('id-input-product-precio-base').value).replace('$', '').trim();

    document.getElementById('id-input-product-precio-final').value = '$ ' + precioBase;
}

function formDiscountSelected(forma) {
    // tipoBonifi = // s|p|f;
    if (tipoBonifi == 's') {
        updateEndPriceOutDiscount();
    } else if (tipoBonifi == 'p') {
        updateEndPricePercentDiscount();
    } else if (tipoBonifi == 'f') {
        updateEndPriceFixedDiscount();
    }
}

document.getElementById('id-input-descuento-monto-fijo').addEventListener('input', function () {
    updateEndPriceFixedDiscount();
});

document.getElementById('id-check-descuento-fijo').addEventListener('change', function () {
    /**
     * Detecto cuando seleccione el radio button (type=radio) del descuento fijo
     */
    updateTypeDiscountSelected('f');
    updateEndPriceFixedDiscount();
});

document.getElementById('id-check-descuento-porcentaje').addEventListener('change', function () {
    /**
     * Detecto cuando seleccione el radio button (type=radio) del descuento porcentaje
     */
    updateTypeDiscountSelected('p');
    updateEndPricePercentDiscount();
});

document.getElementById('id-check-descuento-sin').addEventListener('change', function () {
    /**
     * Detecto cuando seleccione el radio button (type=radio) de sin descuento
     */
    updateTypeDiscountSelected('f');
    updateEndPriceOutDiscount();
});

/**
 * Obtengo las presentaciones que el usuario ingresó
 */
function getAllPresentations() {
    if (document.getElementsByName('kt_ecommerce_add_product_options[0][product_option_value]')[0]) {
        pres1 = document.getElementsByName('kt_ecommerce_add_product_options[0][product_option_value]')[0].value;
    } else {
        pres1 = '';
    }

    if (document.getElementsByName('kt_ecommerce_add_product_options[1][product_option_value]')[0]) {
        pres2 = document.getElementsByName('kt_ecommerce_add_product_options[1][product_option_value]')[0].value;
    } else {
        pres2 = '';
    }

    if (document.getElementsByName('kt_ecommerce_add_product_options[2][product_option_value]')[0]) {
        pres3 = document.getElementsByName('kt_ecommerce_add_product_options[2][product_option_value]')[0].value;
    } else {
        pres3 = '';
    }

    if (document.getElementsByName('kt_ecommerce_add_product_options[3][product_option_value]')[0]) {
        pres4 = document.getElementsByName('kt_ecommerce_add_product_options[3][product_option_value]')[0].value;
    } else {
        pres4 = '';
    }
}

/**
 * Detecta cada vez que desde el frontend el usuario hace click para agregar una nueva presentación
 * @param {Elemento/botón al que se le hizo click} btnElement 
 */
function addPresentationBtn(btnElement) {
    if (document.getElementsByName('kt_ecommerce_add_product_options[2][product_option_value]')[0]) {
        btnElement.disabled = true;
    } else {
        btnElement.disabled = false;
    }
}

/**
 * Controla la cantidad de presentaciones que el usuario agregó o quitó para habilitar o deshabilitar el botón de agregar presentaciones
 */
function controlAmountOfPresentations() {
    document.getElementById('id-btn-add-presentations').disabled = false;
}

const getAllPresOfThisProduct = async (numeroProd) => {

    // console.log('NUMERO --> ' + numeroProd);
    // if (numeroProd.trim() == '') {
    //     // showAlertToast('error', '¡CUIDADO! El email o la contraseña no son correctas, por favor revisa y vuelve a intentarlo...', '12000');
    //     console.log('vacío');
    //     return;
    // }

    let formData = new FormData();
    formData.append('funcion', 'getAllPresOfProduct');
    formData.append('numero', numeroProd);

    try {
        const res = await fetch(URL_APP + 'php/backend/' + 'producto.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.json();
        // console.log(data[0]);
        console.log(data);
        // console.log(typeof (data));
        if(data == 0) return;
        // for (let x in data) {
        //     console.log(x['pesopres']);
        // }

        let pres1 = document.getElementsByName('kt_ecommerce_add_product_options[0][product_option_value]')[0];
        let pres2 = document.getElementsByName('kt_ecommerce_add_product_options[1][product_option_value]')[0];
        let pres3 = document.getElementsByName('kt_ecommerce_add_product_options[2][product_option_value]')[0];
        let pres4 = document.getElementsByName('kt_ecommerce_add_product_options[3][product_option_value]')[0];

        let contador = 0;
        data.forEach(function (presentacion) {
            console.log(presentacion);
            console.log(presentacion['pesopres']);
            if (contador == 0) {
                pres1.value = presentacion['pesopres'];
            } else if (contador == 1) {
                pres2.value = presentacion['pesopres'];
            } else if (contador == 2) {
                pres3.value = presentacion['pesopres'];
            } else if (contador == 3) {
                pres4.value = presentacion['pesopres'];
            }

            contador++;
        });


    } catch (error) {
        console.log(error);
    }
}

/**
 * Elimina el primer elemento que se quiere agregar como presentación.
 * Obtiene el botón mediante su atributo y lo ejecuta simulando el click del usuario.
 */
setTimeout(function () {
    // console.log(document.querySelectorAll("[data-repeater-delete]")[0]);
    // document.querySelectorAll("[data-repeater-delete]")[0].click();

    getAllPresOfThisProduct(getParameterByName('num'));
    document.getElementById('id-btn-add-presentations').click();
    document.getElementById('id-btn-add-presentations').click();
    document.getElementById('id-btn-add-presentations').click();
    // getAllPresOfThisProduct(2550);

}, 3000);

// **************************************************************************************************************
//#region TRATAMIENTO DE IMÁGENES

document.getElementById('id-image-principal').onchange = function () {
    console.log('Selected file: ' + this.value);
    console.log(document.getElementById('id-image-principal').dataset.idimage);
    // return;

    let idImgProducto = document.getElementById('id-image-principal').dataset.idimage;
    let numero = getParameterByName('num');
    let denom = getParameterByName('den');

    let url = document.getElementById('id-image-principal').value;
    let file_data = document.getElementById('id-image-principal').files[0]; // $('#imagenInput').prop('files')[0];
    console.log('file_data ' + file_data);
    console.log('file_data.value ' + file_data.value);
    console.log('file_data.name ' + file_data.name);
    console.log('url ' + url);
    console.log('numero ' + numero);

    addOrUpdateImgProducto(file_data, numero, denom, 1, idImgProducto);
}

document.getElementById('id-image-2').onchange = function () {
    console.log('Selected file: ' + this.value);

    let idImgProducto = document.getElementById('id-image-2').dataset.idimage;
    let numero = getParameterByName('num');
    let denom = getParameterByName('den');

    let url = document.getElementById('id-image-principal').value;
    let file_data = document.getElementById('id-image-2').files[0];

    addOrUpdateImgProducto(file_data, numero, denom, 2, idImgProducto);
}

document.getElementById('id-image-3').onchange = function () {
    console.log('Selected file: ' + this.value);

    let idImgProducto = document.getElementById('id-image-3').dataset.idimage;
    let numero = getParameterByName('num');
    let denom = getParameterByName('den');

    let url = document.getElementById('id-image-principal').value;
    let file_data = document.getElementById('id-image-3').files[0];

    addOrUpdateImgProducto(file_data, numero, denom, 3, idImgProducto);
}

document.getElementById('id-image-4').onchange = function () {
    console.log('Selected file: ' + this.value);

    let idImgProducto = document.getElementById('id-image-4').dataset.idimage;
    let numero = getParameterByName('num');
    let denom = getParameterByName('den');

    let url = document.getElementById('id-image-principal').value;
    let file_data = document.getElementById('id-image-4').files[0];

    addOrUpdateImgProducto(file_data, numero, denom, 4, idImgProducto);
}

/**
 * 
 * @param {Archivo} file_data 
 * @param {Número/Código del producto} numero 
 * @param {Denominación del producto} denom 
 * @param {Orden de la imágen: 1-Principal|2|3|4} orderImg 
 * @returns 
 */
const addOrUpdateImgProducto = async (file_data, numero, denom, orderImg, idImgProducto, stoweb) => {
    let formData = new FormData();
    formData.append('funcion', 'addOrUpdateImgProducto');
    formData.append('file_data', file_data);
    formData.append('numero', numero);
    formData.append('denom', denom);
    formData.append('orderImg', orderImg);

    console.log('ID IMG PRODUCTO ' + idImgProducto);

    try {
        const res = await fetch(URL_APP + 'php/libs/img-upload/' + 'compresion.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.text();
        console.log(data);
        if (data == 'success') {
            /**
             * Si la imágen se guardó correctamente en el directorio entonces valído si es necesario actualizar registro en base de datos o insertar un nuevo registro
             */

            console.log('idImgProducto --->' + idImgProducto);
            console.log('typeof idImgProducto --->' + typeof(idImgProducto));

            if (idImgProducto == undefined || idImgProducto == 0 || idImgProducto == '0') {
                /**No existe registro para esta imágen en la base de datos entonces inserto */
                let nameImg = numero + '-' + orderImg + '.png';
                let formDataInsertImg = new FormData();
                formDataInsertImg.append('funcion', 'insertImgProducto');
                formDataInsertImg.append('numero', numero);
                formDataInsertImg.append('denom', denom);
                formDataInsertImg.append('nameImg', nameImg);
                formDataInsertImg.append('tipo', 'p');
                try {
                    const res = await fetch(URL_APP + 'php/backend/' + 'producto.php', {
                        method: 'POST',
                        body: formDataInsertImg
                    });
                    const data = await res.text();
                    console.log(data); // Aquí se obtiene el id de la imagen insertada, si viene -1 hubo un error en la inserción de imágen.

                    if (data != -1) {
                        // Hubo inserción correcta y devuelve el id correspondiente a la imagen insertada
                        document.getElementById('id-image-' + orderImg).dataset.idimage = data;
                        let idImgProducto = document.getElementById('id-image-' + orderImg).dataset.idimage;
                        console.log('ID IMAGEN INSERTADA ' + idImgProducto);
                    } else {
                        console.log('DATA ES -1');
                    }
                } catch (error) {
                    console.log(error);
                }
            } else {
                /**Existe registro en la base de datos para esta imagen entonces actualizo */
                let nameImg = numero + '-' + orderImg + '.png';
                let formDataUpdateImg = new FormData();
                formDataUpdateImg.append('funcion', 'updateImgProducto');
                formDataUpdateImg.append('numero', numero);
                formDataUpdateImg.append('denom', denom);
                formDataUpdateImg.append('nameImg', nameImg);
                formDataUpdateImg.append('tipo', 'p');
                formDataUpdateImg.append('idImgProducto', idImgProducto);
                try {
                    const res = await fetch(URL_APP + 'php/backend/' + 'producto.php', {
                        method: 'POST',
                        body: formDataUpdateImg
                    });
                    const data = await res.text();
                    console.log(data);
                } catch (error) {
                    console.log(error);
                }
            }
        }
    } catch (error) {
        console.log(error);
    }
}
//#endregion
// **************************************************************************************************************

const updateDataProduct = async (denom, descrip, idEstadoProducto, typeDiscountSelected, bonfija, precioFinal, pres1, pres2, pres3, pres4, stoweb) => {
    let numero = getParameterByName('num');

    let formData = new FormData();
    formData.append('funcion', 'updateDataProduct');
    formData.append('numero', numero);
    formData.append('denom', denom);
    formData.append('descrip', descrip);
    formData.append('idEstadoProducto', idEstadoProducto);
    formData.append('typeDiscountSelected', typeDiscountSelected);
    formData.append('bonfija', bonfija);
    formData.append('precioFinal', precioFinal);
    formData.append('pres1', pres1);
    formData.append('pres2', pres2);
    formData.append('pres3', pres3);
    formData.append('pres4', pres4);
    formData.append('stoweb', stoweb);

    try {
        const res = await fetch(URL_APP + 'php/backend/' + 'producto.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.text();
        console.log(data);
        if (data == 'ss1') {
            showModal('success', 'Registrado', 'El producto fue registrado correctamente').then(data => {
                window.location.href = `${URL_APP}/admin/product-list`;
            })
        }
    } catch (error) {
        console.log(error);
    }
}

document.getElementById('form-producto').addEventListener('submit', e => e.preventDefault())