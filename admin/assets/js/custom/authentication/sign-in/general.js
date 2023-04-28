"use strict";
var KTSigninGeneral = function () {
    var e, t, i;
    return {
        init: function () {
            e = document.querySelector("#id-form-login"), t = document.querySelector("#id-btn-login"), i = FormValidation.formValidation(e, {
                fields: {
                    email: {
                        validators: {
                            regexp: {
                                regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                                message: "El formato de email ingresado es inválido" // "The value is not a valid email address"
                            },
                            notEmpty: {
                                message: "Se requiere Dirección de correo electrónico"
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: "La contraseña es requerida"
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            }), t.addEventListener("click", (function (n) {
                n.preventDefault(), i.validate().then((function (i) {
                    "Valid" == i ? (t.setAttribute("data-kt-indicator", "on"), t.disabled = !0, setTimeout((function () {
                        t.removeAttribute("data-kt-indicator"), t.disabled = !1, Swal.fire({
                            text: "Los datos tienen el formato correcto. Validando con el servidor!",
                            icon: "success",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, entendido!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then((function (t) {
                            if (t.isConfirmed) {
                                e.querySelector('[name="email"]').value = "", e.querySelector('[name="password"]').value = "";
                                var i = e.getAttribute("data-kt-redirect-url");
                                i && (location.href = i)
                            }
                        }))
                    }), 2e3)) : Swal.fire({
                        text: "Cuidado, parece que se han detectado algunos errores, inténtalo de nuevo.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, entendido!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    })
                }))
            }))
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTSigninGeneral.init()
}));