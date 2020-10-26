
<?php //var_dump($salles); ?>
<?php //var_dump($creneaux); ?>
<?php //var_dump($dispos); ?>

<div style="overflow:scroll;height:610px;width:1000px;">
    <table class="table table-bordered">
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
                echo "<tr><th scope='row'>".$creneau->getHeureDebut()."</th>";

                    foreach ($salles as $salle){            //On parcours toutes les salles (les colomnes)

                        if($salle->getDispo() == 1){        //On verifie que la salle est ouverte aux éléves.
                            $salleDispo = $dispoRepository->findBySalle($salle->getId());
                            if($salleDispo != false) {
                                if ($salleDispo[0]->getIdCreneau() == $creneau->getId()) { //EE EE
                                    $salleValid = 1;        //On a trouvé un creneau qui est disponible
                                }
                            }
                        }

                        if($salleValid == 1){               //La salle est dispo
                            $verif = $resas->verifDispoSalle($salle->getNbPlaces(),$salle->getId(),$creneau->getId());
                            if($verif == 1){                //Il reste des places ! on peut reserver
                                echo "<td>disponible   <button type='button' class='btn btn-success'>Réserver</button></td>";
                            }else{                          //Aucune place dispo on ne peux pas reserver
                                echo "<td>indisponible <button type='button' class='btn btn-outline-secondary' disabled>Réserver</button></td>";
                            }
                        }else{
                            echo "<td>indisponible <button type='button' class='btn btn-outline-secondary' disabled>Réserver</button></td>";
                        }
                        $salleValid = 0;
                        $verif = 0;

                    }
                echo "</tr>";
            }?>
        </tbody>
    </table>
</div>

