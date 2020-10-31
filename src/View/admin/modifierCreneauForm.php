<form>
    <div class="form-row">
        <div class="col">
            <label for="heureDebut">Créneau</label>
            <input type="text" class="form-control" placeholder="heureDebut" id="heureDebut" value="<?php if(isset($creneau)){ echo $creneau->getHeureDebut(); } ?>">
            <div class="form-group d-none">
                <label for="token">Token CSRF</label>
                <input type="hidden" class="form-control" name="token" id="token" value="<?php  if(isset($token)){ echo $token;} //Le champ caché a pour valeur le jeton  ?>" readonly>
            </div>
        </div>
    </div>
</form>