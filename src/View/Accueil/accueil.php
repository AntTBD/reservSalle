<?php if(isset($_SESSION["state"])){if($_SESSION["state"] == "errorMdp"){echo "<div class='alert alert-danger' role='alert'>Connexion impossible, veuillez réessayer</div>";}} ?>

    <h1 style="text-align: center; font-style: italic; color: #ea9800; font-size: 120px">Bienvenue sur</h1>
    <h1 style="text-align: center; font-family: Impact, fantasy; color: #28a2db; font-weight: 900; font-size: 150px;">reservSalle 3iL</h1>
    <div class="container">
        <div class="row">
            <div class="col-3">
            </div>
            <div class="col-6">
                <img src="https://iutp.univ-poitiers.fr/gmp/wp-content/uploads/sites/237/2014/05/salle_CAO.jpg" class="img-fluid" alt="Responsive image">
            </div>
            <div class="col-3">
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" id="modalHeader">
                    <h5 class="modal-title" id="exampleModalLabel">Connexion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="/index.php/verifConnect">
                    <div class="modal-body" id="modalBody">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Adresse email</label>
                            <input type="email" class="form-control" name="emailForm" aria-describedby="emailHelp">
                            <small id="emailHelp" class="form-text text-muted">format: exemplee@3il.fr</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mot de passe</label>
                            <input type="password" class="form-control"  name="mdp">
                            <small id="emailHelp" class="form-text text-muted">Gardez le pour vous</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="connexionBtn" type="submit" class="btn btn-primary">Connexion</button>

                    </div>
                </form>
            </div>
        </div>
    </div>