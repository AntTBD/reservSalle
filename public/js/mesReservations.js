var timeoutHandle = setTimeout(function () {}, 1);

function affichageAjaxResult(result){
    $('#resultAjax').html(result);
    clearTimeout(timeoutHandle);
    timeoutHandle = setTimeout(function () {
        $('#resultAjax').html("");
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
            //window.location.href = '/index.php/mesreservations';
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

$( document ).ready(function() {
    afficherMesResa();
});