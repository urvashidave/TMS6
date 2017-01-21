/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(window).bind("load", function() {
        $("#dialog").dialog("close");
        $(function() {
            
        $("#dialog").dialog({
        autoOpen: false
        });
        $("#button").on("click", function() {
            $("#dialog").dialog("open");
        });
        });
        
        $('#graph').change(function(){
        
        });
        // Validating Form Fields.....
        $("#save").click(function() {        
              if($('#graph').is(':checked')){
                var value=1;
            } else {
                var value=0;
            }  
            if($('#alarm').is(':checked')){
                var value2=1;
            } else {
                var value2=0;
            }  
            if($('#tank').is(':checked')){
                var value3=1;
            } else {
                var value3=0;
            }  
            
        $.ajax({
            async:false,
            type: "POST",
            url: "save-settings.php",
            data: {value1:value,value2:value2,value3:value3},
            success: function(data) {
                console.log(data);
            },
            error: function(data) {
                console.log("error");
            }
       });
    return false;
    });
   });


