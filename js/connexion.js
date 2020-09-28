$(document).ready(function () {

    $("#connexionBtn").click( function() {      //affiche une modal
      loadModal();

    });

});

function loadModal() {
    $("#modal").modal();
    $("#modal").on('shown.bs.modal',function(e){
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

        $.ajax({
            url      : 'http://reservsalle/modals/connexionBody.html',
            type     : 'POST',
            cache		: 	false,
            success 	: 	function(result) {
                $('#modalBody').html(result);
            },
            error : function(){
                alert("eror");
            }
        });
    });
    $("#connexionBtn").click(function () {
        window.location.href = "http://reservsalle/";
    })
}