$(document).ready(function(){
    "use strict";

    var CSRF_TOKEN = $('#CSRF_TOKEN').val();

    // add or remove item
    var services_html = "<tr>"+
    "<td><input name=\"service_name[]\" class=\"form-control service_name service_data\" type=\"text\" placeholder="+_langConfig.service_name+"><input name=\"service_id[]\" type=\"hidden\" class=\"service_id\"></td>"+
    "<td><input name=\"quantity[]\" class=\"form-control quantity\" type=\"text\" placeholder="+_langConfig.quantity+"></td>"+
    "<td><input name=\"amount[]\" class=\"form-control amount\" type=\"text\" placeholder="+_langConfig.amount+"></td>"+
    "<td><div class=\"btn btn-group\">"+
        "<button type=\"button\" class=\"addMore btn btn-sm btn-success\">+</button>"+
        "<button type=\"button\" class=\"remove btn btn-sm btn-danger\">-</button>"+
    "</div></td>"+
    "</tr>";

    $('body').on('click', '.addMore', function() {
        $("#services").append(services_html);
    });
    $('body').on('click', '.remove', function() {
       $(this).parent().parent().parent().remove();
    });
 


    // auto complete 
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
            return false;
        }
    } 

    $('body').on('keydown.autocomplete', '.service_data', function() {
        $(this).autocomplete(options);
    });

});