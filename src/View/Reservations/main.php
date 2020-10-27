
<?php //var_dump($salles); ?>
<?php //var_dump($creneaux); ?>
<?php //var_dump($dispos); ?>

<br>
<div class="container">
    <div class="row">
        <div class="col-sm">
            Choisissez un jour :
        </div>
        <div class="col-sm">
            <select class="custom-select mr-sm-2" id="selectDate" onchange="afficherResa()">
                <?php $startdate=strtotime("Today");
                $enddate=strtotime("+3 weeks", $startdate);
                while ($startdate < $enddate) {
                    $startdate = strtotime("+1 day", $startdate); ?>
                    <option value="<?php echo date("Y/m/d",$startdate); ?>"> <?php echo date("Y/m/d",$startdate); ?></option>
                <?php } ?>

            </select>
        </div>
        <div class="col-sm">

        </div>
    </div>
</div>
<br>

<div id="table" >

</div>

