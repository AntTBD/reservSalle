<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">User</th>
      <th scope="col">Email</th>
      <th scope="col">admin</th>
      <th scope="col">action</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($users as $user){ ?>
    <tr>
            <td> <?php echo $user->getId();?></td>
            <td> <?php echo $user->getEmail();?></td>
            <td> <?php echo $user->getAdmin();?></td>
            <td> <button type="button" class="btn btn-danger" data-toggle="modal" onclick="deleteVerif(<?php echo $user->getId();?>)"> supprimer </button> <button type="button" class="btn btn-success" data-toggle="modal" onclick="modifUser(<?php echo $user->getId();?>)"> modifier </button></td>
    </tr>
  <?php } ?>
    <tr>
        <td> Nouvel utilisateur </td>
        <td> ... </td>
        <td> ... </td>
        <td> <button type="button" class="btn btn-info" data-toggle="modal" onclick="ajouterUser(<?php echo $user->getId();?>)"> ajouter </button> </td>
    </tr>


  </tbody>
</table>
