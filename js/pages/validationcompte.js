'use strict';
$(document).ready(function() {
    $('#clear').on('click', function() {
        $('#tryitForm1,  #tryitForm').bootstrapValidator("resetForm");
    });
    $('#form_block_validator').bootstrapValidator({
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
            cell: {
                validators: {
                    notEmpty: {
                        message: 'Entrer contact'
                    },
                    regexp: {
                        regexp: /^[0-9]{10}$/,
                        message: 'Contact doit etre numérique'
                    }
                }
            }




        }
    });


});