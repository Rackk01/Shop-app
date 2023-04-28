//#region DOM elements
// const selectPaymentMethod = document.getElementById('select_payment_method');
// const selectShippingMethod = document.getElementById('select_shipping_method');
const selectOrderState = document.getElementById('select_order_state');

const textareaComment = document.getElementById('textarea_comment');
const btnAddComment = document.getElementById('btn_add_comment');
const commentsTable = document.getElementById('comments_table');
//#endregion

selectOrderState.addEventListener('change', async e => {

    let formData = new FormData();

    formData.append('funcion', 'updateOrderState');
    formData.append('nrocomp', getParameterByName('cod'));
    formData.append('id_estado', selectOrderState.value);

    try {
        const res = await fetch(URL_APP + 'php/backend/' + 'pedido.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.text();
        console.log(data);
        if (data == 'ss1') {
            selectOrderState.classList.add('is-valid');
            selectOrderState.classList.add('border-success');
            setTimeout(() => {
                selectOrderState.classList.remove('is-valid');
                selectOrderState.classList.remove('border-success');
            }, 3000)
            // showModal('success', 'Registrado', 'El combo fue registrado correctamente').then(data => {
            // window.location.href = `${URL_APP}/admin/combo-list`;
            // })
        }else{
            showModal('error', 'Error en registro', 'Hubo un error en cambiar el estado del pedido. Recargue la página y  vuelva a intentar.')
        }
    } catch (error) {
        console.log(error);
    }
});

btnAddComment.addEventListener('click', async e => {

    let formData = new FormData();

    formData.append('funcion', 'insertComment');
    formData.append('nrocomp', getParameterByName('cod'));
    formData.append('comment', textareaComment.value);

    try {
        const res = await fetch(URL_APP + 'php/backend/' + 'pedido.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.json();
        console.log(data);
        if (typeof(data) == 'object') {
            showAlertToast('success', 'Comentario agregado correctamente', 2500);

            fullDate = separateDayHour(data[0].hora);

            const tr = document.createElement('tr');

            const commentTd = document.createElement('td');
            commentTd.className = 'text-start pe-5';
            commentTd.innerText = data[0].comentario;
            const dateTd = document.createElement('td');
            const dateSpan = document.createElement('span');
            dateSpan.className = 'fw-bold ms-3';
            dateSpan.innerText = setDateFormat(fullDate.day);
            dateTd.className = 'text-end pe-5';
            dateTd.appendChild(dateSpan);

            tr.appendChild(commentTd);
            tr.appendChild(dateTd);

            const tbody = commentsTable.getElementsByTagName('tbody')[0];

            tbody.insertBefore(tr, tbody.firstChild);
            // commentsTable.getElementsByTagName('tbody')[0].appendChild(tr);

            textareaComment.value = '';
        }else{
            showModal('error', 'Error en registro', 'Hubo un error en registrar el comentario. Revise y vuelva a intentar.')
        }
    } catch (error) {
        console.log(error);
    }
});
