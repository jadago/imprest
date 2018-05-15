<br/>
<br/>

<div class="form-group">
    <label class="col-sm-2 control-label">Top Diagnosis </label>
    <div class="col-sm-10">
        <select class="select-multiple" multiple="multiple" tabindex="2" style="width: 350px;">
            <optgroup label="DIAGNOSIS LIST">
                 <?php
            $en90 = "SELECT * FROM top_diagnosis ORDER BY id ASC";
            $querye90 = mysqli_query($con, $en90);
            while ($arraye90 = mysqli_fetch_array($querye90)) {
                ?>
                <option><?php echo $arraye90['name']; ?></option>
               <?php
            }
            ?>
            </optgroup>
        </select>  
    </div>
</div>
<br/>
<br/>
<br/>
<br/>
<div class="form-group">
    <label class="col-sm-2 control-label">ICD</label>
    <div class="col-sm-10">
        <select  class="select-multiple" multiple="multiple" tabindex="2" style="width:350px;">
            <?php
            $icd = "SELECT * FROM icd ORDER BY short_description ASC LIMIT 100";
            $queryicd = mysqli_query($con, $icd);
            while ($arrayicd = mysqli_fetch_array($queryicd)) {
                ?>
                <option value="<?php echo $arrayicd['id']; ?>"><?php echo $arrayicd['short_description'] . " | | " . $arrayicd['order_no']; ?></option>
                <?php
            }
            ?>

        </select>
    </div>
</div>
<br/>
<br/>
<br/>
<br/>

