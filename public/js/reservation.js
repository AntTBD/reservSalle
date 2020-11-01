
var timeoutHandle = setTimeout(function () {}, 1);
function affichageAjaxResult(result){
    $('#resultAjax').html(result);
    clearTimeout(timeoutHandle);// si une popup été déjà affiché, on réinitialise le timeout
    timeoutHandle = setTimeout(function () {
        $('#resultAjax').html("");// au bout de 8s on enlève la popup
    }, 8000);
}

function afficherResa() {
    $.ajax({
        url         :   '/index.php/afficherReservation',
        type        :   'POST',
        cache		: 	false,
        data        :   "date="+$("#selectDate").val(),
        success 	: 	function(result) {
            $('#table').html(result);
        },
        error : function(){
            alert("error");
        }
    });
}

function reservation(idSalle,idCreneau,idUser) {
    $.ajax({
        url         :   '/index.php/reservationBDD',
        type        :   'POST',
        cache		: 	false,
        data        :   "idUser="+idUser+"&idCreneau="+idCreneau+"&idSalle="+idSalle+"&date="+$("#date").val(),
        success 	: 	function(result) {
            afficherResa();
            affichageAjaxResult(result);
        },
        error : function(){
            alert("error");
        }
    });

}