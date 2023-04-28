<!-- Para funcioanr se debe hacer uso de: <link rel="stylesheet" href="css/sweet-alert.css"> -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function showPopupLoading(type, title, tipoTransaccion, message, background, time) {
        let timerInterval
        Swal.fire({
            icon: type,
            title: title,
            // html: '<b>' + tipoTransaccion + '</b>. ' + message,
            html: message,
            background: background,
            icon: 'info',
            timer: time, // 10000,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
                // const b = Swal.getHtmlContainer().querySelector('b');
                timerInterval = setInterval(() => {
                    // b.textContent = Swal.getTimerLeft();
                }, 100);
            },
            willClose: () => {
                clearInterval(timerInterval)
            }
        }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
                // console.log('I was closed by the timer')
            }
        });
    }

    function showModal(type, title, message, background) {
        return Swal.fire({
            title: '<strong>' + title + '</strong>',
            icon: type, // 'info',
            // html: 'You can use <b>bold text</b>, ' +
            //     '<a href="//sweetalert2.github.io">links</a> ' +
            //     'and other HTML tags',
            html: '<p>' + message + '</p>',
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: true,
            background: background,
            // confirmButtonText: '<i class="fa fa-thumbs-up"></i> Great!',
            confirmButtonText: '<i class="fa fa-thumbs-up"></i> Entendido!',
            confirmButtonColor: '#3085d6',
            keydownListenerCapture: true //?   Opcion que perimite si hay un modal abierto que no cierre el modal con esc (Compatibilidad con bootstrap modals)
            // allowEscapeKey: false,
            // confirmButtonAriaLabel: 'Entendido!',
            // cancelButtonText: '<i class="fa fa-thumbs-down"></i>',
            // cancelButtonAriaLabel: 'Thumbs down'
        });
    };

    function showAlertToast(typeIcon, txtTitle, duration) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: duration,
            timerProgressBar: true,
            customClass: {
                popup: 'colored-toast'
            },
            iconColor: 'white',
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        Toast.fire({
            icon: typeIcon,
            title: txtTitle,
            // html: '<b>' + 'LALALA' + '</b> los datos en el sistema.',
        });
    }

    function showToastWithImage(title, urlImg) {
        Swal.fire({
            title: title,
            // text: 'Modal with a custom image.',
            imageUrl: urlImg,
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        })
    }
    
    /**
     * @desc    Lanza un pop-up de confirmación
     * 
     * @param   text {string} =>    Texto que desea mostrar
     * 
     * @return  Devuelve un objeto con propiedad .isConfirmed que devuelve true o false
     */
    const   confirmationModal = async (text, confirm = 'Aceptar', cancel = 'Cancelar') => {
        const value = await Swal.fire({
            title: text,
            icon:'warning',
            confirmButtonText: confirm,
            confirmButtonColor: '#0275d8',
            showCancelButton: true,
            cancelButtonText: cancel,
            cancelButtonColor: '#d9534f',
        });
        return value;
    }

    // function showAlertInfo(title, text, icon) {
    //     let timerInterval
    //     Swal.fire({
    //         title: title,
    //         html: text,
    //         background: '', // Color background
    //         icon: icon,
    //         timer: 10000,
    //         timerProgressBar: true,
    //         didOpen: () => {
    //             Swal.showLoading()
    //             // const b = Swal.getHtmlContainer().querySelector('b');
    //             timerInterval = setInterval(() => {
    //                 // b.textContent = Swal.getTimerLeft();
    //             }, 100);
    //         },
    //         willClose: () => {
    //             clearInterval(timerInterval)
    //         }
    //     }).then((result) => {
    //         /* Read more about handling dismissals below */
    //         if (result.dismiss === Swal.DismissReason.timer) {
    //             // console.log('I was closed by the timer')
    //         }
    //     });
    // }
</script>

<?php
// https://sweetalert2.github.io/#examples
// Popup window position: 'top', 'top-start', 'top-end', 'center', 'center-start', 'center-end', 'bottom', 'bottom-start', 'bottom-end'.
?>