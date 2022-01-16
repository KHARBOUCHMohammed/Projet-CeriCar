
    // pour charger la page index 
    $('#home').click(function(){
        $.get("newDispatcher.php?action=index",function(res){
            console.log(res);
            $( "#page_maincontent" ).html(res);
        });
    });
  
    $('#identifier').click(function(){
        $.get("newDispatcher.php?action=identifier",function(res){
            console.log(res);
            $( "#page_maincontent" ).html(res);
        });
    });




  // charger la page inscription
    
    $('#inscription').click(function(){
        $.get("newDispatcher.php?action=inscription",function(res){
            console.log(res);
            $( "#page_maincontent" ).html(res);
        });
    });
  
  
  // recuperer les reservation 
    $('#mesReservation').click(function(){
        $.get("newDispatcher.php?action=mesReservations",function(res){
            console.log(res);
            $( "#page_maincontent" ).html(res);
        });
    });
  
  // recuperer les voyages proposé
    $('#mesVoyages').click(function(){
        $.get("newDispatcher.php?action=mesVoyages",function(res){
            console.log(res);
            $( "#page_maincontent" ).html(res);
        });
    });
  
  
  
  //se deconnecter 
  
    $('#logout').click(function(){
        $.get("newDispatcher.php?action=logout",function(res){
            console.log(res);
            $.get("newDispatcher.php?action=header",function(res){
                console.log(res);
                $( "#header" ).html(res);
            })
            $.get("newDispatcher.php?action=index",function(res){
                console.log(res);
                $( "#page_maincontent" ).html(res);
            });
        });
  
    });
           
    
  // pour recuperer la page pour chercher un voyage
    $('#rechercheVoyages').click(function(){
        $.get("newDispatcher.php?action=rechercheVoyages",function(res){
            console.log(res);
            $( "#page_maincontent" ).html(res);
        });
    });
  
  