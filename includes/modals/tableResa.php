<?php $date = $_POST["date"]; //String contenant la date selectionné?>

<input id="date" value="<?php echo $date?>" hidden>
<style>
    #table_resa th:first-child
    {
        position:sticky;
        z-index: 1;
        left:1px;
    }
</style>
<div class="table-responsive">
<table class="table table-bordered" id="table_resa">
    <thead class="thead-dark" style="table-layout:fixed; text-align:center;vertical-align:";  >
    <div id =test >
        <tr>
            <th scope="col">Creneaux</th>
            <?php foreach ($salles as $salle){
                echo "<th scope='col'>".$salle->getNumSalle()."</th>";
            } ?>
        </tr>
    </div>
    </thead>
    <tbody>

    <?php $verif = 0; $salleValid = 0;
    foreach ($creneaux as $creneau){                //On affiche tout les creneaux (les lignes)
        echo "<tr><th scope='row' class='table-dark'>".$creneau->getHeureDebut()."</th>";

        foreach ($salles as $salle){            //On parcours toutes les salles (les colomnes)
            $salleValid = 0;
            if($salle->getDispo() == 1){        //On verifie que la salle est ouverte aux éléves.
                $salleDispo = $dispoRepository->findBySalle($salle->getId(),$date);
                if($salleDispo != false) {
                    foreach ($salleDispo as $salleX){
                        if ($salleX->getIdCreneau() == $creneau->getId()) { //je verifie si la salle qui a été trouvé est au bon créneau!
                            $salleValid = 1;        //On a trouvé un creneau qui est disponible
                        }
                    }
                }
            }
            $verif = 0;
            if($salleValid == 1){               //La salle est dispo
                $verif = $resas->verifDispoSalle($salle->getNbPlaces(),$salle->getId(),$creneau->getId(),$date,$_SESSION["id"]);
                if($verif == 2){
                    echo "<td>Disponible<br><button type='button' class='btn btn-warning' >Déja réserver</button></td>";
                }elseif($verif == 1 ){                //Il reste des places ! on peut reserver
                    $idSalle = $salle->getId();
                    $idCreneau = $creneau->getId();
                    $idUser = $_SESSION["id"];
                    echo "<td>Disponible<br><button type='button' class='btn btn-success' onclick='reservation($idSalle,$idCreneau,$idUser)'>Réserver</button></td>";
                }else{                          //Aucune place dispo on ne peux pas reserver
                    echo "<td><span style='color: red'>Creneau indisponible</span><br><button type='button' class='btn btn-secondary' disabled>Réserver</button></td>";
                }
            }else{
                echo "<td>Salle indisponible<br><button type='button' class='btn btn-secondary' disabled>Réserver</button></td>";
            }


        }
        echo "</tr>";
    }?>
    </tbody>
</table>
</div>