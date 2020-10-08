<p>Aujourd'hui nous sommes le <?php echo date('d/m/Y h:i:s'); ?>.</p>

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

            <?php foreach ($creneaux as $creneau){
                echo "<tr><th scope='row'>".$creneau->getHeureDebut()."</th>";

                    foreach ($salles as $salle){
                        foreach ($dispos as $dispo){
                            $salleNb = $salle->getNbPlaces();
                            if($dispo->getIdSalle() == $salle->getId() && $dispo->getIdCreneau() == $creneau->getId()){
                                $salleNb--;
                            }
                        }
                        // /!\ EN TRAVEAUX /!\
                        if($salleNb > 0){
                            echo "<td>disponible   <button type='button' class='btn btn-outline-secondary'>Réserver</button></td>";
                        }else{
                            echo "<td>indisponible   <button type='button' class='btn btn-outline-secondary' disabled>Réserver</button></td>";
                        }
                        // /!\ EN TRAVEAUX /!\
                    }

                echo "</tr>";
            }?>

        </tbody>
    </table>

</div>

