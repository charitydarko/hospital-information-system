$(document).ready(function() {
    "use strict";

    var CSRF_TOKEN = $('#CSRF_TOKEN').val();

    var disease_details = $("#disease_details").html(); 
    $('body').on('click', '.add-disease', function() {
        $("#disease_details").append(disease_details);
    });
    $('body').on('click', '.remove-disease', function() {
       $(this).parent().parent().parent().remove();
    });


    //breakup
    var approval_breakup = $("#approval_breakup").html(); 
    $('body').on('click', '.add-breakup', function() {
        $("#approval_breakup").append(approval_breakup);
    });
    $('body').on('click', '.remove-breakup', function() {
       $(this).parent().parent().parent().remove();
    });

    //check patient id
    $('#patient_id').on('keyup', function(){
        var pid = $(this);

        $.ajax({
            url  : _baseURL+"appointment/check_patient",
            type : 'post',
            dataType : 'JSON',
            data : {
                'csrf_stream_token' : CSRF_TOKEN,
                patient_id : pid.val()
            },
            success : function(data) 
            {
                if (data.status == true) {
                    pid.next().text(data.message).addClass('text-success').removeClass('text-danger');
                } else if (data.status == false) {
                    pid.next().text(data.message).addClass('text-danger').removeClass('text-success');
                } else {
                    pid.next().text(data.message).addClass('text-danger').removeClass('text-success');
                }
            }, 
            error : function()
            {
                alert('failed');
            }
        });
    }); 
});