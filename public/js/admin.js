function closeModal(){
    $('#modal').modal('hide');
    $( "#modalAction" ).off( "click");// remove click event
    $('#modalTitle').html("__Titre__");
    $('#modalBody').html("__Message__");
    $('#modalAction').html("__Action__");
}

function openModal($titre){
    $( "#modalAction" ).off( "click");// remove click event pour etre sur
    $('#modalTitle').html("__Titre__");
    $('#modalBody').html("__Message__");
    $('#modalAction').html("__Action__");

    $('#modalTitle').html($titre);
    $('#modal').modal('show');
}

var timeoutHandle = setTimeout(function () {}, 1);
function affichageAjaxResult(result){
    $('#resultAjax').html(result);
    clearTimeout(timeoutHandle);// si une popup été déjà affiché, on réinitialise le timeout
    timeoutHandle = setTimeout(function () {
        $('#resultAjax').html("");// au bout de 8s on enlève la popup
    }, 8000);
}

//-----------------------------------------------------------------------------------------------

function afficherUser() {
    $.ajax({
        url         :   '/index.php/afficherUser',
        type        :   'POST',
        cache		: 	false,
        data        :   false,
        success 	: 	function(result) {
            $('#tableAdmin').html(result);
        },
        error : function(){
            alert("error");
        }
    });
}

function deleteVerif(idUser) {
    $.ajax({
        url: '/index.php/deleteUserVerif',
        type: 'POST',
        cache: false,
        data: false,
        success: function (result) {
            openModal("Alert");
            let $input = '' +
                '<div class="form-group d-none ">\n' +
                '     <label for="token">Token CSRF</label>\n' +
                '     <input type="hidden" class="form-control" name="token" id="token" value="' + result + '" readonly >\n ' +
                '</div>';
            $('#modalBody').html("Êtes-vous certain de vouloir supprimer cette utilisateur ?<br>" + $input);
            $('#modalAction').html("Supprimer");
            $('#modalAction').click(function (id) {
                supprimer(idUser);
                closeModal();
            });
        },
        error : function(){
            alert("error");
        }
    });
}

function supprimer(idUser) {
    $.ajax({
        url         :   '/index.php/deleteUser',
        type        :   'POST',
        cache		: 	false,
        data        :   "id="+idUser +"&token="+$("#token").val(),
        success 	: 	function(result) {
            affichageAjaxResult(result);
            afficherUser();
        },
        error : function(){
            alert("error");
        }
    });
}

function modifUser(idUser) {
    $.ajax({                                            //On affiche la modal de modification
        url         :   '/index.php/modifierUser',
        type        :   'POST',
        cache		: 	false,
        data        :   "id="+idUser,
        success 	: 	function(result) {
            openModal("Modifier un Utilisateur");
            $('#modalBody').html(result);
            $('#modalAction').html("Modifier");
            $('#modalAction').click(function (id) {
                if($("#email").val() !== "" && $("#admin").val() !== ""){
                    let $addmdp = "";
                    if($("#mdp").val() !== ""){
                        $addmdp="&mdp="+$("#mdp").val();
                    }

                    $.ajax({                                //On modifie en BDD
                        url         :   '/index.php/modiferUserBdd',
                        type        :   'POST',
                        cache		: 	false,
                        data        :   "id="+idUser+"&email="+$("#email").val()+"&admin="+($("#admin").is(":checked")? "1":"0")+$addmdp +"&token="+$("#token").val(),
                        success 	: 	function(result) {
                            closeModal();
                            affichageAjaxResult(result);
                            afficherUser();
                        },
                        error : function(){
                            alert("error");
                        }
                    });
                }else{
                    alert("Remplissez tous champs");
                }
            });
        },
        error : function(){
            alert("error");
        }
    });
}

function ajouterUser() {
    $.ajax({                                            //On affiche la modal d'ajout
        url         :   '/index.php/ajouterUser',
        type        :   'POST',
        cache		: 	false,
        success 	: 	function(result) {
            openModal("Ajouter un Utilisateur");
            $('#modalBody').html(result);
            $('#modalAction').html("Ajouter");
            $('#modalAction').click(function (id) {
                if($("#email").val() !== "" && $("#admin").val() !== "" && $("#mdp").val() !== ""){
                    $.ajax({                                //On modifie en BDD
                        url         :   '/index.php/ajouterUserBdd',
                        type        :   'POST',
                        cache		: 	false,
                        data        :   "email="+$("#email").val()+"&admin="+($("#admin").is(":checked")? "1":"0")+"&mdp="+$("#mdp").val()+"&token="+$("#token").val(),
                        success 	: 	function(result) {
                            closeModal();
                            affichageAjaxResult(result);
                            afficherUser();
                        },
                        error : function(){
                            alert("error");
                        }
                    });
                }else{
                    alert("Remplissez tous champs");
                }
            });
        },
        error : function(){
            alert("error");
        }
    });
}

