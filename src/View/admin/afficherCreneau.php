<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">id</th>
      <th scope="col">heure de debut</th>
        <th scope="col">actions</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($creneaux as $creneau){ ?>
    <tr>
            <td> <?php echo $creneau->getId();?></td>
            <td> <?php echo $creneau->getHeureDebut();?></td>
            <td> <button type="button" class="btn btn-success" data-toggle="modal" onclick="modifCreneau(<?php echo $creneau->getId();?>)"> modifier </button></td>
    </tr>
  <?php } ?>


  </tbody>
</table>
