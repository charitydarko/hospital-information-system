$(document).ready(function() {
    "use strict";

    // load patient name
    function getTeamplate(){          
        var teamplate_id = document.getElementById('tmp').value;
            $.ajax({ 
                'url': _baseURL + 'admin/Ajax_controller/get_teamplate/'+teamplate_id,
                'type': 'GET', //the way you want to send data to your URL
                'data': {'teamplate_id': teamplate_id },
                'success': function(d) { 
                    var container = $(".view_tmp");
                    if(d){
                            container.html(d);
                        }else{ 
                            container.val(""); 
                        }
                }
            });
    }

});