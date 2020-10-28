
<table class="table table-bordered table-hover text-center">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Salle</th>
        <th scope="col">Date</th>
        <th scope="col">Creneau</th>
        <th scope="col">Annuler</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach ($mesResa as $resa) { ?>

        <tr>
            <th scope="row"><?= $salleRepository->findById($resa->getIdSalle())->getNumSalle() ?></th>
            <td><?= $resa->getJour() ?></td>
            <td><?= $creneauRepository->findById($resa->getIdCreneau())->getHeureDebut() ?></td>
            <td>
                <button type='button' class='btn btn-danger' onclick="annulerUnReservation(<?= $resa->getId() ?>)">Annuler</button>
            </td>
        </tr>
    <?php } ?>

    </tbody>
</table>
