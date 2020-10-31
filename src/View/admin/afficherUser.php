<h4 class="text-center mb-3" style="color: red;"><u><b>Utilisateurs</b></u></h4>

<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Email</th>
            <th scope="col">Admin</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user){ ?>
        <tr>
            <td> <?php echo $user->getEmail();?></td>
            <td>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheckDisabled<?php echo $user->getId();?>" <?php if($user->getAdmin()=="1") echo "checked";?> disabled>
                    <label class="custom-control-label" for="customCheckDisabled<?php echo $user->getId();?>"></label>
                </div>
            </td>
            <td>
                <button type="button" class="btn btn-danger" data-toggle="modal" onclick="deleteVerif(<?= $user->getId() ?>)"> Supprimer </button>
                <button type="button" class="btn btn-success" data-toggle="modal" onclick="modifUser(<?= $user->getId() ?>)"> Modifier </button>
            </td>
        </tr>
        <?php } ?>
        <tr>
            <td> Nouvel utilisateur </td>
            <td> ... </td>
            <td> <button type="button" class="btn btn-info" data-toggle="modal" onclick="ajouterUser()"> Ajouter </button> </td>
        </tr>
    </tbody>
</table>
