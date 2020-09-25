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
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Connexion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>