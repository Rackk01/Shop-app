'use strict';

function selectBranche(element) {
    // console.log(element.text);
    // console.log(element.id);
    setSDBrancheOfficeSelected(element.id, element.text);
}

// No lo uso actualmente
// const selectModalInit = async () => {
//     let formData = new FormData();
//     formData.append('funcion', 'getInfoModalInit');

//     try {
//         const res = await fetch(URL_APP + 'php/backend/' + 'modal-init.php', {
//             method: 'POST',
//             body: formData
//         });
//         const data = await res.text();
//         console.log(data);

//         return;

//         dataListCompleteBancos = data;
//         if (data['status'] == 411 || data['status'] == 410) {
//             // Error.
//             // setGoErrorPage();
//         }

//         // if (data == 'error') {} else {}
//         // console.log(JSON.stringify(data));
//         // let obj = JSON.parse(data);

//         data.forEach(element => {
//             // console.log(element);

//             // if (element.cdni.trim() != '') {
//             listItemsBancos.push(element.codigo.trim() + ' | ' + element.denom.trim());
//             // } else if (element.ccui.trim() != '') {
//             //     listItemsBancos.push(element.codigo.trim() + ' | ' + element.denom.trim());
//             // } else {
//             //     listItemsBancos.push(element.codigo.trim() + ' | ' + element.denom.trim());
//             // }
//         });

//     } catch (error) {
//         console.log(error);
//     }
// }

const setPageProductsIndex = async (num) => {
    let formData = new FormData();
    formData.append('funcion', 'setPageProductsIndex');
    formData.append('numPage', num);

    try {
        const res = await fetch(URL_APP + 'php/services/' + 'session.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.text();
        console.log(data);

        if (data == 'sf') {
            location.reload();
        }
    } catch (error) {
        console.log(error);
    }
}

function qtyUp(numero) {
    // let actualyAmount = document.getElementById('id-span-cantidad-' + numero).textContent;
    let actualyAmount = document.getElementById('id-span-cantidad-' + numero).value;
    console.log('actualyAmount ' + actualyAmount);

    let updatedAmount = parseInt(actualyAmount) + 1;
    console.log('updatedAmount ' + updatedAmount);

    // document.getElementById('id-span-cantidad-' + numero).textContent = updatedAmount;
    document.getElementById('id-span-cantidad-' + numero).value = updatedAmount;
}

function qtyDown(numero) {
    // let actualyAmount = document.getElementById('id-span-cantidad-' + numero).textContent;
    let actualyAmount = document.getElementById('id-span-cantidad-' + numero).value;
    console.log('actualyAmount ' + parseInt(actualyAmount));

    if (actualyAmount <= 1) {
        // console.log('No puede ser menor a 1');
        return;
    }

    let updatedAmount = parseInt(actualyAmount) - 1;
    console.log('updatedAmount ' + updatedAmount);

    // document.getElementById('id-span-cantidad-' + numero).textContent = updatedAmount;
    document.getElementById('id-span-cantidad-' + numero).value = updatedAmount;
}