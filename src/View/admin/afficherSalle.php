<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Salle</th>
      <th scope="col">Places disponible (par salle)</th>
      <th scope="col">Disponibilité</th>
      <th scope="col">action</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($salles as $salle){ ?>
    <tr>
            <td> <?php echo $salle->getNumSalle();?></td>
            <td> <?php echo $salle->getNbPlaces();?></td>
            <td> <?php echo $salle->getDispo();?></td>
            <td> <button type="button" class="btn btn-danger" data-toggle="modal" onclick="deleteSalleVerif(<?php echo $salle->getId();?>)"> supprimer </button> <button type="button" class="btn btn-success" data-toggle="modal" onclick="modifSalle(<?php echo $salle->getId();?>)"> modifier </button></td>
    </tr>
  <?php } ?>
    <tr>
        <td> Nouvel utilisateur </td>
        <td> ... </td>
        <td> ... </td>
        <td> <button type="button" class="btn btn-info" data-toggle="modal" onclick="ajouterSalle(<?php echo $salle->getId();?>)"> ajouter </button> </td>
    </tr>


  </tbody>
</table>
