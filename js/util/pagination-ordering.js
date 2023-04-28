/*
Contiene la lógica que utiliza la paginación y Orden correspondiente a los listados de las cards de los productos.
Se aplica en index, shop, shop-specials.
*/

// let bPreguntar = true;
// window.onbeforeunload = antesDeSalir;

// function antesDeSalir() {
//     // if (bPreguntar) {
//     //     return "¿Seguro que quieres salir?";
//     // }
//     console.log('saliendo');
//     setPageProductsIndex(-1); // Al ser -1 resetea la variable correspondiente.
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