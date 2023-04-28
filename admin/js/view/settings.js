'use strict';
//#region Variables
//#region TAB => General
const formGeneral = document.getElementById('settings_general_form'),
    buttonGeneral = document.getElementById('settings_general_button-tab');

const inputTittlePest = document.getElementById('idInputTittlePest'),
    inputNameEmpres = document.getElementById('idInputNameEmpres'),
    textAreaDescEmpres = document.getElementById('idTextAreaDescEmpres'),
    inputRazonSocial = document.getElementById('idInputRazonEmpres'),
    inputFacebook = document.getElementById('idInputUrlFacebook'),
    inputInstagram = document.getElementById('idInputUrlInstagram'),
    inputTwitter = document.getElementById('idInputUrlTwitter'),
    inputYoutube = document.getElementById('idInputUrlYoutube');
//#endregion
//#region TAB => Tienda
const formTienda = document.getElementById('settings_store_form'),
    buttonTienda = document.getElementById('settings_store_button-tab');

const inputCostoEnvio = document.getElementById('idInputCostoEnvio'),
    badgeCostoEnvio = document.getElementById('idBadgeCostoEnvio'),
    inputTopeEnvio = document.getElementById('idInputTopeEnvio'),
    badgeTopeEnvio = document.getElementById('idBadgeTopeEnvio'),
    inputDescuentoGeneral = document.getElementById('idInputDescuentoGeneral'),
    badgeDescuentoGeneral = document.getElementById('idBadgeDescuentoGeneral'),
    selectCalendarioEnvio = document.getElementById('idSelectCalendarioEnvio'),
    selectContarEspeciales = document.getElementById('idSelectContarEspeciales');

//#endregion
//#region TAB => Cobros
const formCobros = document.getElementById('settings_cobros_form'),
    buttonCobros = document.getElementById('settings_cobros_button-tab');

const inputTokenMP = document.getElementById('idInputTokenMp'),
    inputKeyMP = document.getElementById('idInputKeyMp'),
    inputRecargoMP = document.getElementById('idInputRecargoMp'),
    badgeRecargoMP = document.getElementById('idBadgeRecargoMp'),
    inputTransferenciaCBU = document.getElementById('idInputTransferenciaCbu'),
    inputTrasnferenciaALIAS = document.getElementById('idInputTransferenciaAlias');
//#endregion
//#region TAB => Productos
const formProductos = document.getElementById('settings_products_form'),
    btnAddState = document.getElementById('btn_add_state');

const inputName = document.getElementById('input_nombre_estado'),
    selectColorState = document.getElementById('select_color_estado'),
    badgeColorState = document.getElementById('badge_color'),
    textareaDescState = document.getElementById('textarea_descripcion_estado');