function afficherDispo() {
    $.ajax({
        url         :   '/index.php/afficherDispo',
        type        :   'POST',
        cache		: 	false,
        success 	: 	function(result) {
            $('#tableAdmin').html(result);
        },
        error : function(){
            alert("error");
        }
    });
}

function deleteDispoVerif(idSalle,idCreneau) {
    $.ajax({
        url: '/index.php/deleteDispoVerif',
        type: 'POST',
        cache: false,
        data: false,
        success: function (result) {
            openModal("Alerte");
            let $input = '' +
                '<div class="form-group d-none ">\n' +
                '     <label for="token">Token CSRF</label>\n' +
                '     <input type="hidden" class="form-control" name="token" id="token" value="' + result + '" readonly >\n ' +
                '</div>';
            $('#modalBody').html("Êtes-vous certain de vouloir supprimer cette disponibilité ?<br>" + $input);
            $('#modalAction').html("Supprimer");
            $('#modalAction').click(function (idS,idC) {
                supprimerDispo(idSalle, idCreneau);
                closeModal();
            });
        },
        error : function(){
            alert("error");
        }
    });

}


function supprimerDispo(idSalle,idCreneau) {
    $.ajax({
        url         :   '/index.php/deleteDispo',
        type        :   'POST',
        cache		: 	false,
        data        :   "idSalle="+idSalle+"&idCreneau="+idCreneau+"&token="+$("#token").val(),
        success 	: 	function(result) {
            affichageAjaxResult(result);
            afficherDispo();
        },
        error : function(){
            alert("error");
        }
    });
}

function ajouterDispo() {
    $.ajax({                                            //On affiche la modal d'ajout
        url         :   '/index.php/ajouterDispo',
        type        :   'POST',
        cache		: 	false,
        success 	: 	function(result) {
            openModal("Ajouter une disponibilité");
            $('#modalBody').html(result);
            $('#modalAction').html("Ajouter");
            $('#modalAction').click(function (id) {
                if($("#idSalle").val() !== "" && $("#idCreneau").val() !== "" && $("#jour").val() !== ""){
                    $.ajax({                                //On modifie en BDD
                        url         :   '/index.php/ajouterDispoBdd',
                        type        :   'POST',
                        cache		: 	false,
                        data        :   "jour="+$("#jour").val()+"&idSalle="+$("#idSalle").val()+"&idCreneau="+$("#idCreneau").val()+"&token="+$("#token").val(),
                        success 	: 	function(result) {
                            closeModal();
                            affichageAjaxResult(result);
                            afficherDispo();
                        },
                        error : function(){
                            alert("error");
                        }
                    });
                }else{
                    alert("Remplissez tous champs");
                }
            });
        },
        error : function(){
            alert("error");
        }
    });
}

function afficherSalles() {
    $.ajax({
        url         :   '/index.php/afficherSalles',
        type        :   'POST',
        cache		: 	false,
        success 	: 	function(result) {
            $('#tableAdmin').html(result);
        },
        error : function(){
            alert("error");
        }
    });
}

function ajouterSalle() {
    $.ajax({                                            //On affiche la modal d'ajout
        url         :   '/index.php/ajouterSalle',
        type        :   'POST',
        cache		: 	false,
        success 	: 	function(result) {
            openModal("Ajouter une salle");
            $('#modalBody').html(result);
            $('#modalAction').html("Ajouter");
            $('#modalAction').click(function (id) {
                if($("#numSalle").val() !== "" && $("#nbPlace").val() !== "" && $("#dispo").val() !== ""){
                    $.ajax({                                //On modifie en BDD
                        url         :   '/index.php/ajouterSalleBdd',
                        type        :   'POST',
                        cache		: 	false,
                        data        :   "numSalle="+$("#numSalle").val()+"&nbPlace="+$("#nbPlace").val()+"&dispo="+($("#dispo").is(":checked")? "1":"0")+"&token="+$("#token").val(),
                        success 	: 	function(result) {
                            closeModal();
                            affichageAjaxResult(result);
                            afficherSalles();
                        },
                        error : function(){
                            alert("error");
                        }
                    });
                }else{
                    alert("Remplissez tous champs");
                }
            });
        },
        error : function(){
            alert("error");
        }
    });
}



