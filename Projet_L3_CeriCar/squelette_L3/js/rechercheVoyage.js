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

				  if(statut)
					{
						let b = document.getElementById("banner").innerHTML = "recherche voyage success"
						/*$("#banner").append("");
						$("#banner").addClass("success");*/
						
					}
					else 
					{
						let b = document.getElementById("banner").innerHTML = "error"
						/*$("#banner").append("il y a un erreur quelque part");
						$("#banner").addClass("error");*/
						

					}
		       }
			   
	   		});


		 	return false;
		 })
});














/*$(document).ready(function(){
	$('#hamid').submit(function(){
        
		 	$("#affichage").html( "<center><div class=\"spinner-border text-dark\" role=\"status\"><span class=\"sr-only\">Loading...</span></div><p>Recherche en cours...</p></center>" );
		 	var dep = $("#dep").val();
			 var arr = $("#arr").val();
			 var nbvoy = $("#nbvoyageurs").val();
			 

		 	 $.ajax({
		       url : 'newDispatcher.php?action=getTrajet',
		       data: {dep: dep, arr: arr, nbvoy: nbrvoyageurs },
		       type : 'POST',
		       dataType : 'html', 
		       success : function(code_html, statut){ 
		       	
		          $("#affichage").html(code_html);
		       }
	   		});


		 	return false;
		 })
});

*/




/*$(document).ready(function(){
    xhr=createAjaxObj();

    $('#formRecherche').on('submit',btnRechercherVoyages_Click);
});

 var xhr;
 var dep;
 var arr;



function btnRechercherVoyages_Process(){
    if(xhr.readyState==4 && xhr.status==200){
        var data=xhr.responseText;
        var newContent=$($.parseHTML(data)).find('#getTrajetSuccess').html();
        addView(newContent,"rechercherVoyagesSuccess");
        //addView(newContent,"getTrajetSuccess");
    }
}


function btnRechercherVoyages_Click(){
    dep=$('#inputTextVilleDepart').val();
    arr=$('#inputTextVilleArrivee').val();
    xhr.onreadystatechange=btnRechercherVoyages_Process;
    xhr.open("GET","monApplication.php?action=getTrajet&dep="+dep+"&arr="+arr,true);
    xhr.send(null);
        return false;
}
$(function(){
    $("#trajet").submit(function(){
        console.log("hamiiiiiiiiiid");
        $.ajax({

            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            success:function(data) { $("#page_maincontent").html(data); }
        });

    });

});
*/
/*
$(function(){

    $("#Rechercher").click(function() {
        console.log("Retour ok");

    $.ajax({
            url: $(this).attr('action'),
            success:function(data) { $("#page_maincontent").html(data); 
        }
        });
    });

});*/