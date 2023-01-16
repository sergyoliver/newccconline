'use strict';
$(document).ready(function() {
    $(window).on("load", function() {
        $('.preloader img').fadeOut();
        $('.preloader').fadeOut(1000);
    });
    new WOW().init();
    $('#login_validator').bootstrapValidator({
        fields: {
            login: {
                validators: {
                    notEmpty: {
                        message: 'Le login est obligatoire'
                    },
                    regexp: {
                        regexp: /^\S+@\S{1,}\.\S{1,}$/,
                        message: 'Le login doit correspondre a un email'
                    }
                }
            },
            pwd: {
                validators: {
                    notEmpty: {
                        message: 'Renseignez le mot de passe Svp'
                    }
                }
            }
        }
    });
    $('#validerattribution').bootstrapValidator({
        fields: {
            nom: {
                validators: {
                    notEmpty: {
                        message: 'Le nom est obligatoire'
                    }
                }
            },
            dp1: {
                validators: {
                    notEmpty: {
                        message: 'Date obligatoire'
                    }
                }
            },
            contact: {
                validators: {
                    notEmpty: {
                        message: 'Contact obligatoire'
                    }
                }
            }
        }
    });
    
});
