$(document).ready(function(){
  $('#login').submit(function(){

           var data = $(this).serialize();



                $.ajax({
                 url : 'newDispatcher.php?action=identifier',
                 data: $(this).serialize(),
                 type : 'GET',
                 success : function(html, statut){ 
                  // Modification du header
                         $.get('newDispatcher.php?action=header',function(data){
                             $("#header").html(data);
                       //  let b = document.getElementById("banner").innerHTML = "identification success"
                             
                         });
                      // Afficher la vue du recherche voyage
                      $.get('newDispatcher.php?action=rechercheVoyages',function(data){
                          $("#page_maincontent").html(data);
                         
                      });

                 }
                 
                 });
                

           return  false;
       })
});

