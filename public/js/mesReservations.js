function annulerUnReservation(idReservation) {
    $.ajax({
        url         :   '/index.php/annulerReservation',
        type        :   'POST',
        cache		: 	false,
        data        :   "idReservation="+idReservation,
        success 	: 	function(result) {
            $('#success').html(result);
            afficherMesResa();
        },
        error : function(){
            alert("error");
            window.location.href = '/index.php/mesreservations';
        }
    });

}


function afficherMesResa() {
    $.ajax({
        url         :   '/index.php/afficherMesReservations',
        type        :   'POST',
        cache		: 	false,
        data        :   "",
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