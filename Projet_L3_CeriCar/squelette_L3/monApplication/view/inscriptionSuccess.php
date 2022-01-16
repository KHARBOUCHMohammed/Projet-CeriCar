<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
                <?php if($context->success) { ?>
              <div class="alert alert-success" role="alert">
                Votre compte a été enregistré veuillez <a href="?action=identifier">vous connecter</a>
              </div>
             <?php } ?>
                <form class="mx-1 mx-md-4" method="POST">
                <form id="inscription" method="POST">
                    <input type="hidden" name="action" value="inscription">
                    <div class="form-row">
                      <div class="col">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" placeholder="Entrez votre nom" name="nom" required="required">
                      </div>
                      <div class="col">
                        <label for="prenom">Prenom</label>
                        <input type="text" class="form-control" placeholder="Entrez votre prénom" name="prenom" required="required">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="identifiant">Pseudo</label>
                      <input type="text" class="form-control" id="pseudo" placeholder="Choisissez un identifiant" name="pseudo" required="required">
                    </div>
                    <div class="form-group">
                      <label for="identifiant">Date de Naissance</label>
                      <input type="date" class="form-control" idrequired="required">
                    </div>
                    <div class="form-group">
                      <label for="password">Mot de passe</label>
                          <div class="input-group">
                                  <input type="password" name="pwd1" placeholder="Entrez un mot de passe" class="form-control" required="required" >
 
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">S'inscrire</button>
                  </form>

              </div>
             
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>