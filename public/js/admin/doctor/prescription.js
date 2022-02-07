$(document).ready(function() {
    "use strict";

    var CSRF_TOKEN = $('#CSRF_TOKEN').val();
    
    //patient information 
    $('body').on("click", ".caseStudyBtn", function () {

        var patient_id = $("#patient_id").val();

        $.ajax({
            url     : _baseURL+'dashboard_doctor/prescription/prescription/case_study',
            method  : 'post',
            dataType: 'json', 
            data    : {
                'patient_id' : patient_id,
                'csrf_stream_token' : CSRF_TOKEN
            },
            success : function(data) {
                if (data) {

                    html = "<table class='table table-striped'>"+
                                "<thead>"+
                                    "<tr class='bg-info'>"+
                                        "<td>CASE</td>"+
                                        "<td>STATUS</td>"+ 
                                    "</tr>"+
                                "</thead>"+
                                "<tbody>";

                    $.each(data, function(i, v) {
                        if (i!='id' && i!='status') {
                            var i = i.replace('_', ' ').toUpperCase();
                            html += "<tr><td>"+i+"</td><td>"+v+"</td></tr>";
                        }
                    });

                    html += "</tbody></table>";

                    $("#caseStudyOutput").html(html);
                } else {
                    $("#caseStudyOutput").html(_langConfig.invalid_patient_id);
                }
            },
            error   : function() {
                alert('failed!');
            } 
        });   
    });

 
    // medicine list
    $('body').on('keyup change click', '.medicine', function(){
        $(this).autocomplete({
            source: function(request, response) {
              $.ajax({
                type: 'POST',
                dataType: 'json',
                url: _baseURL+'dashboard_doctor/prescription/prescription/readMedicine',
                data: {searchText: request.term,'csrf_stream_token' : CSRF_TOKEN},
                success: function(data) {
                  response( $.map( data, function( item ) {
                      return {
                            label: item.name,
                            value: item.name
                        };
                  }));
                }
              });
            }
        });
    });    



    //#------------------------------------
    //   STARTS OF MEDICINE 
    //#------------------------------------    
    //add row
    $('body').on('click','.MedAddBtn' ,function() {
        var itemData = $(this).parent().parent().parent(); 
        $('#medicine').append("<tr>"+itemData.html()+"</tr>");
        $('#medicine tr:last-child').find(':input').val('');
    });
    //remove row
    $('body').on('click','.MedRemoveBtn' ,function() {
        $(this).parent().parent().parent().remove();
    });

    //#------------------------------------
    //   STARTS OF DIAGNOSIS 
    //#------------------------------------    
    //add row
    $('body').on('click','.DiaAddBtn' ,function() {
        var itemData = $(this).parent().parent().parent(); 
        $('#diagnosis').append("<tr>"+itemData.html()+"</tr>"); 
        $('#diagnosis tr:last-child').find(':input').val('');
    });
    //remove row
    $('body').on('click','.DiaRemoveBtn' ,function() {
        $(this).parent().parent().parent().remove();
    });


    //#------------------------------------
    //   ENDS OF PATIENT INFORMATION
    //#------------------------------------

    $(window).on('load', function(){
        var patient_id = $('#get_pid').val();
        if(patient_id.length > 0)
        patientInfo(patient_id);
    });

    $('body').on('keyup change', '#patient_id', function() {
        var patient_id = $(this).val();
        patientInfo(patient_id);
    });

    function patientInfo(patient_id)
    { 
        if(patient_id.length > 0)
        $.ajax({
            url     : _baseURL+'dashboard_doctor/prescription/prescription/patient',
            method  : 'post',
            dataType: 'json', 
            data    : {
                'patient_id' : patient_id,
                'csrf_stream_token' : CSRF_TOKEN
            },
            success : function(data) {
                if (data.status == true) { 
                    $(".invlid_patient_id").text('');
                    $("#patient_name").val(data.name);
                    $("#sex").val(data.sex);
                    $("#date_of_birth").val(data.date_of_birth);
                } else {
                    $(".invlid_patient_id").text(_langConfig.invalid_patient_id);
                }
            },
            error   : function() {
                alert('failed!');
            } 
        });
    }

});