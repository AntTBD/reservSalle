$( document ).ready(function() {

});

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

function reservation(idSalle,idCreneau,idUser,date) {
    $.ajax({
        url         :   '/index.php/reservationBDD',
        type        :   'POST',
        cache		: 	false,
        data        :   "idUser="+idUser+"&idCreneau="+idCreneau+"&idSalle="+idSalle+"&date="+$("#date").val(),
        success 	: 	function(result) {
            toastr.success("youpi!!!!!!!!!!");
            afficherResa();
        },
        error : function(){
            alert("error");
        }
    });

}



/*
 $.ajax({
            url      : 'http://reservsalle/modals/connexionHead.html',
            type     : 'POST',
            cache		: 	false,
            success 	: 	function(result) {
                $('#modalHeader').html(result);
            },
            error : function(){
                alert("eror");
            }
        });
 */