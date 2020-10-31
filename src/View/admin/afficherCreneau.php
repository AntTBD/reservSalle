<h4 class="text-center mb-3" style="color: red;"><u><b>Créneaux</b></u></h4>

<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Heure de début</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>

    <?php foreach ($creneaux as $creneau){ ?>
    <tr>
        <td> <?php echo $creneau->getHeureDebut();?></td>
        <td> <button type="button" class="btn btn-success" data-toggle="modal" onclick="modifCreneau(<?php echo $creneau->getId();?>)"> Modifier </button></td>
    </tr>
    <?php } ?>

    </tbody>
</table>