let tablaEstados = $('#states_table').DataTable({
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
    "searching": false,
    paging: false,
    info: false,
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

let productStateSelectedData = '';

//#endregion
//#endregion
//#region Set input Data
window.onload = e => {
    setGeneralData();
}
buttonGeneral.addEventListener('click', e => {
    setGeneralData();
    removeValidations();
    inputTittlePest.focus();
});
buttonTienda.addEventListener('click', e => {
    setStoreData();
    removeValidations();
    inputCostoEnvio.focus();
});
buttonCobros.addEventListener('click', e => {
    setCobroData();
    removeValidations();
    inputTokenMP.focus();
});
//#endregion
//#region Get input Data
/**
 * 
 * @param {STring} key Clave de la tabla configuraciones
 * @returns valor del registro
 */
const getConfig = async (key) => {
    const formData = new FormData();
    formData.append('funcion', key);
    try {
        const res = await fetch(URL_APP + 'php/backend/' + 'empres-config.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.text();
        console.log(data);
        return data ?? null;
    } catch (error) {
        console.log(error);
    }
}
const getFormPag = async (id) => {
    const formData = new FormData();
    formData.append('funcion', 'getRecargo');
    formData.append('id', id);
    try {
        const res = await fetch(URL_APP + 'php/backend/' + 'forpag.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.text();
        console.log(data);
        return data ?? null;
    } catch (error) {
        console.log(error);
    }
}
async function setGeneralData() {
    showPopupLoading('info', 'Cargando datos...');
    inputTittlePest.value = await getConfig('getTittlePest');
    inputNameEmpres.value = await getConfig('getNameEmpres');
    textAreaDescEmpres.value = await getConfig('getDescEmpres');
    inputRazonSocial.value = await getConfig('getRazonSocial');

    inputFacebook.value = await getConfig('getUrlFace');
    inputInstagram.value = await getConfig('getUrlInsta');
    inputTwitter.value = await getConfig('getUrlTwi');
    inputYoutube.value = await getConfig('getUrlYout');
    Swal.close();
}
async function setStoreData() {
    showPopupLoading('info', 'Cargando datos...');
    inputCostoEnvio.value = await getConfig('getCostoEnvio');
    badgeCostoEnvio.innerText = `$ ${await setFormatoMoneda(inputCostoEnvio.value)}`;
    inputTopeEnvio.value = await getConfig('getTopeEnvio');
    badgeTopeEnvio.innerText = `$ ${await setFormatoMoneda(inputTopeEnvio.value)}`;
    inputDescuentoGeneral.value = await getConfig('getDescuentoGeneral');
    badgeDescuentoGeneral.innerText = `${await setFormatoMoneda(inputDescuentoGeneral.value)} %`;
    selectCalendarioEnvio.value = await getConfig('getFlagCalendarioEnvio') == 'true' ? 1 : 0;
    selectContarEspeciales.value = await getConfig('getFlagContarEspeciales') == 'true' ? 1 : 0;
    Swal.close();
}
async function setCobroData() {
    showPopupLoading('info', 'Cargando datos...');
    inputTokenMP.value = await getConfig('getAccessTokenMP');
    inputKeyMP.value = await getConfig('getPublicKeyMP');
    inputRecargoMP.value = await getFormPag(3);
    badgeRecargoMP.innerText = `${await setFormatoMoneda(inputRecargoMP.value)} %`;
    inputTransferenciaCBU.value = await getConfig('getTrasnferenciaCBU');
    inputTrasnferenciaALIAS.value = await getConfig('getTrasnferenciaALIAS');
    Swal.close();
}
//#endregion
//#region Validaciones
//#region TAB => General
//#endregion
//#region TAB => Tienda
inputCostoEnvio.addEventListener('input', e => {
    let value = 0;
    if (e.target.value.trim() != '') {
        value = setFormatoMoneda(e.target.value);
    }
    badgeCostoEnvio.innerText = `$ ${value}`;
})
inputTopeEnvio.addEventListener('input', e => {
    let value = 0;
    if (e.target.value.trim() != '') {
        value = setFormatoMoneda(e.target.value);
    }
    badgeTopeEnvio.innerText = `$ ${value}`;
})
inputDescuentoGeneral.addEventListener('input', e => {
    let value = 0;
    if (e.target.value.trim() != '') {
        value = setFormatoMoneda(e.target.value);
    }
    badgeDescuentoGeneral.innerText = `${value} %`;
})
//#endregion
//#region TAB => Cobros
inputRecargoMP.addEventListener('input', e => {
    let value = 0;
    if (e.target.value.trim() != '') {
        value = setFormatoMoneda(e.target.value);
    }
    badgeRecargoMP.innerText = `${value} %`;
})
inputTrasnferenciaALIAS.addEventListener('input', e => {
    e.target.value = e.target.value.toUpperCase();
})
//#endregion
//#region TAB => Productos
inputName.addEventListener('input', e => {
    if (e.target.value.trim() != '') {
        badgeColorState.innerText = e.target.value;
    } else {
        badgeColorState.innerText = "";
        if (textareaDescState.value.trim() == '') {
            btnAddState.dataset.type = 'insert';
            setTypeButtonStateProducts();
            productStateSelectedData = '';
        }
    }
})
textareaDescState.addEventListener('input', e => {
    if (e.target.value.trim() == '' && inputName.value.trim() == '') {
        btnAddState.dataset.type = 'insert';
        setTypeButtonStateProducts();
        productStateSelectedData = '';
    }
})
selectColorState.addEventListener('change', e => {
    badgeColorState.className = "text-white p-2 badge badge-" + e.target.value;
})
$('#states_table').on('click', 'td', function () {
    const { row, ...a } = tablaEstados.cell(this).index();
    const [name, descripcion, ...b] = tablaEstados.row(row).data();

    const td = tablaEstados.cell(row, 0).node();
    productStateSelectedData = {
        row: row,
        id: td.dataset.id
    };

    inputName.value = name;
    textareaDescState.value = descripcion;
    selectColorState.value = td.dataset.color;
    badgeColorState.innerText = name;
    badgeColorState.className = "text-white p-2 badge badge-" + td.dataset.color;
    btnAddState.dataset.type = 'update';
    setTypeButtonStateProducts();
})
const setTypeButtonStateProducts = () => {
    const span = document.createElement('span');
    btnAddState.innerHTML = '';
    if (btnAddState.dataset.type == 'insert') {
        const icon = document.createElement('i');
        icon.className = "fa fa-plus";
        span.innerText = 'Agregar';
        btnAddState.appendChild(icon);
        btnAddState.appendChild(span);
        btnAddState.classList.replace('btn-danger', 'btn-primary');
    } else {
        const icon = document.createElement('i');
        icon.className = "fa-solid fa-pen-to-square";
        span.innerText = 'Modificar';
        btnAddState.appendChild(icon);
        btnAddState.appendChild(span);
        btnAddState.classList.replace('btn-primary', 'btn-danger');
    }
}
//#endregion
/**
 * 
 * @param {element} input Elemento input
 * @param {Bool} validation Condicion a evaluar
 * 
 * @returns Si cumple la condicion agrega clases de validez, en caso contraro agrega clases de invalidez
 */
const validateInput = (input, condition) => {
    if (condition) {
        input.classList.add('is-valid');
        input.classList.add('border-success');
        input.classList.remove('is-invalid');
        input.classList.remove('border-danger');
    } else {
        input.classList.remove('is-valid');
        input.classList.remove('border-success');
        input.classList.add('is-invalid');
        input.classList.add('border-danger');
    }
}

/**
 * Remueve los estilos de las validaciones realizadas sobre el input
 */
const removeValidations = () => {
    const inputs = document.getElementsByTagName('input');
    const textArea = document.getElementsByTagName('select');
    const selects = document.getElementsByTagName('textarea');

    for (let i = 0; i < inputs.length; i++) {
        inputs[i].classList.remove('is-valid');
        inputs[i].classList.remove('border-success');
        inputs[i].classList.remove('is-invalid');
        inputs[i].classList.remove('border-danger');
    }
    for (let i = 0; i < textArea.length; i++) {
        textArea[i].classList.remove('is-valid');
        textArea[i].classList.remove('border-success');
        textArea[i].classList.remove('is-invalid');
        textArea[i].classList.remove('border-danger');
    }
    for (let i = 0; i < selects.length; i++) {
        selects[i].classList.remove('is-valid');
        selects[i].classList.remove('border-success');
        selects[i].classList.remove('is-invalid');
        selects[i].classList.remove('border-danger');
    }
}
//#endregion
//#region Envío de formularios
formGeneral.addEventListener('submit', async e => {
    e.preventDefault();
    let validations = [];

    await updateEmpresConfig('titulo-pest', inputTittlePest.value.trim(), 1).then(data => {
        validateInput(inputTittlePest, data == 1);
        if (data != 1) validations.push(0);
    });
    await updateEmpresConfig('nombre-empres', inputNameEmpres.value.trim(), 1).then(data => {
        validateInput(inputNameEmpres, data == 1);
        if (data != 1) validations.push(0);
    });
    await updateEmpresConfig('descripcion-empres', textAreaDescEmpres.value.trim(), 1).then(data => {
        validateInput(textAreaDescEmpres, data == 1);
        if (data != 1) validations.push(0);
    });
    await updateEmpresConfig('razon-social', inputRazonSocial.value.trim(), 1).then(data => {
        validateInput(inputRazonSocial, data == 1);
        if (data != 1) validations.push(0);
    });
    await updateEmpresConfig('url-facebook-principal', inputFacebook.value.trim()).then(data => {
        validateInput(inputFacebook, data == 1);
        if (data != 1) validations.push(0);
    });
    await updateEmpresConfig('url-instagram-principal', inputInstagram.value.trim()).then(data => {
        validateInput(inputInstagram, data == 1);
        if (data != 1) validations.push(0);
    });
    await updateEmpresConfig('url-twitter-principal', inputTwitter.value.trim()).then(data => {
        validateInput(inputTwitter, data == 1);
        if (data != 1) validations.push(0);
    });
    await updateEmpresConfig('url-youtube-principal', inputYoutube.value.trim()).then(data => {
        validateInput(inputYoutube, data == 1);
        if (data != 1) validations.push(0);
    });

    if (validations.length > 0) {
        showModal('error', 'Datos inválidos', 'Algunos campos contienen errores. Reviselos y vuelva a intentar.<br> Los campos en verde han sido actualizados correctamente.');
    } else {
        showModal('success', 'Datos actualizados', 'Los campos han sido actualizados correctamente')
    }

});
formTienda.addEventListener('submit', async e => {
    e.preventDefault();
    let validations = [];

    await updateEmpresConfig('costo-envio', inputCostoEnvio.value.trim(), 1).then(data => {
        validateInput(inputCostoEnvio, data == 1);
        if (data != 1) validations.push(0);
    });
    await updateEmpresConfig('tope-envio-gratis', inputTopeEnvio.value.trim(), 1).then(data => {
        validateInput(inputTopeEnvio, data == 1);
        if (data != 1) validations.push(0);
    });
    await updateEmpresConfig('descuento-general', inputDescuentoGeneral.value.trim(), 1).then(data => {
        validateInput(inputDescuentoGeneral, data == 1);
        if (data != 1) validations.push(0);
    });
    await updateEmpresConfig('flag-calendario-envio', Boolean(parseInt(selectCalendarioEnvio.value))).then(data => {
        validateInput(selectCalendarioEnvio, data == 1);
        if (data != 1) validations.push(0);
    });
    await updateEmpresConfig('flag-contador-especiales', Boolean(parseInt(selectContarEspeciales.value))).then(data => {
        validateInput(selectContarEspeciales, data == 1);
        if (data != 1) validations.push(0);
    });
    if (validations.length > 0) {
        showModal('error', 'Datos inválidos', 'Algunos campos contienen errores. Reviselos y vuelva a intentar.<br> Los campos en verde han sido actualizados correctamente.');
    } else {
        showModal('success', 'Datos actualizados', 'Los campos han sido actualizados correctamente')
    }
});
formCobros.addEventListener('submit', async e => {
    e.preventDefault();
    let validations = [];

    await updateEmpresConfig('mp-access-token', inputTokenMP.value.trim(), 1).then(data => {
        validateInput(inputTokenMP, data == 1);
        if (data != 1) validations.push(0);
    });
    await updateEmpresConfig('mp-public-key', inputKeyMP.value.trim(), 1).then(data => {
        validateInput(inputKeyMP, data == 1);
        if (data != 1) validations.push(0);
    });
    await updateRecargo(3, inputRecargoMP.value.trim()).then(data => {
        validateInput(inputRecargoMP, data == 1);
        if (data != 1) validations.push(0);
    });
    await updateRecargo(2, inputRecargoMP.value.trim())
    // .then(data => {
    //     validateInput(inputRecargoMP, data == 1);
    //     if (data != 1) validations.push(0);
    // });
    await updateRecargo(1, inputRecargoMP.value.trim())
    // .then(data => {
    //     validateInput(inputRecargoMP, data == 1);
    //     if (data != 1) validations.push(0);
    // });
    await updateEmpresConfig('cbu', inputTransferenciaCBU.value.trim(), 1).then(data => {
        validateInput(inputTransferenciaCBU, data == 1);
        if (data != 1) validations.push(0);
    });
    await updateEmpresConfig('alias', inputTrasnferenciaALIAS.value.trim(), 1).then(data => {
        validateInput(inputTrasnferenciaALIAS, data == 1);
        if (data != 1) validations.push(0);
    });

    if (validations.length > 0) {
        showModal('error', 'Datos inválidos', 'Algunos campos contienen errores. Reviselos y vuelva a intentar.<br> Los campos en verde han sido actualizados correctamente.');
    } else {
        showModal('success', 'Datos actualizados', 'Los campos han sido actualizados correctamente')
    }
});
btnAddState.addEventListener('click', async e => {

    const formData = new FormData();

    formData.append('funcion', 'addOrUpdateProductState');
    formData.append('type', btnAddState.dataset.type + 'ProductState');
    formData.append('name', inputName.value.trim());
    formData.append('description', textareaDescState.value.trim());
    formData.append('color', selectColorState.value);
    if (btnAddState.dataset.type == 'update') {
        formData.append('id', productStateSelectedData.id);
    }

    try {
        const res = await fetch(URL_APP + 'php/backend/' + 'producto.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.json();
        console.log(data);
        if (data.status == 201) {
            if (formData.get('type') == 'updateProductState') {
                tablaEstados.row(productStateSelectedData.row).remove().draw();
            }
            let newRow = document.createElement('tr');
            newRow.className = "text-gray-400 fw-bold gs-0 even";
            newRow.innerHTML =
                `
                <td data-id="${data.data.id_estado}" data-color="${formData.get('color')}">${formData.get('name')}</td>
                <td class="px-2">${formData.get('description')}</td>
                <td class="text-center">
                    <span class="text-white badge badge-${formData.get('color')}">${formData.get('name')}</span>
                </td>
                <td class="text-center">
                    <span class="badge badge-light-${formData.get('color')}">${formData.get('name')}</span>
                </td>
            `;
            document.getElementById('states_table').getElementsByTagName('tbody')[0].appendChild(newRow);

            inputName.value = '';
            textareaDescState.value = '';
            setTypeButtonStateProducts();
            productStateSelectedData = '';
        }
    } catch (error) {
        console.log(error);
    }

});
    //#endregion