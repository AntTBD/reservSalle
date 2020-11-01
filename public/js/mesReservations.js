var timeoutHandle = setTimeout(function () {}, 1);
function affichageAjaxResult(result){
    $('#resultAjax').html(result);
    clearTimeout(timeoutHandle);// si une popup été déjà affiché, on réinitialise le timeout
    timeoutHandle = setTimeout(function () {
        $('#resultAjax').html("");// au bout de 8s on enlève la popup
    }, 8000);
}

function annulerUnReservation(idReservation) {
    $.ajax({
        url         :   '/index.php/annulerReservation',
        type        :   'POST',
        cache		: 	false,
        data        :   "idReservation="+idReservation,
        success 	: 	function(result) {
            affichageAjaxResult(result);

            afficherMesResa();
        },
        error : function(){
            alert("error");
        }
    });

}


function afficherMesResa() {
    $.ajax({
        url         :   '/index.php/afficherMesReservations',
        type        :   'POST',
        cache		: 	false,
        data        :   false,
        success 	: 	function(result) {
            $('#tableMesReservations').html(result);
        },
        error : function(){
            alert("error");
        }
    });
}

// affichage des resas une fois que tous les scripts (dont jquery) ont été chargés
document.addEventListener("DOMContentLoaded", function(){
    afficherMesResa();
});