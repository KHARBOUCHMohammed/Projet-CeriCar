<div class="container" style="margin-top:15px;">
    <div class="col-lg">
    <div class="col-md-6 mx-auto"> 
    <div class="card card-body">
        <form id="login" method="POST"  >

            <div class="form-group">
               
                <input type="text" class="form-control" id="identifiant" placeholder="Entrez votre Pseudo" name="identifiant" required="required" style="background-color:rgb(237, 237, 237);font-size: 18px;font-weight: 500;font-family: 'Trebuchet MS', serif">
            </div>
            <div class="form-group">
              
            <div class="input-group">
                        <input type="password" placeholder="Entrez votre MDP" name="password" id="password" class="form-control" required="required"  style="background-color:rgb(237, 237, 237);font-size: 18px;font-weight: 500;font-family: 'Trebuchet MS', serif"  >
                          
                        </div>
            </div>
            <div class="form-group" style="text-align:center;">
                <button type="submit" class="btn btn-info" style="font-size: 20px;font-weight: 600;font-family: 'Trebuchet MS', serif" >Se connecter</button>
            </div> 
            </form>
    </div>
    </div>
    </div>
</div>

<script>
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
                          let b = document.getElementById("banner").innerHTML = "identification success"
                         
                      });

                 }
                 
                 });
                

           return  false;
       })
});



</script>