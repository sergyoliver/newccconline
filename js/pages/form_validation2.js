'use strict';
$(document).ready(function() {

    $('#form_inline_validator').bootstrapValidator({
        fields: {
            nom: {
                validators: {
                    notEmpty: {
                        message: 'Entrer le nom'
                    }
                }
            },
            pnom: {
                validators: {
                    notEmpty: {
                        message: 'Entrer le prénom'
                    }
                }
            },
            pwd: {
                validators: {

                    notEmpty: {
                        message: 'Entrer mot de passe'
                    }
                }
            },
        cordx: {
                validators: {

                    notEmpty: {
                        message: 'champ obligatoire merci d\'autoriser votre navigateur'
                    }
                }
            },
 cordy: {
                validators: {

                    notEmpty: {
                        message: 'champ obligatoire merci d\'autoriser votre navigateur'
                    }
                }
            },

            mail: {
                validators: {
                    notEmpty: {
                        message: 'Entrer Email'
                    },
                    regexp: {
                        regexp: /^\S+@\S{1,}\.\S{1,}$/,
                        message: 'Email invalide'
                    }
                }
            },
            telp: {
                validators: {
                    notEmpty: {
                        message: 'Entrer contact'
                    },
                    regexp: {
                        regexp: /^[0-9]{10}$/,
                        message: 'Saisir contact de 10 chiffres'
                    }
                }
            }




        }
    });

});
