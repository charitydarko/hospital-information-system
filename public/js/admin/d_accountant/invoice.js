$(document).ready(function() {   
    "use strict";

    var CSRF_TOKEN = $('#CSRF_TOKEN').val();
  
    //#------------------------------------
    //   STARTS OF DYNAMIC FORM 
    //#------------------------------------    

    //add row
    var body      = $('#invoice > tbody');
    $('body').on('click','.addBtn' ,function() {
        var itemData = $(this).parent().parent().parent().html();
        body.append("<tr>"+itemData+"</tr>"); 

        $('#invoice tbody tr:last-child input').each(function() {   
            $(this).val('');
        }); 

        $('#invoice tbody tr:last-child textarea').each(function() {
            $(this).val('');
        }); 

        $('#invoice tbody tr:last-child select').each(function() {  
            $(this).val('');
        }); 

    });

    //remove row
    $('body').on('click','.removeBtn' ,function() {
        $(this).parent().parent().parent().remove();

        //total   
        var total = 0;  
        $('.subtotal').each(function(){ 
            total  += parseFloat($(this).val());
            $('#total').val(total.toFixed(2));
        }); 

        // vat in parcent
        var vatParcent  = $('#vatParcent').val();   
        $('#vat').val(parseFloat((total * vatParcent) / 100).toFixed(2)); 

        // discount in parcent
        var discountParcent  = $('#discountParcent').val();   
        $('#discount').val(parseFloat((total * discountParcent) / 100).toFixed(2));  

        //vat and discount
        var vat         = $('#vat').val();
        var discount    = $('#discount').val(); 
        $("#grand_total").val(((parseFloat(total)+parseFloat(vat))-(parseFloat(discount))).toFixed(2));


        // paid and due
        var grand_total = $('#grand_total').val();
        var paid        = $('#paid').val();
        $('#due').val((parseFloat(grand_total)-parseFloat(paid)).toFixed(2)); 
    });


    //#------------------------------------
    //   STARTS OF CALCULATION 
    //#------------------------------------

    //calculate total 
    $('body').on('keyup', '.totalCal', function() {
        var totalCal = $(this).parent().parent();
        var quantity  = totalCal.children().next().next().children().val();
        var price  = totalCal.children().next().next().next().children().val(); 
        totalCal.children().next().next().next().next().children().val(
            (quantity*price).toFixed(2));

        /*calculate total invoice*/
        //total   
        var total = 0;
        $('.subtotal').each(function(){ 
            total  += parseFloat($(this).val());
            $('#total').val(total.toFixed(2));
        });  

        // vat in parcent
        var vatParcent  = $('#vatParcent').val();   
        $('#vat').val(parseFloat((total * vatParcent) / 100).toFixed(2));  

        // discount in parcent
        var discountParcent  = $('#discountParcent').val();   
        $('#discount').val(parseFloat((total * discountParcent) / 100).toFixed(2)); 

        //grand total
        var vat         = $('#vat').val();
        var discount    = $('#discount').val(); 
        $("#grand_total").val(((parseFloat(total)+parseFloat(vat))-(parseFloat(discount))).toFixed(2));

        // paid and due
        var grand_total = $('#grand_total').val();
        var paid        = $('#paid').val();
        $('#due').val((parseFloat(grand_total)-parseFloat(paid)).toFixed(2));  
    }); 

    // vat and discount
    $('body').on('change keyup', '.vatDiscount', function() {
        var total       = $('#total').val();
        var vat         = $('#vat').val();
        var discount    = $('#discount').val(); 
        $("#grand_total").val(((parseFloat(total)+parseFloat(vat))-(parseFloat(discount))).toFixed(2)); 
        $("#vatParcent").val(parseFloat((vat/total) * 100).toFixed(2)); 
        $("#discountParcent").val(parseFloat((discount/total) * 100).toFixed(2)); 
    });

    // vat in parcent
    $('body').on('keyup change', '#vatParcent', function() {
        var total       = $('#total').val(); 
        $('#vat').val(parseFloat((total * $(this).val()) / 100).toFixed(2)); 

        // vat in parcent
        var total       = $('#total').val();
        var vat         = $('#vat').val();
        var discount    = $('#discount').val(); 
        $("#grand_total").val(((parseFloat(total)+parseFloat(vat))-(parseFloat(discount))).toFixed(2));

        // paid and due
        var grand_total = $('#grand_total').val();
        var paid        = $('#paid').val();
        $('#due').val((parseFloat(grand_total)-parseFloat(paid)).toFixed(2)); 
    });

    // discount in parcent
    $('body').on('keyup change', '#discountParcent', function() {
        var total      = $('#total').val(); 
        $('#discount').val(parseFloat((total * $(this).val()) / 100).toFixed(2)); 

        // vat in parcent
        var total       = $('#total').val();
        var vat         = $('#vat').val();
        var discount    = $('#discount').val(); 
        $("#grand_total").val(((parseFloat(total)+parseFloat(vat))-(parseFloat(discount))).toFixed(2));

        // paid and due
        var grand_total = $('#grand_total').val();
        var paid        = $('#paid').val();
        $('#due').val((parseFloat(grand_total)-parseFloat(paid)).toFixed(2)); 

    });

    // paid and due
    $('body').on('keyup change', '.paidDue', function() {
        var grand_total = $('#grand_total').val();
        var paid        = $('#paid').val();
        $('#due').val((parseFloat(grand_total)-parseFloat(paid)).toFixed(2)); 
    }); 
 


    //   ENDS OF PATIENT INFORMATION
    $('body').on('keyup change', '#patient_id', function() {
        var patient_id = $(this).val();
        
        if(patient_id.length > 0)
            $.ajax({
                url     : _baseURL+'dashboard_accountant/account_manager/invoice/patient',
                method  : 'post',
                dataType: 'json', 
                data    : {
                    'patient_id' : patient_id,
                    'csrf_stream_token' : CSRF_TOKEN
                },
                success : function(data) {
                    if (data.status == true) { 
                        $(".invlid_patient_id").text('');
                        $("#patient_name").val(data.patient_name);
                        $("#patient_address").val(data.patient_address);
                    } else {
                        $(".invlid_patient_id").text(_langConfig.invalid_patient_id);
                    }
                },
                error   : function() {
                    alert('failed!');
                } 
            });
    });

    /*-----------------------------------------------*/
    /*   LOAD VAT/DISCOUNT PERCENT AUTOMATICALLY     */
    /*-----------------------------------------------*/

    $(window).on('load', function() {
        var total       = $('#total').val();
        var vat         = $('#vat').val();
        var discount    = $('#discount').val(); 
        $("#grand_total").val(((parseFloat(total)+parseFloat(vat))-(parseFloat(discount))).toFixed(2)); 
        $(".vatP").val(parseFloat((vat/total) * 100).toFixed(2)); 
        $(".discountP").val(parseFloat((discount/total) * 100).toFixed(2)); 
    });

});

