//#region Elementos del DOM
const formCombo = document.getElementById('form-combo');
const contenedorProductos = document.getElementById('contenedor-productos');
//#region Nav
const tabGeneral = document.getElementById('tab-general'),
    tabDetalle = document.getElementById('tab-detalle'),
    tabImagenes = document.getElementById('tab-imagenes');
//#endregion
//#region Aside
const inputPrecioBase = document.getElementById('input-precio-base'),
    selectDiscountPorcentaje = document.getElementById('id-select-discount-porcentaje'),
    radioFijo = document.getElementById('kt_ecommerce_add_product_discount_fixed1'),
    selectDiscountFijo = document.getElementById('id-select-discount-fijo'),
    radioPercent = document.getElementById('kt_ecommerce_add_product_discount_percentage1'),
    inputPercent = document.getElementById('kt_ecommerce_add_product_discount_label'),
    inputFijo = document.getElementById('input-fijo'),
    badgeMontoFijo = document.getElementById('badge-monto-fijo'),
    inputPrecioFinal = document.getElementById('input-precio-final');
//#endregion
//#region Tab => General
// const inputCodigo = document.getElementById('input-codigo-combo'),
const inputNombre = document.getElementById('input-nombre-combo'),
    textAreaDescripcion = document.getElementById('textarea-descripcion-combo'),
    inputVencimiento = document.getElementById('kt_ecommerce_add_product_status_datepicker'),
    inputStock = document.getElementById('input-stock-combo'),
    inputStockActualizado = document.getElementById('input-stock-combo-act');
//#endregion
//#region Tab => Detalle
const inputProducto = document.getElementById('input-producto'),
    inputCantidad = document.getElementById('input-cantidad'),
    selectPresentacion = document.getElementById('select-presentacion');

const btnAddProduct = document.getElementById('button-add-product');
//#endregion
//#region Tab => Img
const inputImagePrincipal = document.getElementById('id-image-principal'),
    divImgPrincipal = document.getElementById('div-img-principal'),
    inputImage2 = document.getElementById('id-image-2'),
    divImg2 = document.getElementById('div-img-2'),
    inputImage3 = document.getElementById('id-image-3'),
    divImg3 = document.getElementById('div-img-3'),
    btnRemoveImg3 = document.getElementById('remove-img-3');
//#endregion
//#endregion
//#region Variables
let productosCombo = [];

let precioBase = 0;
let precioFinal = 0;
let descuento = 0;

let allProductos = '';
let textProductos = [];
let productoSeleccionado = '';
let presentacionesProducto = '';

let images_combos = ['', '', ''];

const URL_IMAGE_PROD = `${URL_APP}src/img/productos/`;
const URL_IMAGE_COM = `${URL_APP}src/img/combos/`;

