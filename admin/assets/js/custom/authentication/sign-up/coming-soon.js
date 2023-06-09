"use strict";
var KTSignupComingSoon = function () {
    var e, t, i;
    return {
        init: function () {
            e = document.querySelector("#kt_coming_soon_form"), t = document.querySelector("#kt_coming_soon_submit"), e && (i = FormValidation.formValidation(e, {
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
            }), t.addEventListener("click", (function (o) {
                o.preventDefault(), i.validate().then((function (i) {
                    "Valid" == i ? (t.setAttribute("data-kt-indicator", "on"), t.disabled = !0, setTimeout((function () {
                        t.removeAttribute("data-kt-indicator"), t.disabled = !1, Swal.fire({
                            text: "We have received your request. You will be notified once we go live.",
                            icon: "success",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then((function (t) {
                            t.isConfirmed && (e.querySelector('[name="email"]').value = "")
                        }))
                    }), 2e3)) : Swal.fire({
                        text: "Sorry, looks like there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    })
                }))
            })))
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTSignupComingSoon.init()
}));