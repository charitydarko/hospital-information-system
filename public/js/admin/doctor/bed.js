$(document).ready(function() {
    "use strict";

    var CSRF_TOKEN = $('#CSRF_TOKEN').val();
    //check patient id
    $('#patient_id').on('keyup', function(){
        var pid = $(this);

        $.ajax({
            url  : _baseURL+'dashboard_doctor/bed_manager/bed_assign/check_patient/',
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
            url  : _baseURL+'dashboard_doctor/bed_manager/bed_assign/check_bed/',
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

    $('#bmReport').DataTable( {
        responsive: true, 
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp", 
        "lengthMenu": [[10, 25, 50, 100, 150, 200, -1], [10, 25, 50, 100, 150, 200, "All"]], 
        buttons: [ {extend: 'copy', className: 'btn-sm'}, 
        {extend: 'csv', title: 'ExampleFile', className: 'btn-sm'}, 
        {extend: 'excel', title: 'ExampleFile', className: 'btn-sm'}, 
        {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm'}, 
        {extend: 'print', className: 'btn-sm'} ], 

        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[\$,]/g, '')*1:typeof i === 'number' ? i : 0;
            };   

            //----------- Total over this page-----------
            var bedCapacity = api.column(3, { page: 'current'} ).data().reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                },0);            

            var charge = api.column(4, { page: 'current'} ).data().reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                },0);
         
            var amount = api.column(6, { page: 'current'} ).data().reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                },0);
         
            var free = api.column(7, { page: 'current'} ).data().reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                },0);
 
            //---------ends of Total over this page----------
            // Update footer
            $( api.column(4).footer()).html(charge.toFixed(2)); 
            $( api.column(5).footer()).html((bedCapacity-free).toFixed(2)); 
            $( api.column(6).footer()).html(amount.toFixed(2)); 
        } 
    });

    $('#reportDetails').DataTable( {
        responsive: true, 
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp", 
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]], 
        buttons: [ {extend: 'copy', className: 'btn-sm'}, 
        {extend: 'csv', title: 'ExampleFile', className: 'btn-sm'}, 
        {extend: 'excel', title: 'ExampleFile', className: 'btn-sm'}, 
        {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm'}, 
        {extend: 'print', className: 'btn-sm'} ], 

        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[\$,]/g, '')*1:typeof i === 'number' ? i : 0;
            };   

            //#----------- Total over this page------------------#
            var vat = api.column( 4, { page: 'current'} ).data().reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                },0);  
            //#-----------ends of Total over this page------------------#
            // Update footer
            $( api.column(4).footer()).html(vat.toFixed(2)); 
        } 
    });


    //custom date picker
    $('.cdatepicker').datepicker({
        minDate:0,
        dateFormat: "dd-mm-yy"
    });
});