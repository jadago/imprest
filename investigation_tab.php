<style>
    .remove{
        background: #C76868;
        color: #FFF;
        font-weight: bold;
        font-size: 21px;
        border: 0;
        cursor: pointer;
        display: inline-block;
        padding: 4px 9px;
        vertical-align: top;
        line-height: 100%;   
    }
    .addfields{
        background: green;
        color: #FFF;
        font-weight: bold;
        font-size: 21px;
        border: 0;
        cursor: pointer;
        display: inline-block;
        padding: 4px 9px;
        vertical-align: top;
        line-height: 100%;   
    }
</style>
<br>
<br>
<div ng-app="myapp" ng-controller="MainCtrl"> 
    <fieldset  ng-repeat="column in columns">
        <div class="form-group">
            <label class="col-sm-2 control-label">Procedures</label>
            <div class="col-sm-10">
                <select  class="select1" name="proc[]" style="width:350px;">
                    <option value="">-- Select Procedures--</option>
                    <?php
                    $p = "SELECT * FROM procedures ORDER BY name ASC";
                    $queryp = mysqli_query($con, $p);
                    while ($arrayp = mysqli_fetch_array($queryp)) {
                        ?>
                        <option value="<?php echo $arrayp['id']; ?>"><?php echo $arrayp['name']." - ".number_format($arrayp['price'],0); ?></option>
                        <?php
                    }
                    ?>

                </select>
                
                <button type="button" class="addfields" ng-click="addNewColumn()">+</button>
                <button type="button" class="remove"  ng-click="removeColumn($index)">x</button> 
            </div>

        </div>
    </fieldset>
</div>
<br/>
<div class="form-group">
    <label class="col-sm-2 control-label">Priority</label>
    <div class="col-sm-10">
        <select  class="select1" name="a11" required style="width:350px;">
            <option value="0" selected="selected">Select Priority</option>
            <?php
            require_once('includes/db_conn.php');
            $en9 = "SELECT * FROM preloaded_priority ORDER BY id ASC";
            $querye9 = mysqli_query($con, $en9);
            while ($arraye9 = mysqli_fetch_array($querye9)) {
                ?>
                <option value="<?php echo $arraye9['id']; ?>"<?php if ($arraye9['id'] == $arraylast['prio']) echo "selected=\"selected\""; ?>><?php echo $arraye9['name']; ?></option>
                <?php
            }
            ?>

        </select>
    </div>
</div>
<br/>
<br/>
<div class="form-group">
    <label class="col-sm-2 control-label">&nbsp;</label>
    <div class="col-sm-4">
        <div class="radio">
            <label>
                <input type="radio" name="billing" value="1" >
                Send to Billing
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="billing" value="2">
                Save Records
            </label>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label"></label>
    <div class="col-sm-10">
        <input type="submit" name="Submit" value="Save Record" class="btn btn-primary"/>
        <input name="reg_no" type="hidden" value="<?php echo $array['reg_no'];?>" />
        <input name="patient_id" type="hidden" value="<?php echo $_GET['patient_id'];?>" />
        <input name="addedby" type="hidden" value="<?php echo $_SESSION['userid']; ?>"/>
    </div>
</div>

<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>

