'use strict';

// function selectBranche(element){
//     // console.log(element.text);
//     // console.log(element.id);
//     setSDBrancheOfficeSelected(element.id, element.text);
// }

function qtyUp(numero) {
    let actualyAmount = document.getElementById('id-span-cantidad-' + numero).value;
    console.log('actualyAmount ' + actualyAmount);

    let updatedAmount = parseInt(actualyAmount) + 1;
    console.log('updatedAmount ' + updatedAmount);

    document.getElementById('id-span-cantidad-' + numero).value = updatedAmount;
}

function qtyDown(numero) {
    let actualyAmount = document.getElementById('id-span-cantidad-' + numero).value;
    console.log('actualyAmount ' + parseInt(actualyAmount));

    let updatedAmount = parseInt(actualyAmount) - 1;
    if (updatedAmount < 1) {
        updatedAmount = 1;
    }

    console.log('updatedAmount ' + updatedAmount);

    document.getElementById('id-span-cantidad-' + numero).value = updatedAmount;
}