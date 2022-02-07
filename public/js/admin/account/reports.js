$(document).ready(function() {   
    "use strict";

    var option1 = $('#get_report_option').val();
    if (option1 == 2) {
        $('#PatientWise').removeClass('hide'); 
    } 

    $('#ReportOption').on('change', function(){
        var option = $(this).val();

        if (option == 2) {
            $('#PatientWise').removeClass('hide'); 
        } else {
            $("#PatientWise").addClass('hide'); 
        } 
    });


    $('#acmReport').DataTable( {
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
            var total = api.column( 3, { page: 'current'} ).data().reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                },0);
            var vat = api.column( 4, { page: 'current'} ).data().reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                },0); 
            var discount = api.column(5, { page: 'current'} ).data().reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                },0);
            var grand_total = api.column(6, { page: 'current'} ).data().reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                },0);
            var paid = api.column(7, { page: 'current'} ).data().reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                },0);
            var due = api.column(8, { page: 'current'} ).data().reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                },0);
            //#-----------ends of Total over this page------------------#
            // Update footer
            $( api.column(3).footer()).html(total.toFixed(2));
            $( api.column(4).footer()).html(vat.toFixed(2)); 
            $( api.column(5).footer()).html(discount.toFixed(2));
            $( api.column(6).footer()).html(grand_total.toFixed(2));
            $( api.column(7).footer()).html(paid.toFixed(2));
            $( api.column(8).footer()).html(due.toFixed(2));
        } 
    });

});

