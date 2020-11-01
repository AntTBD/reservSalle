
<div class="container">
    <div class="row">
        <div class="col-sm">
            <label for="selectDate">Choisissez un jour :</label>
        </div>
        <div class="col-sm">
            <select class="custom-select mr-sm-2" id="selectDate" onchange="afficherResa()">
                <option value="<?php date('Y/m/d', strtotime("Today")) ?>">Choisir une date</option>
                <?php $startdate=strtotime("Today");
                $enddate=strtotime("+3 weeks", $startdate);
                while ($startdate < $enddate) { ?>
                    <option value="<?php echo date("Y/m/d",$startdate); ?>"> <?php echo date("Y/m/d",$startdate); ?></option>
                <?php $startdate = strtotime("+1 day", $startdate);
                } ?>

            </select>
        </div>
        <div class="col-sm">

        </div>
    </div>
</div>
<br>

<div id="table" >
</div>

<div id="resultAjax" >
</div>

<script src="/js/reservation.js" type="text/javascript"></script>