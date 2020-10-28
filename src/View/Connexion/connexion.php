<style>
    #securedKeyboard .btnMDP:focus{
        outline: none !important;
        box-shadow: none !important;
        border-color: transparent !important;
        background-color: rgb(108, 117, 125) !important;
    }
    #securedKeyboard .btnMDP:hover{
        background-color: rgb(90, 98, 104) !important;
    }
</style>

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
                <div class="modal-body" id="modalBody">
                    <form method="POST" action="/index.php/connexion" id="formConnexion">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Adresse email</label>
                            <input type="email" class="form-control" name="emailForm" aria-describedby="emailHelp">
                            <small id="emailHelp" class="form-text text-muted">format: exemplee@3il.fr</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mot de passe</label>
                            <input type="password" class="form-control" name="mdpCode" id="mdpInputCode" readonly hidden>
                            <div class="input-group mb-2">
                                <input type="password" class="form-control" id="mdpInput" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text btn btn-secondary" onclick='annuler()'>
                                        <i class="fas fa-backspace"></i>
                                    </span>
                                </div>
                            </div>
                            <small id="mdpHelp" class="form-text text-muted">Gardez le pour vous</small>
                        </div>
                        <input type="hidden" class="form-control" name="token" id="token" value="<?= $token //Le champ caché a pour valeur le jeton  ?>">
                    </form>
                    <!-- keyboard input -->
                    <div id="securedKeyboard" class="text-center">
                        <div class="btn-group-vertical mt-2">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-secondary btnMDP">-</button>
                                <button type="button" class="btn btn-secondary btnMDP">-</button>
                                <button type="button" class="btn btn-secondary btnMDP">-</button>
                                <button type="button" class="btn btn-secondary btnMDP">-</button>
                                <button type="button" class="btn btn-secondary btnMDP">-</button>
                            </div>
                            <br>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-secondary btnMDP">-</button>
                                <button type="button" class="btn btn-secondary btnMDP">-</button>
                                <button type="button" class="btn btn-secondary btnMDP">-</button>
                                <button type="button" class="btn btn-secondary btnMDP">-</button>
                                <button type="button" class="btn btn-secondary btnMDP">-</button>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="connexionBtn" class="btn btn-primary" onclick="submitForm()">Connexion</button>
            </div>
        </div>
    </div>
</div>



<script>

    var tabCorrespondances= <?= json_encode($tabCor) ?>;
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

    function submitForm()
    {
        document.getElementById("formConnexion").submit();
    }

</script>
