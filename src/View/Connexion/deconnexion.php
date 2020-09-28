<!-- deconnexion -->
<!-- https://openclassrooms.com/forum/sujet/rediriger-apres-x-secondes-et-afficher-le-nombre-de-secon-35039#message-6572592 -->
<center>
    <h1>Vous avez bien été déconnecté !</h1>
    <p>Redirection dans <span id="compt"></span> seconde<span id="s"></span>.
    <p><a href="/"><button class="btn btn-success" type="button">ACCUEIL</button></a></p>
    <noscript><meta type="refresh" content="5;URL=/" /></noscript>
</center>

<script>
    var compt = document.getElementById('compt'),
        s = document.getElementById('s'),
        durRest = 5;

    function refreshTimer(){
        compt.innerHTML = durRest;
        s.innerHTML = (durRest > 1) ? "s" : null;

        if (durRest <= 0)
            window.location.href = '/';
        else {
            durRest--;
            setTimeout(refreshTimer, 1000);
        }
    }
    refreshTimer();
</script>
<!-- fin deconnexion -->