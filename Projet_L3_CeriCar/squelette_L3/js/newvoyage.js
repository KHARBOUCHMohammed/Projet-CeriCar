
    $("#nouveauVoyage").click(function(){
         
      
         
        $.ajax({
            url : 'newDispatcher.php?action=header',
            type : 'GET',
            dataType : 'html', 
            success : function(code_html, statut){ 
                
                $("#page_maincontent").html(code_html);
            }
            });
            
    });