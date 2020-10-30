<?php
include __DIR__ . '/../../../includes/function.php';
?>
<header>
    <!-- NavBar -->
    <nav class="navbar sticky-top navbar-expand-sm navbar-dark bg-dark" id="myNavBar">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="navbar-brand" href="/">
                ReservSalle
            </a>
            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <?php if (isset($_SESSION["id"]) && isset($_SESSION["email"])){?>
                <ul class="navbar-nav">
                    <li class="nav-item <?php if (isActive("index.php/reservation")) { echo "active"; } ?>">
                        <a class="nav-link" href="/index.php/reservation">Reserver</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item ">
                        <a class="nav-link <?php if (isActive("index.php/mesreservations")) { echo "active"; } ?>" href="/index.php/mesreservations">Mes Reservations</a>
                    </li>
                </ul>
                <?php if(isset($_SESSION["admin"])){
                    if($_SESSION["admin"] == 1){ ?>
                        <ul class="navbar-nav">
                            <li class="nav-item ">
                                <a class="nav-link <?php if (isActive("index.php/admin")) { echo "active"; } ?>" href="/index.php/admin">Admin</a>
                            </li>
                        </ul>
                        <?php }} ?>
                <?php } ?>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item ">
                        <?php if (isset($_SESSION["id"]) && isset($_SESSION["email"])){ ?>
                        <a href="/index.php/deconnexion" class="btn btn-primary">
                            <i class="fa fa-sign-out-alt" aria-hidden="true"></i> Déconnexion
                        </a>
                        <?php } else {
                            if ('/index.php' == $uri || '/' == $uri) { ?>
                            <!-- Button trigger modal -->
                            <button type="button" id="connexionModalBtn" class="btn btn-primary" data-toggle="modal" data-target="#modal">
                                Connexion
                            </button>
                            <?php }
                        } ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Fin NavBar -->
</header>