$(document).ready(function() {
    "use strict";

    var CSRF_TOKEN = $('#CSRF_TOKEN').val();

    //check patient id
    $('#patient_id').on('keyup', function(){
        var pid = $(this);

        $.ajax({
            url  : _baseURL+'bed_manager/bed_assign/check_patient/',
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


    //check assign_date
    var assign_date    = $('#assign_date');
    var discharge_date = $('#discharge_date');
    var dateChange     = $('.dateChange');
    var bed_id         = $("#bed_id"); 

    dateChange.on('change', function(){ 
        $.ajax({
            url  : _baseURL+'bed_manager/bed_assign/check_bed/',
            type : 'POST',
            dataType : 'JSON',
            data : {
                'csrf_stream_token' : CSRF_TOKEN,
                assign_date : assign_date.val(), 
                discharge_date : discharge_date.val(), 
                bed_id : bed_id.val()  
            },
            success : function(data) 
            {
                discharge_date.next().html(data.message);
            }, 
            error : function()
            {
                alert('failed');
            }
        });
    });


    //custom date picker
    $('.cdatepicker').datepicker({
        minDate:0,
        dateFormat: "dd-mm-yy"
    });

});