$(document).ready(function() {   
    "use strict";
    var CSRF_TOKEN = $('#CSRF_TOKEN').val();

    //   ENDS OF APPOINTMENT AND PATIENT INFORMATION
    $('#appointment_code').on('change', function(){
        var appointment_code = $(this).val();
        var url = window.location.origin+'/pharmacist/inventory/appointmentNow/';

        // Once the value is greater than 0
        if(appointment_code.length > 0) {
            $.ajax({
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-Token': CSRF_TOKEN
                },
                type: "POST",
                url: url,
                data: {
                    'appointment_code': appointment_code,
                },
                success: function(data ){
                    var newData = JSON.parse(data);
                    // $(".invlid_appointment_code").text(newData.message);
                    switch(newData.status) {
                        case 'false': {
                            $(".invlid_appointment_code").text(newData.message);
                            break;
                        }
                        case 'true': {
                            $(".invlid_appointment_code").text('');
                            $("#patient_code").val(newData.patient[0].registration_code);
                            $("#patient_name").val(newData.patient[0].firstname + ' ' + newData.patient[0].lastname);
                            $("#patient_address").val(newData.patient[0].address);
                            break;
                        }
                        default: {
                            $(".invlid_appointment_code").text('Invalid data');
                        }
                    }
                },
                fail: function(errorThrown){
                    alert('errorThrown');
                }
            });
        }
        
    });

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
    

    //calculate total 
    $('body').on('change', '.totalCal', function() {
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
    
});

