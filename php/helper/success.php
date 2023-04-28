<?php

function sendSuccessMessage($successCode)
{
    switch ($successCode) {

        case 1:
            return 'SUCCESS_CODE_01 - Transacción de datos finalizada correctamente';
            break;

            //------------------------------------------------------------------------
            //------------------------------------------------------------------------

        case 201:
            return 'SUCCESS_CODE_201 - Transacción de datos finalizada correctamente';
            break;

            //------------------------------------------------------------------------
            //------------------------------------------------------------------------

        case '':
            return 'SUCCESS_CODE_EMPTY - Sin dato para devolver respuesta';
            break;

            //------------------------------------------------------------------------
            //------------------------------------------------------------------------

        default:
            return 'SUCCESS_CODE_DEFAULT - Sin dato para devolver respuesta || Opción por default';
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