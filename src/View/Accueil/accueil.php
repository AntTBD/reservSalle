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
                            <input type="password" class="form-control" id="mdpInput" readonly>
                            <div class="input-group-append">
                                <span class="input-group-text btn btn-secondary" onclick='annuler()'>
                                    <i class="fas fa-backspace"></i>
                                </span>
                            </div>
                        </div>
                        <input type="password" class="form-control" name="mdp" id="mdpInputCode" readonly hidden>

                        <small id="emailHelp" class="form-text text-muted">Gardez le pour vous</small>
                        <!-- keyboard input -->
                        <div id="securedKeyboard" class="text-center">
                            <div class="btn-group-vertical mt-2">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-secondary">-</button>
                                    <button type="button" class="btn btn-secondary">-</button>
                                    <button type="button" class="btn btn-secondary">-</button>
                                    <button type="button" class="btn btn-secondary">-</button>
                                    <button type="button" class="btn btn-secondary">-</button>
                                </div>
                                <br>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-secondary">-</button>
                                    <button type="button" class="btn btn-secondary">-</button>
                                    <button type="button" class="btn btn-secondary">-</button>
                                    <button type="button" class="btn btn-secondary">-</button>
                                    <button type="button" class="btn btn-secondary">-</button>
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

    var tabCorrespondances= <?= json_encode($_SESSION['tab']) ?>;
    var tabIndices = Array('0','1','2','3','4','5','6','7','8','9');

    var mdpInput = document.getElementById('mdpInput');
    var mdpInputCode = document.getElementById('mdpInputCode');

    function createClavier(){

        mdpInput.value='';
        mdpInputCode.value='';
        var allElements = document.getElementById('securedKeyboard').getElementsByTagName('button');

        for (var i = 0; i< allElements.length; i++){

            if(tabIndices.length<1){
                allElements[i].innerText="Error";
                allElements[i].id='secu_id_' + "Error" + '';
            } else {
                let indice=Math.round(Math.random()*(tabIndices.length-1));
                allElements[i].innerText=tabIndices[indice];
                tabIndices.splice(indice, 1);
                allElements[i].id='secu_id_' + i + '';
            }
            //allElements[i].id='secu_id_' + i + '';
            allElements[i].addEventListener('click',function ()
            {
                addToInput(this.id);
            });
        }
    }

    function addToInput(lui){
        mdpInput.value += document.getElementById(lui).innerText;
        mdpInputCode.value += tabCorrespondances[document.getElementById(lui).innerText];
    }

    function annuler(){
        let tempMdp = mdpInput.value;
        let mdpWithoutLastChar = '';
        for (let i = 0; i < tempMdp.length-1; i++) {
            mdpWithoutLastChar+=tempMdp[i];
        }
        mdpInput.value=mdpWithoutLastChar;

        let tempMdpCode = mdpInputCode.value;
        let mdpWithoutLastCharCode = '';
        for (let i = 0; i < tempMdpCode.length-tabCorrespondances[0].length; i++) {
            mdpWithoutLastCharCode+=tempMdpCode[i];
        }
        mdpInputCode.value=mdpWithoutLastCharCode;
    }

    createClavier();

</script>