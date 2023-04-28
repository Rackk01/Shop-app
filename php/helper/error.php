<?php
function sendErrorMessage($errorCode)
{
    switch ($errorCode) {

        case 1:
            return 'ERROR_CODE_01 - Sin datos para la petición';
            break;

            //------------------------------------------------------------------------
            //------------------------------------------------------------------------

        case 2:
            return 'ERROR_CODE_02 - Sin datos para ejecutar la función';
            break;

            //------------------------------------------------------------------------
            //------------------------------------------------------------------------

        case 3:
            return 'ERROR_CODE_03 - Sin datos en la respuesta de la consulta';
            break;

            //------------------------------------------------------------------------
            //------------------------------------------------------------------------

        case 4:
            return 'ERROR_CODE_04 - Error en la consulta desde el service';
            break;

            //------------------------------------------------------------------------
            //------------------------------------------------------------------------

        case 402:
            return 'ERROR_CODE_402 - Error en la consulta desde el service';
            break;

            //------------------------------------------------------------------------
            //------------------------------------------------------------------------

        case 404:
            return 'ERROR_CODE_404';
            break;

            //------------------------------------------------------------------------
            //------------------------------------------------------------------------

        case 405:
            return 'ERROR_CODE_405 - Dalto duplicado';
            break;

            //------------------------------------------------------------------------
            //------------------------------------------------------------------------

        case 410:
            return 'ERROR_CODE_410 - Sin datos para ejecutar la función';
            break;

            //------------------------------------------------------------------------
            //------------------------------------------------------------------------

        case 411:
            return 'ERROR_CODE_411 - No se encontraron datos';
            break;

            //------------------------------------------------------------------------
            //------------------------------------------------------------------------

        case 1000: // ''
            return 'ERROR_CODE_EMPTY - Sin dato para devolver respuesta';
            break;

            //------------------------------------------------------------------------
            //------------------------------------------------------------------------

        case 1001: //default:
            return 'ERROR_CODE_DEFAULT - Sin dato para devolver respuesta || Opción por default';
            break;

            //------------------------------------------------------------------------
            //------------------------------------------------------------------------
    }
}


/*
Código de error	Descripción
200	Aceptar.
400	Argumento no válido o solicitud incorrecta
401	Acceso no autorizado.
403	Acceso prohibido Verifica Cloud Console y el archivo de credenciales para asegurarte de que el servicio se habilitó correctamente.
404	No se encontró el recurso.
409	Se intentó crear un recurso que ya existe o se anuló.
429	Demasiadas solicitudes. El cliente superó las restricciones de la cuota asignada. Consulta Cuotas y límites para obtener más información sobre tu cuota.
499	La operación se canceló.
500	Error del servidor interno
501	La operación no se implementó, no está habilitada o no se admite.
503	Servicio no disponible. Vuelve a intentarlo más tarde.
504	Tiempo de espera de la solicitud de la puerta de enlace

Respuestas informativas (100–199),
Respuestas satisfactorias (200–299),
Redirecciones (300–399),
Errores de los clientes (400–499),
y errores de los servidores (500–599).

*/