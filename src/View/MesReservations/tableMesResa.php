
<table class="table table-bordered table-hover text-center">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Date</th>
        <th scope="col">Creneau</th>
        <th scope="col">Salle</th>
        <th scope="col">Annuler</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach ($mesResa as $resa) { ?>

        <tr <?php if($resa->getJour() == date('Y-m-d', strtotime("Today"))) echo "class='table-info'"; ?>>
            <td><?= date('Y/m/d', strtotime($resa->getJour())) ?></td>
            <td><?= $creneauRepository->find($resa->getIdCreneau())->getHeureDebut() ?></td>
            <th scope="row"><?= $salleRepository->findById($resa->getIdSalle())->getNumSalle() ?></th>
            <td>
                <button type='button' class='btn btn-danger' onclick="annulerUnReservation(<?= $resa->getId() ?>)">Annuler</button>
            </td>
        </tr>
    <?php } ?>

    </tbody>
</table>
