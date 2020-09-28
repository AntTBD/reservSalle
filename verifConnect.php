<?php

try{
    $db = new PDO('mysql:host=localhost;dbname=reservSalle', 'root', '');
}catch (PDOException $e){
    echo 'connexion a échoué : '.$e->getMessage();
}

$result = $db->query('SELECT * FROM user');


while ($row = $result->fetch(PDO::FETCH_ASSOC)):
    if($row['email'] == $_POST['emailForm']){
        ?>
        <form id="myForm" action="main.php" method="post">
            <?php
            foreach ($_POST as $a => $b) {
                echo '<input type="hidden" name="'.htmlentities($a).'" value="'.htmlentities($b).'">';
            }
            ?>
        </form>
        <script type="text/javascript">
            document.getElementById('myForm').submit();
        </script>

        <?php
    }else{
        $verif = 1;
    }
    endwhile;
    if($verif = 1){
    ?>
    <form id="myForm" action="index.php" method="post">
        <input type="hidden" name="error" value="error">
    </form>
    <script type="text/javascript">
        document.getElementById('myForm').submit();
    </script>
    <?php } ?>