function deleteSalleVerif(idSalle) {
    $.ajax({
        url         :   '/index.php/deleteSalleVerif',
        type        :   'POST',
        cache        :     false,
        data        :   false,
        success     :     function(result) {
            openModal("Alerte");
            let $input = '' +
                '<div class="form-group  d-none ">\n'+
                '     <label for="token">Token CSRF</label>\n' +
                '     <input type="hidden" class="form-control" name="token" id="token" value="'+result+'" readonly >\n ' +
                '</div>';
            $('#modalBody').html("Êtes-vous certain de vouloir supprimer cette salle ?<br>"+$input);
            $('#modalAction').html("Supprimer");
            $('#modalAction').click(function (id) {
                supprimerSalle(idSalle);
                closeModal();
            });
        },
        error : function(){
            alert("error");
        }
    });

}

function supprimerSalle(id) {
    $.ajax({
        url         :   '/index.php/deleteSalle',
        type        :   'POST',
        cache        :     false,
        data        :   "id="+id+"&token="+$("#token").val(),
        success     :     function(result) {
            affichageAjaxResult(result);
            afficherSalles();
        },
        error : function(){
            alert("error");
        }
    });
}
function modifSalle(idSalle) {
    $.ajax({                                                //On affiche la modal de modification
        url         :   '/index.php/modifierSalle',
        type        :   'POST',
        cache		: 	false,
        data        :   "id="+idSalle,
        success 	: 	function(result) {
            openModal("Modifier une salle");
            $('#modalBody').html(result);
            $('#modalAction').html("Modifier");
            $('#modalAction').click(function (id) {
                if($("#dispo").val() !== "" && $("#nbPlace").val() !== "" && $("#numSalle") !== ""){
                    $.ajax({                                //On modifie en BDD
                        url         :   '/index.php/modiferSalleBdd',
                        type        :   'POST',
                        cache		: 	false,
                        data        :   "id="+idSalle+"&dispo="+($("#dispo").is(":checked")? "1":"0")+"&nbPlace="+$("#nbPlace").val()+"&numSalle="+$("#numSalle").val()+"&token="+$("#token").val(),
                        success 	: 	function(result) {
                            closeModal();
                            affichageAjaxResult(result);
                            afficherSalles();
                        },
                        error : function(){
                            alert("error");
                        }
                    });
                }else{
                    alert("Remplissez tous champs");
                }
            });
        },
        error : function(){
            alert("error");
        }
    });
}

function afficherCreneau() {
    $.ajax({
        url         :   '/index.php/afficherCreneau',
        type        :   'POST',
        cache		: 	false,
        //data        :   "date="+$("#selectDate").val(),
        success 	: 	function(result) {
            $('#tableAdmin').html(result);
        },
        error : function(){
            alert("error");
        }
    });
}


function modifCreneau(idCreneau) {
    $.ajax({                                                //On affiche la modal de modification
        url         :   '/index.php/modifierCreneau',
        type        :   'POST',
        cache		: 	false,
        data        :   "id="+idCreneau,
        success 	: 	function(result) {
            openModal("Modifier un creneau");
            $('#modalBody').html(result);
            $('#modalAction').html("Modifier");
            $('#modalAction').click(function (id) {
                if($("#heureDebut").val() !== ""){
                    $.ajax({                                //On modifie en BDD
                        url         :   '/index.php/modiferCreneauBdd',
                        type        :   'POST',
                        cache		: 	false,
                        data        :   "id="+idCreneau+"&heureDebut="+$("#heureDebut").val()+"&token="+$("#token").val(),
                        success 	: 	function(result) {
                            closeModal();
                            affichageAjaxResult(result);
                            afficherCreneau();
                        },
                        error : function(){
                            alert("error");
                        }
                    });
                }else{
                    alert("Remplissez tous champs");
                }
            });
        },
        error : function(){
            alert("error");
        }
    });
}
