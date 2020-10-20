<?php
/*if (isset($_SESSION["state"])) {
    if ($_SESSION["state"] == "errorMdp") {
        echo "<div class='alert alert-danger' role='alert'>Connexion impossible, veuillez réessayer</div>";
    }
}*/ ?>

<h1 style="text-align: center; font-style: italic; color: #ea9800; font-size: 120px">Bienvenue sur</h1>
<h1 style="text-align: center; font-family: Impact, fantasy; color: #28a2db; font-weight: 900; font-size: 150px;">
    reservSalle 3iL</h1>
<div class="container">
    <div class="row">
        <div class="col-3">
        </div>
        <div class="col-6">
            <img src="https://iutp.univ-poitiers.fr/gmp/wp-content/uploads/sites/237/2014/05/salle_CAO.jpg"
                 class="img-fluid" alt="Responsive image">
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
                        <div class="input-group mb-2">
                            <input type="password" class="form-control" name="mdp" id="mdpInput" readonly>
                            <div class="input-group-append">
                                <span class="input-group-text btn btn-secondary" onclick='annuler()'>
                                    <i class="fas fa-backspace"></i>
                                </span>
                            </div>
                        </div>
                        <small id="emailHelp" class="form-text text-muted">Gardez le pour vous</small>
                        <!-- keyboard input -->
                        <div id="securedKeyboard" class="text-center">
                            <div class="btn-group-vertical mt-2">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-secondary">0</button>
                                    <button type="button" class="btn btn-secondary">0</button>
                                    <button type="button" class="btn btn-secondary">0</button>
                                    <button type="button" class="btn btn-secondary">0</button>
                                    <button type="button" class="btn btn-secondary">0</button>
                                </div>
                                <br>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-secondary">0</button>
                                    <button type="button" class="btn btn-secondary">0</button>
                                    <button type="button" class="btn btn-secondary">0</button>
                                    <button type="button" class="btn btn-secondary">0</button>
                                    <button type="button" class="btn btn-secondary">0</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="connexionBtn" type="submit" class="btn btn-primary" onclick="submitForm()">Connexion</button>

                </div>
            </form>
        </div>
    </div>
</div>



<script>

    tabChiffres=new Array(0,1,2,3,4,5,6,7,8,9);
    //tbimageCorrespondance=new Array('A','B','C','D','E','F','G','H','I','J');
    tabLettres=<?= json_encode($tabCorrespondance) ?>;

    function createClavier(){

        document.getElementById('mdpInput').value='';
        var allElements = document.getElementById('securedKeyboard').getElementsByTagName('button');

        for (var i = 0; i< allElements.length; i++){

            if(tabChiffres.length===1){
                allElements[i].firstChild.nodeValue=tabChiffres[0];
            }
            else{
                var spl=Math.round(Math.random()*(tabChiffres.length-1));
                allElements[i].firstChild.nodeValue=tabChiffres[spl];
                tabChiffres.splice(spl,1);
            }
            allElements[i].id='secu_id_' + i + '';
            allElements[i].addEventListener('click',function ()
            {
                addToInput(this.id);
            });
        }
    }

    function addToInput(lui){
        var input=document.getElementById('mdpInput');
        input.value+=tabLettres[document.getElementById(lui).firstChild.nodeValue]
    }

    function annuler(){
        var tempMdp = document.getElementById("mdpInput").value;
        var mdpWithoutLastChar = '';
        for (let i = 0; i < tempMdp.length-1; i++) {
            mdpWithoutLastChar+=tempMdp[i];
        }
        document.getElementById("mdpInput").value=mdpWithoutLastChar;
    }

    createClavier();

</script>