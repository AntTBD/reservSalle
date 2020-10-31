
<form>
    <div class="form-row">
        <div class="col">
            <label for="email">Email</label>
            <input type="email" class="form-control" placeholder="Email de l'utilisateur" id="email" value="<?php if(isset($user)){ echo $user->getEmail(); } ?>" required>
        </div>
        <div class="col">
            <label for="admin">Status</label>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="admin" <?php if(isset($user)){ if($user->getAdmin()=="1") echo "checked"; }?>>
                <label class="custom-control-label" for="admin">Admin</label>
            </div>
        </div>
    </div>
    <br>
    <div class="form-row">
        <div class="col">
            <label for="mdp">Mot de passe</label>
            <input type="password" class="form-control" placeholder="<?php if(isset($user)){ echo "Laisser vide pour ne pas le modifier !"; }else{ echo "Mot de passe "; } ?>" id="mdp">
            <small>Penser a crypter le mot de passe!</small>
        </div>
    </div>
</form>