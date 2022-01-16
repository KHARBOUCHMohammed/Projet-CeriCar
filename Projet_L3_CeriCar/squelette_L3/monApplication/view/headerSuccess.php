<!DOCTYPE html>
<html>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<title></title>
<meta charset="UTF-8">




<!-- Navigation Bar--> 
<div class="w3-bar w3-white w3-border-bottom w3-xlarge">

<?php if(!isset($_SESSION['user_id'])){ ?>
  <a id="home"  class="w3-bar-item w3-button w3-text-red w3-hover-red"><b></i>Ceri_Covoiturage</b></a>
  <a id="identifier"   class="w3-bar-item w3-button w3-right w3-hover-red w3-text-grey"></i>Se Connecter</a>
  <a id="inscription"  class="w3-bar-item w3-button w3-right w3-hover-red w3-text-grey">S'inscrire</a>
  <a id="rechercheVoyages"  class="w3-bar-item w3-button w3-right w3-hover-red w3-text-grey"></i>Recherche_Voyage </a>

<?php }else {?>
  
  <a id="home" class="w3-bar-item w3-button w3-text-red w3-hover-red"><b><i class="fa fa-map w3-margin-right"></i>Ceri_Covoiturage</b></a>
  <a id="mesReservation"  class="w3-bar-item w3-button w3-right w3-hover-red w3-text-grey"></i>Mes reservation</a>
  <a id="mesVoyages" h class="w3-bar-item w3-button w3-right w3-hover-red w3-text-grey">Mes voyage</a>
  <a id="logout"  class="w3-bar-item w3-button w3-right w3-hover-red w3-text-grey">Deconnexion</a>
  <a id="rechercheVoyages"  class="w3-bar-item w3-button w3-right w3-hover-red w3-text-grey">Recherche_Voyage </a>
  <a class="w3-bar-item w3-button w3-right w3-hover-red w3-text-grey"><?php echo $context->getSessionAttribute('user_prenom');?></a>

<?php } ?>

</div>
</html>
<script>

    // pour charger la page index 
    $('#home').click(function(){
        $.get("newDispatcher.php?action=index",function(res){
            console.log(res);
            $( "#page_maincontent" ).html(res);
            let b = document.getElementById("banner").innerHTML = "home page chargé "
        });
    });
  

    // pour charger la page authentification 
    $('#identifier').click(function(){
        $.get("newDispatcher.php?action=identifier",function(res){
            console.log(res);
            $( "#page_maincontent" ).html(res);
            let b = document.getElementById("banner").innerHTML = "authentification chargé chargé  "
        });
    });




  // charger la page inscription
    
    $('#inscription').click(function(){
        $.get("newDispatcher.php?action=inscription",function(res){
            console.log(res);
            $( "#page_maincontent" ).html(res);
            let b = document.getElementById("banner").innerHTML = "inscription chargé "
        });
    });
  
  
  // recuperer les reservation 
    $('#mesReservation').click(function(){
        $.get("newDispatcher.php?action=mesReservations",function(res){
            console.log(res);
            $( "#page_maincontent" ).html(res);
            let b = document.getElementById("banner").innerHTML = " mes reservation chargé avec succes  "
        });
    });
  
  // recuperer les voyages proposé
    $('#mesVoyages').click(function(){
        $.get("newDispatcher.php?action=mesVoyages",function(res){
            console.log(res);
            $( "#page_maincontent" ).html(res);

            let b = document.getElementById("banner").innerHTML = "mes voyage  chargé "
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
                let b = document.getElementById("banner").innerHTML = "deconnexion avec  succes  "
            });
        });
  
    });
           
    
  // pour recuperer la page pour chercher un voyage
    $('#rechercheVoyages').click(function(){
        $.get("newDispatcher.php?action=rechercheVoyages",function(res){
            console.log(res);
            $( "#page_maincontent" ).html(res);
            let b = document.getElementById("banner").innerHTML = "chercher voyage "
        });
    });
  
  
  </script>