
    $("#submitReservation").click(function(){
         
        var voyage = $("#voyageChoisi").data("id");
        var voyageur = $("#utilisateur-id").data("id");

        console.log(voyage,voyageur);
         
        $.ajax({
            url : 'newDispatcher.php?action=reserverVoyage',
            data: {voyage: voyage,voyageur: voyageur},
            type : 'GET',
            dataType : 'html',
            success : function(code_html, statut){ 
                console.log(code_html);
                $("#page_maincontent").html(code_html);
                let b = document.getElementById("banner").innerHTML = "Voyage Reserve!!"
            }
            });
            
    });
