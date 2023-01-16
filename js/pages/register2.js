'use strict';
$(document).ready(function() {
    new WOW().init();
    $(window).on("load", function() {
        $('.preloader img').fadeOut();
        $('.preloader').fadeOut(1000);
    });
    $('#register_valid').bootstrapValidator({
        fields: {
            UserName: {
                validators: {
                    notEmpty: {
                        message: 'Le nom et prénoms sont obligatoires'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Email est obligatoire'
                    },
                    regexp: {
                        regexp: /^\S+@\S{1,}\.\S{1,}$/,
                        message: 'l\'adresse email est invalide'
                    }
                }
            },


            phone: {
                validators: {
                    notEmpty: {
                        message: 'Entrez un contact valide'
                    },
                    regexp: {
                        regexp: /^[0-9]{10}$/,
                        min:10,
                        max:10,
                        message: 'Le contact doit contenir 10 chiffres'
                    }
                }
            }
        }

    });
});