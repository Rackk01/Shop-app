<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="css/flatpickr.min.css"><!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"> -->
    <link rel="stylesheet" type="text/css" href="css/material_blue.css"><!-- <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css"> -->
    <script src="js/flatpickr.js"></script><!-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> -->
</head>

<body>

    <div style="padding:15vw">
        <div>
            <label>
                <div>Date 1</div>
                <input id="id-input-date" placeholder="Selec. fecha envío..." class=date />
            </label>
        </div>
    </div>

    <script>
        // ========================================================================================
        // DOCUMENTACIÓN:
        // 1. https://flatpickr.js.org/examples/#datetimepicker-with-limited-time-range
        // 2. https://github.com/flatpickr/flatpickr

        let startDate = new Date();
        startDate.setDate(startDate.getDate() + 1);

        let endDate = new Date();
        endDate.setDate(endDate.getDate() + 15);

        flatpickr(".date", {
            altInput: true,
            altFormat: "j F, Y",
            dateFormat: "Y-m-d",
            minDate: startDate, // "today",
            maxDate: endDate, // "15.12.2017",
            "disable": [
                function(date) {
                    // return true to disable
                    return (date.getDay() === 0 || date.getDay() === 6);

                }
            ],
            "locale": {
                "firstDayOfWeek": 0, // start week on Sunday/Domingo
                weekdays: {
                    shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                },
                months: {
                    shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
                    longhand: ['Enero', 'Febreo', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                },
            }
        });

        const elementDate = document.getElementById('id-input-date');

        elementDate.addEventListener('change', (event) => {
            console.log(elementDate.value);

            console.log(dateFormat(elementDate.value, 'dd-MM-yyyy'));
        });

        function dateFormat(inputDate, format) {
            // dateFormat('2021-12-10', 'MM-dd-yyyy')

            // parse the input date
            const date = new Date(inputDate);

            //extract the parts of the date
            const day = date.getDate() + 1;
            const month = date.getMonth() + 1;
            const year = date.getFullYear();

            //replace the month
            format = format.replace("MM", month.toString().padStart(2, "0"));

            //replace the year
            if (format.indexOf("yyyy") > -1) {
                format = format.replace("yyyy", year.toString());
            } else if (format.indexOf("yy") > -1) {
                format = format.replace("yy", year.toString().substr(2, 2));
            }

            //replace the day
            format = format.replace("dd", day.toString().padStart(2, "0"));

            return format;
        }
    </script>
</body>

</html>