$(document).ready(function(){
    "use strict";

    var edit = $(".edit");
    edit.on('click', function(){
        var template = $(this).parent().prev().text();
        var type = $(this).parent().prev().prev().text();
        var name = $(this).parent().prev().prev().prev().text();
        var id = $(this).data('id');


        $("#id").val(id);
        $("#template_name").val(name); 
        $('select#type option[value='+type+']').attr("selected", "selected");  
        $("#teamplate").html(template);

        $(".tit").text(_langConfig.sms_template_setup);
        $("#MyForm").attr("action", 'template_edit');
        $(".sav_btn").text(_langConfig.update); 
    });
});