//#endregion
//#region Funciones
const createProductCard = async (parent, id, name, price, imgUrl, cat, cantidad, pres = '', codpres) => {

    const container = document.createElement('div');
    let urlImagen = await file_exists(imgUrl) ? imgUrl : `${URL_IMAGE_PROD}/default.jpg`;

    let presentacion = pres == '' ? 'Unidad' : `${pres} Kg`;

    container.innerHTML =
        `
        <div id="card-producto-${id}-${codpres}" class="card card-flush py-4 m-2" style="max-width: 300px;">
            <div class="card-header">
                <div class="card-title overflow-hidden" style="height: 80px; white-space: nowrap; text-overflow: ellipsis;">
                    <h2>${name}</h2>
                </div>
            </div>
            <div class="card-body text-center pt-0">
                <img class="default-img border-radius-10" src="${urlImagen}" alt=""/>
                <div class="d-flex justify-content-between my-2">
                    <span class="text-gray-800">${cat}</span>
                    <span class="text-gray-800">Cód ${id}</span>
                </div>
                <div class="d-flex justify-content-center lh-sm p-2" style="min-height: 40px;">
                    <span class="align-self-start fs-2 mx-2">$</span>
                    <span class="fs-2x fw-semibold price-card">${setFormatoMoneda(price)}</span>
                </div>
                <div class="d-flex align-items-center justify-content-center py-2">
                    <span class="badge badge-info">${presentacion}</span>
                </div>
                <div class="d-flex align-items-center justify-content-around py-2">
                    <div>
                        <span>Cantidad:</span>
                    </div>
                    <div>
                        <span class="fs-2x fw-semibold units-card">${cantidad}</span>
                        <span class="mx-2">Unid.</span>
                    </div>
                </div>
                <div>
                    <button type="button" onclick="deleteCard('card-producto-${id}-${codpres}')" class="btn btn-danger w-100">Eliminar</button>
                </div>
            </div>
        </div>
    `;

    parent.appendChild(container);

    updateFinalPrice();
}
const deleteCard = (id) => {
    confirmationModal('Desea eliminar el producto?', 'Si', 'No').then(data => {
        if (data.isConfirmed) {
            document.getElementById(id).remove();
            console.log(productosCombo);
            console.log(id.split('-')[2].trim())
            console.log(id.split('-')[3].trim())
            productosCombo = productosCombo.filter(producto => {return (producto.id != id.split('-')[2].trim() || producto.codpres != id.split('-')[3].trim())});
            console.log(productosCombo);
            updateFinalPrice();
        }
    })
}
const updateFinalPrice = () => {
    updateBasePrice();
    updateDiscount();
    precioFinal = precioBase - descuento;
    inputPrecioFinal.value = `$ ${setFormatoMoneda(precioFinal)}`;
}
const updateBasePrice = () => {
    precioBase = 0;
    for (const producto of productosCombo) {
        precioBase += parseFloat(producto.precio) * parseInt(producto.cantidad);
        // console.log(precioBase);
    }
    inputPrecioBase.value = `$ ${setFormatoMoneda(precioBase)}`;
}
const updateDiscount = () => {
    if(radioPercent.checked){
        let porcentaje = parseFloat(inputPercent.innerText.trim());
        descuento = precioBase * porcentaje / 100;
    }
}
const agregarProductCard = ({ numero: codigo, denom: nombre, prefin: precio, url: img, concepto: cat }, cantidad, { codpres: codpres, pesopres: pres, precio_final_por_presentacion_sin_bonifi: precioPres }) => {
    if (codigo == '') return;


    let prod = {
        id: parseInt(codigo),
        // precio: parseFloat(precio),
        url: img,
        // codpres: codpres,
        // pres: pres,
        cantidad: parseInt(cantidad)
    }

    if (!codpres) {
        prod.codpres = 0;
        prod.precio = precio;
    } else {
        prod.codpres = codpres;
        prod.pres = pres;
        prod.precio = precioPres;
    }

    productosCombo.push(prod);
    console.log(productosCombo)

    createProductCard(contenedorProductos, prod.id, nombre, prod.precio, `${URL_IMAGE_PROD}${img}`, cat, prod.cantidad, prod.pres, prod.codpres);

    // if (radioPercent.checked) {
    //     updatePercentDiscount();
    // } else {
    //     updateFinalPrice();
    // }

}
// const deleteImage = (id) => {
//     images_combos = images_combos.filter(image => image.id != id);
//     console.log(images_combos);
// }
//#endregion

