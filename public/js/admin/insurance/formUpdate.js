$(document).ready(function() {
	"use strict";
	
    var html = "<div class=\"row\" style=\"insc-mb-10\">"+
            "<div class=\"col-xs-4\">"+
                "<input name=\"disease_name[]\" type=\"text\" class=\"form-control\"  placeholder="+_langConfig.disease_name+">"+
            "</div>"+
            "<div class=\"col-xs-4\">"+
                "<input name=\"disease_charge[]\" type=\"text\" class=\"form-control\"  placeholder="+_langConfig.disease_charge+">"+
            "</div>"+
            "<div class=\"col-xs-4\">"+
                "<div class=\"btn-group\">"+
                    "<button type=\"button\" class=\"btn btn-info add-disease\">+</button>"+
                    "<button type=\"button\" class=\"btn btn-danger remove-disease\">-</button>"+
                "</div>"+
            "</div>"+
        "</div>"; 

    $("#disease_charge").append(html);

    $('body').on('click', '.add-disease', function() {
        $("#disease_charge").append(html);
    });
    $('body').on('click', '.remove-disease', function() {
       $(this).parent().parent().parent().remove();
    });

});