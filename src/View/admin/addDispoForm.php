<form>
    <div class="form-row">
        <div class="col">
            <label for="jour">Date</label>
            <input type="text" class="form-control" placeholder="jour" id="jour" value="<?php echo date('Y/m/d', strtotime("Today")) ?>" required>
            <small>Format : "Année/Mois/Jour"</small>
        </div>
    </div>
    <br>
    <div class="form-row">
        <div class="col">
            <label for="idSalle">Salle</label>
            <select class="custom-select mr-sm-2" id="idSalle" required>
                <option value="">Choisir une salle</option>
                <?php foreach ($salles as $salle){ ?>
                    <option value="<?= $salle->getId() ?>"><?= $salle->getNumSalle() ?></option>
                <?php } ?>
            </select>

        </div>
        <div class="col">
            <label for="idCreneau">Creneau</label>
            <select class="custom-select mr-sm-2" id="idCreneau" required>
                <option value="">Choisir un créneau</option>
                <?php foreach ($creneaux as $creneau){ ?>
                    <option value="<?= $creneau->getId() ?>"><?= $creneau->getHeureDebut() ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group d-none">
            <label for="token">Token CSRF</label>
            <input type="hidden" class="form-control" name="token" id="token" value="<?php  if(isset($token)){ echo $token;} //Le champ caché a pour valeur le jeton  ?>" readonly>
        </div>
    </div>
</form>


