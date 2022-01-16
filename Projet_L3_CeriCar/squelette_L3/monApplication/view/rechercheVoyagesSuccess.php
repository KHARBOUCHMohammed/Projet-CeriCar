



<header class="w3-display-container w3-content w3-hide-small" style="max-width:1500px">
  <img class="w3-image" src="images/london2.jpg" alt="London" width="1500" height="700">
  <div class="w3-display-middle" style="width:65%">
    <div class="w3-bar w3-black">
      <button class="w3-bar-item w3-button tablink" onclick="openLink(event, 'Trip');"><i class="fa fa-bus w3-margin-right"></i>Trip</button>
    </div>


    
  <form  id="recherche" method="GET">
    <!-- Tabs -->
    <div id="Trip" class="w3-container w3-white w3-padding-16 myLink">
      <h3>Travel the world with us</h3>
      <div class="w3-row-padding" style="margin:0 -16px;">
        <div class="w3-half">
          <label>From</label>
          <input class="w3-input w3-border" type="text" placeholder="Departing from"  name="dep" id="dep">
        </div>
        <div class="w3-half">
          <label>To</label>
          <input class="w3-input w3-border" type="text" placeholder="Arriving at" name="arr" id="arr">
        </div>
        
         
        
          <!--<div class="w3-half">
          <label>Passenger Number </label>
          <input class="w3-input w3-border" type="number" placeholder="Passenger Number" id="nbrvoyageurs">
          
        </div>-->
        
      </div>
      <br>
      <p><button type="submit" class="w3-button w3-dark-grey">Search travel</button></p>
    </div>
  </form>

</header>

<body>
<div id="affichage">
<br><br>

<!-- table des resultats-->
</div>


<div id="content">
<br><br>

<!-- table des affich-->
</div>

</body>

<script>
$(document).ready(function(){
	$('#recherche').submit(function(){
        
		 	$("#affichage").html( "<center><div class=\"spinner-border text-dark\" role=\"status\"><span class=\"sr-only\">Chargement...</span></div><p>Recherche en cours...</p></center>" );
		 	var villeDepart = $("#dep").val();
			 var villeArrivee = $("#arr").val();
			 var nbrvoyageurs = $("#nbrvoyageurs").val();
			 

		 	 $.ajax({
		       url : 'newDispatcher.php?action=ajaxRechercheVoyage',
		       data: {depart: villeDepart, arrivee: villeArrivee, nbrvoyageurs: nbrvoyageurs },
		       type : 'POST',
		       dataType : 'html', 
		       success : function(code_html, statut){ 
					
		          $("#affichage").html(code_html);

						let b = document.getElementById("banner").innerHTML = "recherche voyage success"
					
		       },
           error : function(code_html, statut){
            let b = document.getElementById("banner").innerHTML = "recherche voyage error"
           }
			   
	   		});


		 	return false;
		 })
});





</script>
























<!--

  Ville de départ:<br>
  <input type="text" name="dep" id="dep">
  <br>
  Ville d'arrivée:<br>
  <input type="text" name="arr" id="arr">
  <br><br>
  <input type="submit" value="Rechercher" id="btnRechercherVoyages">
</form> 
-->
<!--
<script>
$("#btnRechercherVoyages").click(function(e) {
        const defaultURL = "https://pedago.univ-avignon.fr/~uapv2100360/squelette_L3_V3/squelette_L3/monApplication.php?action=";
        $.ajax({
            type: 'GET',
            cache: false,
            url: defaultURL + "getTrajetByAjax",
            data: {
                depart: $("#inputTextVilleDepart").val(),
                arrivee: $("#inputTextVilleArrivee").val()
            },
            success: function (data, status, xhr) {
                         let obj = JSON.parse(data);
                         if(obj==false)
                         {alert("Error");
						 }
			alert(data);
							
            },
            error: function (jqXhr, textStatus, errorMessage) {
                alert("Error");
            },
            complete: function() {
                alert("Complete");
            }
        });

    })
</script>-->


	










