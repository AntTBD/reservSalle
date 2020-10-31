<h4 class="text-center mb-3" style="color: red;"><u><b>Salles</b></u></h4>

<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Salle</th>
            <th scope="col">Places disponibles (par salle)</th>
            <th scope="col">Disponibilité</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($salles as $salle){ ?>
        <tr>
            <td> <?php echo $salle->getNumSalle();?></td>
            <td> <?php echo $salle->getNbPlaces();?></td>
            <td>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheckDisabled<?php echo $salle->getId();?>" <?php if($salle->getDispo()=="1") echo "checked";?> disabled>
                    <label class="custom-control-label" for="customCheckDisabled<?php echo $salle->getId();?>"></label>
                </div>
            </td>
            <td>
                <button type="button" class="btn btn-danger" data-toggle="modal" onclick="deleteSalleVerif(<?php echo $salle->getId();?>)"> Supprimer </button>
                <button type="button" class="btn btn-success" data-toggle="modal" onclick="modifSalle(<?php echo $salle->getId();?>)"> Modifier </button>
            </td>
        </tr>
        <?php } ?>
        <tr>
            <td> Nouvel salle </td>
            <td> ... </td>
            <td> ... </td>
            <td> <button type="button" class="btn btn-info" data-toggle="modal" onclick="ajouterSalle(<?php echo $salle->getId();?>)"> Ajouter </button> </td>
        </tr>
    </tbody>
</table>
