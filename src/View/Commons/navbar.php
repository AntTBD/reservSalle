<nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="/">
        ReservSalle
    </a>
    <a class="navbar-brand" href="#">
        Test
    </a>
        <?php if (isset($_SESSION["id"]) && isset($_SESSION["email"])){?>
    <a href="/index.php/deconnexion">
        <button type="button" class="btn btn-primary">
            Déconnexion
        </button>
    </a>
    <?php } else { ?>
    ?>
    <a>
        <!-- Button trigger modal -->
        <button type="button" id="connexionModalBtn" class="btn btn-primary" data-toggle="modal" data-target="#modal">
            Connexion
        </button>
    </a>
    <?php } ?>

</nav>