function afficherUser() {
    $.ajax({
        url         :   '/index.php/afficherUser',
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

function deleteVerif(idUser) {
    $('#modal').modal('show');
    $('#modalTitle').html("Alerte");
    $('#modalBody').html("Êtes-vous certain de vouloir supprimer cette utilisateur ?");
    $('#modalAction').html("supprimer");
    var id = idUser;
    $('#modalAction').click(function (id) {
        supprimer(idUser);
    });
}

function supprimer(idUser) {
    $.ajax({
        url         :   '/index.php/deleteUser',
        type        :   'POST',
        cache		: 	false,
        data        :   "id="+idUser,
        success 	: 	function(result) {
            afficherUser();
        },
        error : function(){
            alert("error");
        }
    });
}

function modifUser(idUser) {
    var id = idUser;
    $('#modal').modal('show');
    $('#modalTitle').html("Modifier un utilisateur");
    $.ajax({                                            //On affiche la modal de modification
        url         :   '/index.php/modifierUser',
        type        :   'POST',
        cache		: 	false,
        data        :   "id="+idUser,
        success 	: 	function(result) {
            $('#modalBody').html(result);
            $('#modalAction').html("modifier");
            $('#modalAction').click(function (id) {
                if($("#email").val() != "" && $("#admin").val() != ""){
                    $.ajax({                                //On modifie en BDD
                        url         :   '/index.php/modiferUserBdd',
                        type        :   'POST',
                        cache		: 	false,
                        data        :   "id="+idUser+"&email="+$("#email").val()+"&admin="+$("#admin").val(),
                        success 	: 	function(result) {
                            afficherUser();
                            $('#modal').modal('hide');
                        },
                        error : function(){
                            alert("error");
                        }
                    });
                }else{
                    alert("remplissez les deux champs");
                }
            });
        },
        error : function(){
            alert("error");
        }
    });
}

function ajouterUser(idUser) {
    $('#modal').modal('show');
    $('#modalTitle').html("Ajouter un utilisateur");
    $.ajax({                                            //On affiche la modal d'ajout
        url         :   '/index.php/ajouterUser',
        type        :   'POST',
        cache		: 	false,
        success 	: 	function(result) {
            $('#modalBody').html(result);
            $('#modalAction').html("ajouter");
            $('#modalAction').click(function (id) {
                if($("#email").val() != "" && $("#admin").val() != "" && $("#mdp").val() != ""){
                    $.ajax({                                //On modifie en BDD
                        url         :   '/index.php/ajouterUserBdd',
                        type        :   'POST',
                        cache		: 	false,
                        data        :   "id="+idUser+"&email="+$("#email").val()+"&admin="+$("#admin").val()+"&mdp="+$("#mdp").val(),
                        success 	: 	function(result) {
                            afficherUser();
                            $('#modal').modal('hide');
                        },
                        error : function(){
                            alert("error");
                        }
                    });
                }else{
                    alert("remplissez les deux champs");
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
    $('#modal').modal('show');
    $('#modalTitle').html("Alerte");
    $('#modalBody').html("Êtes-vous certain de vouloir supprimer cette disponibilité ?");
    $('#modalAction').html("supprimer");
    var idS = idSalle; var idC = idCreneau;
    $('#modalAction').click(function (idS,idC) {
        supprimerDispo(idSalle,idCreneau);
    });
}

function supprimerDispo(idSalle,idCreneau) {
    $.ajax({
        url         :   '/index.php/deleteDispo',
        type        :   'POST',
        cache		: 	false,
        data        :   "idSalle="+idSalle+"&idCreneau="+idCreneau,
        success 	: 	function(result) {
            afficherDispo();
        },
        error : function(){
            alert("error");
        }
    });
}

function ajouterDispo() {
    $('#modal').modal('show');
    $('#modalTitle').html("Ajouter une disponibilité");
    $.ajax({                                            //On affiche la modal d'ajout
        url         :   '/index.php/ajouterDispo',
        type        :   'POST',
        cache		: 	false,
        success 	: 	function(result) {
            $('#modalBody').html(result);
            $('#modalAction').html("ajouter");
            $('#modalAction').click(function (id) {
                if($("#idSalle").val() != "" && $("#idCreneau").val() != "" && $("#jour").val() != ""){
                    $.ajax({                                //On modifie en BDD
                        url         :   '/index.php/ajouterDispoBdd',
                        type        :   'POST',
                        cache		: 	false,
                        data        :   "jour="+$("#jour").val()+"&idSalle="+$("#idSalle").val()+"&idCreneau="+$("#idCreneau").val(),
                        success 	: 	function(result) {
                            afficherUser();
                            $('#modal').modal('hide');
                        },
                        error : function(){
                            alert("error");
                        }
                    });
                }else{
                    alert("remplissez tous les champs");
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
    $('#modal').modal('show');
    $('#modalTitle').html("Ajouter une salle");
    $.ajax({                                            //On affiche la modal d'ajout
        url         :   '/index.php/ajouterSalle',
        type        :   'POST',
        cache		: 	false,
        success 	: 	function(result) {
            $('#modalBody').html(result);
            $('#modalAction').html("ajouter");
            $('#modalAction').click(function (id) {
                if($("#numSalle").val() != "" && $("#placeSalle").val() != "" && $("#dispo").val() != ""){
                    $.ajax({                                //On modifie en BDD
                        url         :   '/index.php/ajouterSalleBdd',
                        type        :   'POST',
                        cache		: 	false,
                        data        :   "numSalle="+$("#numSalle").val()+"&placeSalle="+$("#placeSalle").val()+"&dispo="+$("#dispo").val(),
                        success 	: 	function(result) {
                            afficherSalles();
                            $('#modal').modal('hide');
                        },
                        error : function(){
                            alert("error");
                        }
                    });
                }else{
                    alert("remplissez bien les champs");
                }
            });
        },
        error : function(){
            alert("error");
        }
    });
}



function deleteSalleVerif(idSalle) {
    $('#modal').modal('show');
    $('#modalTitle').html("Alerte");
    $('#modalBody').html("Êtes-vous certain de vouloir supprimer cette salle ?");
    $('#modalAction').html("supprimer");
    var id = idSalle;
    $('#modalAction').click(function (id) {
        var id = idSalle;
        supprimerSalle(idSalle);
    });
}

function supprimerSalle(id) {
    $.ajax({
        url         :   '/index.php/deleteSalle',
        type        :   'POST',
        cache		: 	false,
        data        :   "id="+id,
        success 	: 	function(result) {
            afficherSalles();
            $('#modal').modal('hide');
        },
        error : function(){
            alert("error");
        }
    });
}

function modifSalle(idSalle) {
    $('#modal').modal('show');
    $('#modalTitle').html("Modifier un utilisateur");
    $.ajax({                                                //On affiche la modal de modification
        url         :   '/index.php/modifierSalle',
        type        :   'POST',
        cache		: 	false,
        data        :   "id="+idSalle,
        success 	: 	function(result) {
            $('#modalBody').html(result);
            $('#modalAction').html("modifier");
            $('#modalAction').click(function (id) {
                if($("#dispo").val() != "" && $("#nbPlace").val() != "" && $("#numSalle") != ""){
                    $.ajax({                                //On modifie en BDD
                        url         :   '/index.php/modiferSalleBdd',
                        type        :   'POST',
                        cache		: 	false,
                        data        :   "id="+idSalle+"&dispo="+$("#dispo").val()+"&nbPlace="+$("#nbPlace").val()+"&numSalle="+$("#numSalle").val(),
                        success 	: 	function(result) {
                            afficherSalles();
                            $('#modal').modal('hide');
                        },
                        error : function(){
                            alert("error");
                        }
                    });
                }else{
                    alert("remplissez les deux champs");
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
    $('#modal').modal('show');
    $('#modalTitle').html("Modifier un creneau");
    $.ajax({                                                //On affiche la modal de modification
        url         :   '/index.php/modifierCreneau',
        type        :   'POST',
        cache		: 	false,
        data        :   "id="+idCreneau,
        success 	: 	function(result) {
            $('#modalBody').html(result);
            $('#modalAction').html("modifier");
            $('#modalAction').click(function (id) {
                if($("#heureDebut").val() != ""){
                    $.ajax({                                //On modifie en BDD
                        url         :   '/index.php/modiferCreneauBdd',
                        type        :   'POST',
                        cache		: 	false,
                        data        :   "id="+idCreneau+"&heureDebut="+$("#heureDebut").val(),
                        success 	: 	function(result) {
                            afficherCreneau();
                            $('#modal').modal('hide');
                        },
                        error : function(){
                            alert("error");
                        }
                    });
                }else{
                    alert("remplissez les deux champs");
                }
            });
        },
        error : function(){
            alert("error");
        }
    });
}
