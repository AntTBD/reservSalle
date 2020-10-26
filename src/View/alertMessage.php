<?php
// avant d'appeler cette view :
// penser à declarer $typeAlert (danger, warning, success)
// penser à declarer $messageAlert
?>
<!-- alert -->
<div class="container text-center">
    <div class="row justify-content-center mt-3">
        <div class="alert alert-<?= $typeAlert ?> col-10 col-lg-6">
            <?= $messageAlert ?>
        </div>
    </div>
</div>
<!-- fin alert -->