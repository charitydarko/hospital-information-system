$(document).ready(function() {
	"use strict";
	
    var html = $("#disease_charge").html(); 
    $('body').on('click', '.add-disease', function() {
        $("#disease_charge").append(html);
    });
    $('body').on('click', '.remove-disease', function() {
       $(this).parent().parent().parent().remove();
    });
});