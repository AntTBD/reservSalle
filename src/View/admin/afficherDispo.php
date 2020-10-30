<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Jour</th>
      <th scope="col">Email</th>
      <th scope="col">admin</th>
      <th scope="col">action</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($dispos as $dispo){ ?>
    <tr>
            <td> <?php echo date('Y/m/d',$dispo->getDate());?></td>
            <td> <?php echo $dispo->getIdSalle();?></td>
            <td> <?php echo $dispo->getIdCreneau();?></td>
        <td> <button type="button" class="btn btn-danger" data-toggle="modal" onclick="deleteDispoVerif(<?php echo $dispo->getIdSalle().",".$dispo->getIdCreneau();?>)">supprimer</button></td>
    </tr>
  <?php } ?>
  <tr>
      <td> Nouvel dispo </td>
      <td> ... </td>
      <td> ... </td>
      <td> <button type="button" class="btn btn-info" data-toggle="modal" onclick="ajouterDispo()"> ajouter </button> </td>
  </tr>

  </tbody>
</table>
