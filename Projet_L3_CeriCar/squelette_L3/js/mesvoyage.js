    $("#affichermesVoyages").click(function(){
         
      
         
        $.ajax({
            url : 'newDispatcher.php?action=mesVoyages',
            type : 'GET',
            dataType : 'html', 
            success : function(code_html, statut){ 
                
                $("#page_maincontent").html(code_html);
            }
            });
            
    });