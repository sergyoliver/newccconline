'use strict';
$(document).ready(function () {
    // Chosen
    $(".hide_search").chosen({disable_search_threshold: 10});
    $(".chzn-select").chosen({allow_single_deselect: true});
    $(".chzn-select-deselect,#select2_sample").chosen();
    // End of chosen

    // Input mask
    $("#phones").inputmask();
    $("#product").inputmask("a*-999-a999");
    $("#percent").inputmask("99%");
    $(".date_mask").inputmask("dd/mm/yyyy");
   // End of input mask

    //tags input
    $('#tags').tagsInput();
    $("#input-21").fileinput({
        theme: "fa",
        previewFileType: "image",
        browseClass: "btn btn-success",
        browseLabel: "Pick Image",
        removeClass: "btn btn-danger",
        removeLabel: "Delete"


    });
    $("#input-4").fileinput({
        showCaption: false,
        theme: "fa",
        allowedFileExtensions: ["jpg","jpeg","png","bmp","pdf","zip", "rar"]
    });
    $("#input-4img").fileinput({showCaption: false,
        theme: "fa",
        allowedFileExtensions: ["jpg","jpeg","png","bmp"]
    });
    $("#input-4pdf").fileinput({showCaption: false,
        theme: "fa",
        allowedFileExtensions: ["pdf"]
    });
    $("#input-41").fileinput({showCaption: false,
        theme: "fa",
        maxFilePreviewSize: 700240,
        allowedFileExtensions: ["pdf","jpg","jpeg","png","bmp","zip", "rar"]
    });
    $("#input-412").fileinput({showCaption: false,
        theme: "fa",
        allowedFileExtensions: ["pdf","jpg","jpeg","png","bmp","zip", "rar"]
    });
    $("#input-413").fileinput({showCaption: false,
        theme: "fa",
        allowedFileExtensions: ["pdf","jpg","jpeg","png","bmp","zip", "rar"]
    });
    $("#input-22").fileinput({
        theme: "fa",
        previewFileType: "text",
        allowedFileExtensions: ["txt", "md", "ini", "text"],
        previewClass: "bg-warning"
    });
    $("#input-43").fileinput({
        theme: "fa",
        showPreview: false,
        allowedFileExtensions: ["zip", "rar", "gz", "tgz"],
        elErrorContainer: "#errorBlock"
    });
    $("#input-fa").fileinput({
        theme: "fa",
        uploadUrl: "/file-upload-batch/2"
    });

Admire.formGeneral() ;
});
