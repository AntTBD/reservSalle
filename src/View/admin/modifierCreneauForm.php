<form>
    <div class="form-row">
        <div class="col">
            <label for="heureDebut">Créneau</label>
            <input type="text" class="form-control" placeholder="heureDebut" id="heureDebut" value="<?php if(isset($creneau)){ echo $creneau->getHeureDebut(); } ?>">
        </div>
    </div>
</form>