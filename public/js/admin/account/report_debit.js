$(document).ready(function() {   
    "use strict";

    var option = $('#get_report_option').val();
    reportFilter(option);

    function reportFilter(option) 
    {
        if (option == 2) {
            $("#PatientWise").removeClass('hide');
            $("#AccountWise").addClass('hide');
            $("#DebitAccount").addClass('hide'); 
            $("#CreditAccount").addClass('hide');
        } else if (option == 3) {
            $("#AccountWise").removeClass('hide');
            $("#PatientWise").addClass('hide');
        } else { 
            $("#AccountWise").addClass('hide');
            $("#PatientWise").addClass('hide');
            $("#DebitAccount").addClass('hide');
            $("#CreditAccount").addClass('hide');
        } 
    }



   $('#ReportOption').on('change', function(){
        var option = $(this).val();
        reportFilter(option);
    });

    $("#AccType").on('change', function() {
        var type = $(this).val();

        if (type == 1) { //debit wise
            $("#DebitAccount").removeClass('hide');
            $("#CreditAccount").addClass('hide');
        } else if (type == 2) { //credit wise
            $("#CreditAccount").removeClass('hide');
            $("#DebitAccount").addClass('hide');
        } else { 
            $("#CreditAccount").addClass('hide');
            $("#DebitAccount").addClass('hide'); 
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
            var quantity = api.column( 5, { page: 'current'} ).data().reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                },0); 
            var price = api.column(6, { page: 'current'} ).data().reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                },0);
            var amount = api.column(7, { page: 'current'} ).data().reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                },0); 
            //#------ends of Total over this page------------------#
            // Update footer
            $( api.column(5).footer()).html(quantity.toFixed(2)); 
            $( api.column(6).footer()).html(price.toFixed(2));
            $( api.column(7).footer()).html(amount.toFixed(2));
        } 
    });

});

