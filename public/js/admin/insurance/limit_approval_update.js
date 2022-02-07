$(document).ready(function() {
    "use strict";

    var CSRF_TOKEN = $('#CSRF_TOKEN').val();

    var details_html = "<div class=\"row\" class=\"insc-mb-10\">"+
        "<div class=\"col-xs-4\">"+
            "<input name=\"disease_name[]\" type=\"text\" class=\"form-control\"  placeholder="+_langConfig.disease_name+" value=\"\" >"+
        "</div>"+
        "<div class=\"col-xs-4\">"+
            "<textarea rows=\"1\"  name=\"disease_details[]\" class=\"form-control\"  placeholder="+_langConfig.disease_details+"></textarea>"+
        "</div>"+
        "<div class=\"col-xs-4\">"+
            "<div class=\"btn-group\">"+
                "<button type=\"button\" class=\"btn  btn-info add-disease\">+</button>"+
                "<button type=\"button\" class=\"btn  btn-danger remove-disease\">-</button>"+
            "</div>"+
        "</div>"+
    "</div>";

    $("#disease_details").append(details_html);
    $('body').on('click', '.add-disease', function() {
        $("#disease_details").append(details_html);
    });
    $('body').on('click', '.remove-disease', function() {
       $(this).parent().parent().parent().remove();
    });

    //breakup
    var approval_html = "<div class=\"row\" class=\"insc-mb-10\">"+
        "<div class=\"col-xs-4\">"+
            "<input name=\"breakup_name[]\" type=\"text\" class=\"form-control\"  placeholder="+_langConfig.disease_name+" value=\"\" >"+
        "</div>"+
        "<div class=\"col-xs-4\">"+
            "<input name=\"breakup_charge[]\" class=\"form-control\"  placeholder="+_langConfig.disease_charge+">"+
        "</div>"+
        "<div class=\"col-xs-4\">"+
            "<div class=\"btn-group\">"+
                "<button type=\"button\" class=\"btn  btn-info add-breakup\">+</button>"+
                "<button type=\"button\" class=\"btn  btn-danger remove-breakup\">-</button>"+
            "</div>"+
        "</div>"+
    "</div>";

    $("#approval_breakup").append(approval_html);
    $('body').on('click', '.add-breakup', function() {
        $("#approval_breakup").append(approval_html);
    });
    $('body').on('click', '.remove-breakup', function() {
       $(this).parent().parent().parent().remove();
    });


    //check patient id
    $("#patient_id").on('keyup', function(){
        var patient_id = $(this);

        $.ajax({
            url : _baseURL+"appointment/check_patient",
            method: 'post',
            dataType: 'json',
            data: 
            {
                'csrf_stream_token' : CSRF_TOKEN,
                patient_id : $(this).val()
            },
            success: function(data)
            {
                if (data.status == true) {
                    patient_id.next().text(data.message).addClass('text-success').removeClass('text-danger');
                } else if (data.status == false) {
                    patient_id.next().text(data.message).addClass('text-danger').removeClass('text-success');
                } else {
                    patient_id.next().text(data.message).addClass('text-danger').removeClass('text-success');
                }
            },
            error: function()
            {
                alert('failed...');
            } 
        });

    }); 

});