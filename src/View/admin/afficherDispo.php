<h4 class="text-center mb-3" style="color: red;"><u><b>Disponibilités</b></u></h4>

<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Jour</th>
            <th scope="col">Salle</th>
            <th scope="col">Creneau</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dispos as $dispo){ ?>
        <tr <?php if($dispo->getDate() == date('Y-m-d', strtotime("Today"))) echo "class='table-info'"; ?>>
            <td>
                <?php
                    echo $dispo->getDate();
                ?>
            </td>
            <td> <?php echo $salleRepository->find($dispo->getIdSalle())->getNumSalle(); ?></td>
            <td> <?php echo $creneauRepository->find($dispo->getIdCreneau())->getHeureDebut();?></td>
            <td> <button type="button" class="btn btn-danger" data-toggle="modal" onclick="deleteDispoVerif(<?php echo $dispo->getIdSalle().",".$dispo->getIdCreneau();?>)">Supprimer</button></td>
        </tr>
        <?php } ?>
        <tr>
            <td> Nouvel dispo </td>
            <td> ... </td>
            <td> ... </td>
            <td> <button type="button" class="btn btn-info" data-toggle="modal" onclick="ajouterDispo()"> Ajouter </button> </td>
        </tr>
    </tbody>
</table>