//#region Inicialización
const getComboData = async (id) => {
    if (id.trim() == '') {
        return;
    }

    const formData = new FormData();
    formData.append('funcion', 'getOneComboOfCod');
    formData.append('id', id);

    try {
        const res = await fetch(URL_APP + 'php/backend/' + 'combo.php', {
            method: 'POST',
            body: formData
        });
        const data = (await res.json())[0];
        console.log(data);

        // inputCodigo.value = id.trim();
        inputNombre.value = data.denom.trim();
        textAreaDescripcion.value = data.denom1.trim();

        inputVencimiento.value = data.fecvenci;
        inputStock.value = parseInt(data.stoini);
        inputStockActualizado.value = parseInt(data.stoact);

        precioBase = parseFloat(data.pretot);
        inputPrecioBase.value = `$ ${setFormatoMoneda(data.pretot)}`;

        const punteroSliderDescuentoProcentaje = document.querySelector('.noUi-handle');

        if (data['tipobonifi'].toLowerCase().trim() == 'f') {
            // id-seelct-discount-fijo
            selectDiscountFijo.classList.add("active");
            selectDiscountPorcentaje.classList.remove("active");

            radioFijo.checked = true;
            radioPercent.checked = false;

            document.getElementById('kt_ecommerce_add_product_discount_percentage').classList.add('d-none');
            document.getElementById('kt_ecommerce_add_product_discount_fixed').classList.remove('d-none');

            if (data['bonifi'] > 0) {
                precioFinal = parseFloat(data['prefin']);
                descuento = parseFloat(data['bonifi']);

                inputFijo.value = descuento;
                badgeMontoFijo.innerText = `$ ${setFormatoMoneda(inputFijo.value)}`
                inputPrecioFinal.value = '$ ' + setFormatoMoneda(precioFinal);
                // updateEndPriceFixedDiscount();
            }

        } else if (data['tipobonifi'].toLowerCase().trim() == 'p') {
            // id-seelct-discount-porcentaje
            selectDiscountFijo.classList.remove("active");
            selectDiscountPorcentaje.classList.add("active");

            radioFijo.checked = false;
            radioPercent.checked = true;

            document.getElementById('kt_ecommerce_add_product_discount_percentage').classList.remove('d-none');
            document.getElementById('kt_ecommerce_add_product_discount_fixed').classList.add('d-none');

            if (data['bonifi'] > 0) {
                punteroSliderDescuentoProcentaje.setAttribute('aria-valuenow', data['bonifi']);
                punteroSliderDescuentoProcentaje.setAttribute('aria-valuetext', data['bonifi']);
                inputPercent.innerText = parseInt(data['bonifi']);

                descuento = parseFloat(data['pretot']) * (parseInt(data['bonifi']) / 100);
                precioFinal = parseFloat(data['prefin']);
                console.log(descuento)
                console.log(precioFinal)

                inputPrecioFinal.value = '$ ' + setFormatoMoneda(precioFinal);
            }
        }

    } catch (error) {
        console.log(error);
    }

};
getComboData(getParameterByName('num'));
const getComboProductos = async (id) => {
    if (id.trim() == '') {
        return;
    }

    const formData = new FormData();
    formData.append('funcion', 'getAllProductsOfCombo');
    formData.append('id', id);

    try {
        const res = await fetch(URL_APP + 'php/backend/' + 'combo.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.json();
        console.log(data);

        for (const producto of data) {
            let prod = {
                id: parseInt(producto.numero),
                precio: parseFloat(producto.prefin),
                url: producto.url,
                codpres: producto.codpresprod,
                pres: producto.pesopres,
                cantidad: parseInt(producto.cantidad),
                cod: parseInt(producto.id)
            }
            productosCombo.push(prod);
            console.log(prod)
            createProductCard(contenedorProductos, prod.id, producto.denom, prod.precio, `${URL_IMAGE_PROD}${prod.url}`, producto.cat, prod.cantidad, prod.pres, prod.codpres)
        }
    } catch (error) {
        console.log(error);
    }
};
getComboProductos(getParameterByName('num'));
const getAllProducts = async () => {

    const formData = new FormData();
    formData.append('funcion', 'getAllProducts');

    try {
        const res = await fetch(URL_APP + 'php/backend/' + 'producto.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.json();
        // console.log(data);
        allProductos = data;
        for (const producto of allProductos) {
            textProductos.push(`${producto.numero} | ${producto.denom.trim()}`);
        }

    } catch (error) {
        console.log(error);
    }
}
getAllProducts();
$("#input-producto").autocomplete({
    //source: items, // value.nombre
    minLength: 1, //Comienza a filtrar a partir de 2 caracteres
    source: function (request, response) { //Limito la cantidad de registros a mostrar el la lista desplegable
        var results = $.ui.autocomplete.filter(textProductos, request.term);
        response(results.slice(0, 10));
    },
    select: function (event, item) {
        console.log(item.item.value);
        productoSeleccionado = allProductos.find(producto => producto.numero == item.item.value.split('|')[0].trim());

        getAllPres(productoSeleccionado.numero);
    }
});
const getAllPres = async (id) => {

    const formData = new FormData();
    formData.append('funcion', 'getAllPresOfProduct');
    formData.append('numero', id);

    try {
        const res = await fetch(URL_APP + 'php/backend/' + 'producto.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.json();

        presentacionesProducto = data;
        console.log(presentacionesProducto)

        if (data === 0) {
            const option = document.createElement('option');

            option.value = 1;
            option.text = 'Unidades';

            selectPresentacion.appendChild(option);
            return;
        }

        for (const pres of presentacionesProducto) {
            const option = document.createElement('option');

            option.value = pres.codpres;
            option.text = `${pres.pesopres} ${pres.denom}`;

            selectPresentacion.appendChild(option);
        }
        selectPresentacion.selectedIndex = 0;

    } catch (error) {
        console.log(error);
    }
}
const getAllComboImg = async (id) => {
    if (id.trim() == '') {
        divImgPrincipal.style.backgroundImage = `url(${URL_IMAGE_COM}default.jpg)`;
        divImg2.style.backgroundImage = `url(${URL_IMAGE_COM}default.jpg)`;
        divImg3.style.backgroundImage = `url(${URL_IMAGE_COM}default.jpg)`;
        return;
    }

    // console.log(file_exists(`${URL_IMAGE_COM}${id}_1.png`))
    if(await file_exists(`${URL_IMAGE_COM}${id}_1.png`)){
        divImgPrincipal.style.backgroundImage = `url(${URL_IMAGE_COM}${id}_1.png)`;
    }else{
        divImgPrincipal.style.backgroundImage = `url(${URL_IMAGE_COM}default.jpg)`;
    }

    // console.log(file_exists(`${URL_IMAGE_COM}${id}_2.png`))
    if(await file_exists(`${URL_IMAGE_COM}${id}_2.png`)){
        divImg2.style.backgroundImage = `url(${URL_IMAGE_COM}${id}_2.png)`;
    }else{
        divImg2.style.backgroundImage = `url(${URL_IMAGE_COM}default.jpg)`;
    }

    // console.log(file_exists(`${URL_IMAGE_COM}${id}_3.png`))
    if(await file_exists(`${URL_IMAGE_COM}${id}_3.png`)){
        divImg3.style.backgroundImage = `url(${URL_IMAGE_COM}${id}_3.png)`;
    }else{
        divImg3.style.backgroundImage = `url(${URL_IMAGE_COM}default.jpg)`;
    }

    // const formData = new FormData();
    // formData.append('funcion', 'getAllImgsOfOneCombo');
    // formData.append('numero', id);

    // try {
    //     const res = await fetch(URL_APP + 'php/backend/' + 'combo.php', {
    //         method: 'POST',
    //         body: formData
    //     });
    //     const data = await res.json();

    //     console.log(data);
    //     // return;

    //     const img_principal = data.find(e => e.principal == 't');
    //     const [img2 = { url: 'default.jpg' }, img3 = { url: 'default.jpg' }] = data.filter(e => e.principal != 't');

    //     divImgPrincipal.style.backgroundImage = `url(${URL_IMAGE_COM}${img_principal.url})`;
    //     divImg2.style.backgroundImage = `url(${URL_IMAGE_COM}${img2.url})`;
    //     divImg3.style.backgroundImage = `url(${URL_IMAGE_COM}${img3.url})`;

    // } catch (error) {
    //     console.log(error);
    // }
}
getAllComboImg(getParameterByName('num'));
//#endregion
//#region Detección de barra de porcentaje
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
                updateFinalPrice();
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
//#endregion

//#region Input Events
inputFijo.addEventListener('input', e => {
    if (e.target.value != '') {
        descuento = parseFloat(e.target.value);
    }
    badgeMontoFijo.innerText = `$ ${setFormatoMoneda(descuento)}`;
    updateFinalPrice();
});
selectDiscountPorcentaje.addEventListener('change', e => {
    if (precioBase != 0) {
        inputPercent.innerText = parseInt(descuento * 100 / precioBase);
    }
    updateFinalPrice();
})
selectDiscountFijo.addEventListener('change', e => {
    inputFijo.value = round(descuento, 2);
    badgeMontoFijo.innerText = `$ ${setFormatoMoneda(descuento)}`;
})
inputStock.addEventListener('blur', e => {
    if(getParameterByName('num') == ''){
        inputStockActualizado.value = inputStock.value;
    }
})
inputImagePrincipal.onchange = function () {
    // console.log(inputImagePrincipal.files);
    let file_data = inputImagePrincipal.files[0];
    images_combos[0]= file_data;
    console.log(images_combos)
    // console.log(file_data);
}
inputImage2.onchange = function () {
    // console.log(inputImage2.files);
    let file_data = inputImage2.files[0];
    images_combos[1]= file_data;
    console.log(images_combos)
}
inputImage3.onchange = function () {
    // console.log(inputImage3.files);
    let file_data = inputImage3.files[0];
    images_combos[2]= file_data;
    console.log(images_combos)
}

//#endregion

btnAddProduct.addEventListener('click', e => {
    let presentacionSeleccionada = presentacionesProducto != '' ? presentacionesProducto.find(e => e.codpres == selectPresentacion.value) : '';
    agregarProductCard(productoSeleccionado, inputCantidad.value, presentacionSeleccionada);
    inputProducto.value = '';
    inputCantidad.value = '';
    selectPresentacion.innerHTML = '';
});

formCombo.addEventListener('submit', async e => {
    e.preventDefault();

    updateFinalPrice();

    showPopupLoading('info', 'Guardando cambios');

    //#region Validaciones
    if(inputNombre.value.trim() == ''){
        showModal('error', 'Dato inválido', 'Debe ingresar un nombre de combo.').then(data => {
            inputNombre.focus();
        })
        return;
    }
    if(inputStock.value.trim() == ''){
        showModal('error', 'Dato inválido', 'Debe ingresar el stock del combo.').then(data => {
            inputStock.focus();
        })
        return;
    }
    if(inputStockActualizado.value.trim() == ''){
        showModal('error', 'Dato inválido', 'Debe ingresar el stock del combo.').then(data => {
            inputStockActualizado.focus();
        })
        return;
    }
    if(inputVencimiento.value.trim() == ''){
        showModal('error', 'Dato inválido', 'Debe ingresar la fecha de vencimiento del combo.').then(data => {
            inputVencimiento.focus();
        })
        return;
    }
    if(productosCombo.length < 1){
        showModal('error', 'Faltan productos', 'Debe ingresar productos al combo.')
        return;
    }
    //#endregion

    let formData = new FormData();

    formData.append('funcion', 'newUpdateCombo');
    formData.append('numero', getParameterByName('num'));
    formData.append('denom', inputNombre.value.trim());
    formData.append('descrip', textAreaDescripcion.value.trim());
    formData.append('vencimiento', setDateFormatIso(inputVencimiento.value.replaceAll('-', '/')));
    formData.append('stock', inputStock.value);
    formData.append('stockAct', inputStockActualizado.value);
    formData.append('pBase', monedaToFloat(inputPrecioBase.value.replace('$', '').trim()));
    formData.append('pFinal', monedaToFloat(inputPrecioFinal.value.replace('$', '').trim()));

    if (radioFijo.checked) {
        formData.append('bonificacion', inputFijo.value);
        formData.append('tipoBonificacion', 'f');
    } else {
        formData.append('bonificacion', inputPercent.innerText.trim());
        formData.append('tipoBonificacion', 'p');
    }
    formData.append('productos', JSON.stringify(productosCombo));
    formData.append('file_principal', images_combos[0]);
    formData.append('file_secundaria', images_combos[1]);
    formData.append('file_terciaria', images_combos[2]);

    try {
        const res = await fetch(URL_APP + 'php/backend/' + 'combo.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.text();
        console.log(data);
        if (data == 'ss1') {
            showModal('success', 'Registrado', 'El combo fue registrado correctamente').then(data => {
                window.location.href = `${URL_APP}/admin/combo-list`;
            })
        }
    } catch (error) {
        console.log(error);
    }
});