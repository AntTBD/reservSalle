<form>
    <div class="form-row">
        <div class="col">
            <label for="numSalle">Numéro</label>
            <input type="text" class="form-control" placeholder="Numéro de la salle" id="numSalle" value="<?php if(isset($salle)){ echo $salle->getNumSalle(); } ?>" required>
        </div>
        <div class="col">
            <label for="placeSalle">Nombre de places</label>
            <input type="number" class="form-control" placeholder="Places dans cette salle" id="nbPlace" value="<?php if(isset($salle)){ echo $salle->getNbPlaces(); } ?>">
        </div>
    </div>
    <br>
    <div class="form-row">
        <div class="col">
            <label for="dispo">Disponibilité</label>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="dispo" <?php if(isset($salle)){ if($salle->getDispo()=="1") echo "checked"; }?>>
                <label class="custom-control-label" for="dispo">Dispo</label>
            </div>
            <small>Si une salle est disponible, elle peut-être réservée par des éléves.</small>
        </div>
    </div>
</form>