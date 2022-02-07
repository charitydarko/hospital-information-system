$(document).ready(function(){
    "use strict";
    // Enable sidebar push menu
    if ($("body").hasClass('sidebar-collapse')) {
        $("body").removeClass('sidebar-collapse').trigger('expanded.pushMenu');
    } else {
        $("body").addClass('sidebar-collapse').trigger('collapsed.pushMenu');
    }

    var CSRF_TOKEN = $('#CSRF_TOKEN').val();

    // #---------------ADD OR REMOVE ITEM-------------------#
    var services_html = "<tr>"+
    "<td><div class=\"btn btn-group\">"+
        "<button type=\"button\" class=\"addMore btn btn-sm btn-success\">+</button>"+
        "<button type=\"button\" class=\"remove btn btn-sm btn-danger\">-</button>"+
    "</div></td>"+
    "<td><input name=\"service_name[]\" class=\"form-control service_name service_data\" type=\"text\" placeholder="+_langConfig.service_name+" required><input name=\"service_id[]\" type=\"hidden\" class=\"service_id\" required></td>"+
    "<td><input name=\"quantity[]\" class=\"form-control quantity item-calc\" type=\"text\" placeholder="+_langConfig.quantity+" value=\"1\" required></td>"+
    "<td><input name=\"amount[]\" class=\"form-control amount item-calc\" type=\"text\" placeholder="+_langConfig.amount+"  value=\"0.00\"  required></td>"+
    "<td><input name=\"subtotal[]\" class=\"form-control subtotal\" type=\"text\" placeholder="+_langConfig.subtotal+"  value=\"0.00\" required></td>"+
    "</tr>";

    $("#services").append(services_html);
    $('body').on('click', '.addMore', function() {
        $("#services").append(services_html); 

        //total   
        var total = 0;
        $('.subtotal').each(function(){ 
            total  += parseFloat($(this).val());
            $('#total').val(total.toFixed(2));
        });  

        $("#payable").val(
            (parseFloat($("#total").val())+parseFloat($("#tax").val())-parseFloat($("#discount").val())-parseFloat($("#pay_advance").val())).toFixed(2)
        );   

    });


    $('body').on('click', '.remove', function() {
       $(this).parent().parent().parent().remove();
 
        //total   
        var total = 0;
        $('.subtotal').each(function(){ 
            total  += parseFloat($(this).val());
            $('#total').val(total.toFixed(2));
        });  

        var tax = $("#tax").val();
        var discount = $("#discount").val();
        $("#taxPercent").val(parseFloat((tax/total) * 100).toFixed(2)); 
        $("#discountPercent").val(parseFloat((discount/total) * 100).toFixed(2));  

        $("#payable").val(
            (parseFloat($("#total").val())+parseFloat($("#tax").val())-parseFloat($("#discount").val())-parseFloat($("#pay_advance").val())).toFixed(2)
        );   
    });


    // #----------------------------------------------#
    var patient_id     = $("#patient_id");
    var admission_date = $("#admission_date");
    var discharge_date = $("#discharge_date");
    var total_days     = $("#total_days");
    var patient_name   = $("#patient_name");
    var address        = $("#address");
    var date_of_birth  = $("#date_of_birth");
    var male           = $("#male");
    var female         = $("#female"); 
    var doctor_name    = $("#doctor_name"); 
    var insurance_name = $("#insurance_name"); 
    var policy_no      = $("#policy_no"); 
    var picture        = $("#picture"); 
    var package_id     = $("#package_id"); 
    var package_name   = $("#package_name"); 
    var total_days     = $("#total_days"); 
    var advance_data   = $("#advance_data"); 
    var pay_advance    = $("#pay_advance"); 
    var discount       = $("#discount"); 
    // #----------------------------------------------#



    var aid = $("#admission_id");
    aid.on('keyup change',function(){

        patient_id.val('');
        admission_date.val('');
        discharge_date.val('');
        total_days.val('');
        patient_name.val('');
        address.val('');
        male.val('');
        female.val('');
        doctor_name.val('');
        insurance_name.val('');
        policy_no.val('');
        picture.attr('src','');
        package_id.val('');
        package_name.val('');
        total_days.val('0'); 
        advance_data.html(''); 
        pay_advance.val('0.00'); 
        discount.val('0.00'); 

        $.ajax({
            url: _baseURL+'billing/bill/getInformation',
            method: 'post',
            dataType: 'json',
            data: {
                admission_id: $(this).val(),
                'csrf_stream_token': CSRF_TOKEN
            },
            success: function(data)
            {  

                if (data.status==true)
                {
                    //patient information 
                    patient_id.val(data.result.patient_id);
                    patient_name.val(data.result.patient_name);
                    address.val(data.result.address);
                    date_of_birth.val(data.result.date_of_birth);
                    if(data.result.sex=="female")
                    {
                        male.removeAttr('checked');
                        female.attr('checked','checked'); 
                    }
                    else
                    {
                        male.attr('checked','checked');
                        female.removeAttr('checked');
                    }
                    picture.attr('src', _baseURL+data.result.picture);

                    //doctor information
                    doctor_name.val(data.result.doctor_name);

                    // admission information
                    admission_date.val(data.result.admission_date);
                    discharge_date.val(data.result.discharge_date);
                    total_days.val(data.result.total_days);


                    //insurance information
                    insurance_name.val(data.result.insurance_name);
                    policy_no.val(data.result.policy_no);

                    //package information
                    package_id.val(data.result.package_id);
                    package_name.val(data.result.package_name);
                    discount.val(data.result.discount);

                    var services_html = "";
                    var serviceObj = JSON.parse(data.result.services);
                    $.each(serviceObj, function(i,x){ 
                        services_html += "<tr>"+
                        "<td><div class=\"btn btn-group\">"+
                            "<button type=\"button\" class=\"addMore btn btn-sm btn-success\">+</button>"+
                            "<button type=\"button\" class=\"remove btn btn-sm btn-danger\">-</button>"+
                        "</div></td>"+
                        "<td><input name=\"service_name[]\" value='"+x.name+"' class=\"form-control service_name service_data\" type=\"text\" placeholder="+_langConfig.service_name+" required><input name=\"service_id[]\" type=\"hidden\" class=\"service_id\" value='"+x.id+"' required></td>"+
                        "<td><input name=\"quantity[]\" value='"+x.quantity+"' class=\"form-control quantity item-calc\" type=\"text\" placeholder="+_langConfig.quantity+" value=\"1\" required></td>"+
                        "<td><input name=\"amount[]\" value='"+x.amount+"' class=\"form-control amount item-calc\" type=\"text\" placeholder="+_langConfig.amount+" value=\"0.00\" required></td>"+
                        "<td><input name=\"subtotal[]\" value='"+(x.quantity*x.amount).toFixed(2)+"' class=\"form-control subtotal\" type=\"text\" placeholder="+_langConfig.subtotal+"  value=\"0.00\" required></td>"+
                        "</tr>";
                    });
                    if (serviceObj && serviceObj.length > 0)
                    {
                        $("#services").html(services_html);
                    } 

                    //success state
                    aid.parent().removeClass('has-error').addClass('has-success');
                    aid.next().html('<button type="button" class="btn btn-success"><i class="fa fa-check"></i></button>');


                    //advance_data payment
                    advance_data.html(data.advance_data);
                    pay_advance.val(data.pay_advance.toFixed(2));
 

                    //total   
                    var total = 0;
                    $('.subtotal').each(function(){ 
                        total  += parseFloat($(this).val());
                        $('#total').val(total.toFixed(2));
                    });  


                    $("#discountPercent").val(parseFloat((data.result.discount/total) * 100).toFixed(2)); 
                    $("#taxPercent").val("0.00");


                    $("#payable").val(
                        (parseFloat($("#total").val())+parseFloat($("#tax").val())-parseFloat($("#discount").val())-parseFloat($("#pay_advance").val())).toFixed(2)
                    );   
                }
                else
                {
                    aid.parent().addClass('has-error').removeClass('has-success');
                    aid.next().html('<button type="button" class="btn btn-danger"><i class="fa fa-times"></i></button>');
                }
            },
            error: function(e)
            {
                alert('failed...');
            }
        });
    });

    // #---------------SERVICE LIST-------------------#
    var options = {
      minLength: 0,
      source: function(request, response) {
          $.ajax({
            type: 'POST',
            dataType: 'json',
            url: _baseURL+'billing/bill/serviceList',
            data: {'csrf_stream_token' : CSRF_TOKEN},
            success: function(data) {
              response( $.map( data, function( item ) {
                  var object = new Object();
                  object.label = item.label;
                  object.service_id = item.service_id;
                  object.quantity = item.quantity;
                  object.amount = item.amount;
                  return object
              }));
            }
          });
        },
        focus: function( event, ui ) {
            $(this).val(ui.item.label);
            return false;
        },
        select: function( event, ui ) {
            $(this).parent().parent().find(".service_name").val(ui.item.label);
            $(this).parent().parent().find(".service_id").val(ui.item.service_id);
            $(this).parent().parent().find(".quantity").val(ui.item.quantity);
            $(this).parent().parent().find(".amount").val(ui.item.amount);
            $(this).parent().parent().find(".subtotal").val(parseFloat(ui.item.amount)*parseFloat(ui.item.quantity));

            //total   
            var total = 0;
            $('.subtotal').each(function(){ 
                total  += parseFloat($(this).val());
                $('#total').val(total.toFixed(2));
            });  

            var tax = $("#tax").val();
            var discount = $("#discount").val();
            $("#taxPercent").val(parseFloat((tax/total) * 100).toFixed(2)); 
            $("#discountPercent").val(parseFloat((discount/total) * 100).toFixed(2)); 


            $("#payable").val(
                (parseFloat($("#total").val())+parseFloat($("#tax").val())-parseFloat($("#discount").val())-parseFloat($("#pay_advance").val())).toFixed(2)
            );  
            return false;
        }
    } 

    $('body').on('keydown.autocomplete', '.service_data', function() {
        $(this).autocomplete(options);
    });


    // total summation
    $('body').on('keyup', '.item-calc', function() {
        var qty = $(this).parent().parent().find(".quantity").val();
        var amt = $(this).parent().parent().find(".amount").val();
        $(this).parent().parent().find(".subtotal").val((qty*amt).toFixed(2));

        //total   
        var total = 0;
        $('.subtotal').each(function(){ 
            total  += parseFloat($(this).val());
            $('#total').val(total.toFixed(2));
        }); 

        var tax = $("#tax").val();
        var discount = $("#discount").val();
        $("#taxPercent").val(parseFloat((tax/total) * 100).toFixed(2)); 
        $("#discountPercent").val(parseFloat((discount/total) * 100).toFixed(2));  

        $("#payable").val(
            (parseFloat($("#total").val())+parseFloat($("#tax").val())-parseFloat($("#discount").val())-parseFloat($("#pay_advance").val())).toFixed(2)
        );  
    });
 
    
    // grand total summation
    $('body').on('keyup', '.grand-calc', function() {  

        var total       = $('#total').val();
        var tax         = $('#tax').val();
        var discount    = $('#discount').val(); 
        $("#taxPercent").val(parseFloat((tax/total) * 100).toFixed(2)); 
        $("#discountPercent").val(parseFloat((discount/total) * 100).toFixed(2)); 

        $("#payable").val(
            (parseFloat($("#total").val())+parseFloat($("#tax").val())-parseFloat($("#discount").val())-parseFloat($("#pay_advance").val())).toFixed(2)
        );  
    });

    // tax-discount-calc
    $('body').on('keyup', '.tax-discount-calc', function() 
    {   
        var total = $("#total").val();
        var discountPercent = $("#discountPercent").val(); 
        $("#discount").val(((parseFloat(discountPercent)/100)*parseFloat(total)).toFixed(2));

        var taxPercent = $("#taxPercent").val(); 
        $("#tax").val(((parseFloat(taxPercent)/100)*parseFloat(total)).toFixed(2));
 

        $("#payable").val(
            (parseFloat($("#total").val())+parseFloat($("#tax").val())-parseFloat($("#discount").val())-parseFloat($("#pay_advance").val())).toFixed(2)
        );  
    });

    $('#billList').DataTable( {
        responsive: true, 
        paging:false,
        dom: "<'row'<'col-sm-4'B><'col-sm-4'l><'col-sm-4'f>>tp", 
        buttons: [  
            {extend: 'copy', className: 'btn-sm'}, 
            {extend: 'csv', title: 'ExampleFile', className: 'btn-sm'}, 
            {extend: 'excel', title: 'ExampleFile', className: 'btn-sm', title: 'exportTitle'}, 
            {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm'}, 
            {extend: 'print', className: 'btn-sm'} 
        ], 

        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[\$,]/g, '')*1:typeof i === 'number' ? i : 0;
            };   

            //----------- Total over this page-----------          

            var total = api.column(5, { page: 'current'} ).data().reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                },0);
         
            var discount = api.column(6, { page: 'current'} ).data().reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                },0);
         
            var tax = api.column(7, { page: 'current'} ).data().reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                },0);
          
            //---------ends of Total over this page----------
            // Update footer
            $( api.column(5).footer()).html((total).toFixed(2)); 
            $( api.column(6).footer()).html((discount).toFixed(2)); 
            $( api.column(7).footer()).html(tax.toFixed(2)); 
        } 
    });

});