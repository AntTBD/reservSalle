<?php
include 'header.php';
?>

<nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
        ReservSalle
    </a>
    <a class="navbar-brand" href="#">
        Bitedetoro
    </a>
    <a>
        <!-- Button trigger modal -->
        <button type="button" id="connexionBtn" class="btn btn-primary" data-toggle="modal" data-target="#modal">
            connexion
        </button>
    </a>

</nav>


<h1 style="text-align: center; font-style: italic; color: #ea9800; font-size: 120px">Bienvenue sur</h1>
<h1 style="text-align: center; font-family: Impact, fantasy; color: #28a2db; font-weight: 900; font-size: 150px;">reservSalle 3iL</h1>
<div class="container">
    <div class="row">
        <div class="col-3">
        </div>
        <div class="col-6">
            <img src="https://iutp.univ-poitiers.fr/gmp/wp-content/uploads/sites/237/2014/05/salle_CAO.jpg" class="img-fluid" alt="Responsive image">
        </div>
        <div class="col-3">
        </div>
    </div>
</div>


<div class="alert alert-primary" role="alert">
    A simple primary alert—check it out!
</div>



<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" id="modalHeader">

            </div>
            <div class="modal-body" id="modalBody">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="connexionBtn" type="button" class="btn btn-primary">Connexion</button>
            </div>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>

