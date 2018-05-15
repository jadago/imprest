
<?php 
if ($_GET['r'] == 0)
{
echo "Please select Value!";
}
else if($_GET['q'] == 1)
{
?><table width="100%">
  <tr>
    <td width="2%"><strong>#</strong></td>
    <td width="30%" align="left"><strong>Description</strong></td>
    <td width="30%" align="left"><strong>Quantity</strong></td>
    <td width="38%" align="left"><strong>Rate/Per Item</strong></td>
    </tr>
  <?php 
  for ($i=1; $i <= $_GET['r']; $i++)
  {
  if ($i % 2 != 0)
  {
  ?>
  <tr bgcolor="#F5F5F5">
    <td valign="top"><strong><?php echo $i; ?></strong></td>
    <td valign="top"><label></label>
      <label for="textarea"></label>
    <textarea name="d<?php echo $i; ?>" cols="30" rows="3"></textarea></td>
    <td valign="top" align="center"><label for="textfield"></label>
    <input type="text" name="quantity<?php echo $i; ?>"  class="innerInputs mustValue" autocomplete="off" /></td>
    <td align="center" valign="top"><label for="textfield3"></label>
      <input type="text" name="rate<?php echo $i; ?>" class="innerInputs mustValue" autocomplete="off" /></td>
    </tr>
  <?php 
  } 
  else {
  ?>
  <tr bgcolor="#FCFCFC">
    <td valign="top"><strong><?php echo $i; ?></strong></td>
    <td valign="top"><textarea name="d<?php echo $i; ?>" cols="30" rows="3"></textarea></td>
    <td valign="top" align="center"><label for="textfield2"></label>
    <input type="text" name="quantity<?php echo $i; ?>" class="innerInputs mustValue" autocomplete="off" /></td>
    <td align="center" valign="top"><label for="textfield4"></label>
      <input type="text" name="rate<?php echo $i; ?>" class="innerInputs mustValue" autocomplete="off" /></td>
    </tr>
  <?php 
  }//close else statement
  }//close for loop
  ?>
  <input name="total" type="hidden" value="<?php echo $_GET['r']; ?>" />
</table>
<?php 
}//close if for $_GET['q'] == 1

elseif($_GET['q'] == 1900)
{
?>
<table width="37%">
  <tr>
    <td width="12%"><strong>#</strong></td>
    <td width="88%" align="left"><strong>Diagnosis</strong></td>
  </tr>
  <?php 
  for ($i=1; $i <= $_GET['r']; $i++)
  {
  if ($i % 2 != 0)
  {
  ?>
  <tr bgcolor="#F5F5F5">
    <td valign="top"><strong><?php echo $i; ?></strong></td>
    <td valign="top"><label></label>      <label>
    <select name="a500<?php echo $i;?>" class="innerInputs selectbox" style="width:300px;" id="myselect">
      <option value="0" selected="selected">Select ICD</option>
      <?php
		  require_once('includes/db_conn.php');
		  $icd="SELECT * FROM icd ORDER BY short_description ASC";
		  $queryicd=mysql_query($icd);
		  while($arrayicd=mysql_fetch_array($queryicd))
		  {
		  ?>
      <option value="<?php echo $arrayicd['id'];?>"><?php echo $arrayicd['short_description']." | | ".$arrayicd['order_no'];?></option>
      <?php
		  }
		  ?>
    </select>
    </label></td>
  </tr>
  <?php 
  } 
  else {
  ?>
  <tr bgcolor="#FCFCFC">
    <td valign="top"><strong><?php echo $i; ?></strong></td>
    <td valign="top"><label>
    <select name="a500<?php echo $i;?>" class="innerInputs selectbox" style="width:300px;" id="myselect">
      <option value="0" selected="selected">Select ICD</option>
      <?php
		  require_once('includes/db_conn.php');
		  $icd="SELECT * FROM icd ORDER BY short_description ASC";
		  $queryicd=mysql_query($icd);
		  while($arrayicd=mysql_fetch_array($queryicd))
		  {
		  ?>
      <option value="<?php echo $arrayicd['id'];?>"><?php echo $arrayicd['short_description']." | | ".$arrayicd['order_no'];?></option>
      <?php
		  }
		  ?>
    </select>
    </label></td>
  </tr>
  <?php 
  }//close else statement
  }//close for loop
  ?>
  <input name="total" type="hidden" value="<?php echo $_GET['r']; ?>" />
</table>
<?php
}//endelse q==1900
elseif($_GET['q'] == 8888)
{
?>
<table width="37%">
  <tr>
    <td width="12%"><strong>#</strong></td>
    <td width="88%" align="left"><strong>Top Diagnosis</strong></td>
  </tr>
  <?php 
  for ($j=1; $j <= $_GET['r']; $j++)
  {
  if ($j % 2 != 0)
  {
  ?>
  <tr bgcolor="#F5F5F5">
    <td valign="top"><strong><?php echo $j; ?></strong></td>
    <td valign="top"><label></label>      <label>
    <select name="a501<?php echo $j;?>" class="innerInputs selectbox" style="width:300px;" id="myselect">
      <option value="0" selected="selected">Select</option>
      <?php
		  require_once('includes/db_conn.php');
		   $icd="SELECT * FROM top_diagnosis ORDER BY name ASC";
		  $queryicd=mysql_query($icd);
		  while($arrayicd=mysql_fetch_array($queryicd))
		  {
		  ?>
      <option value="<?php echo $arrayicd['id'];?>"><?php echo $arrayicd['name'];?></option>
      <?php
		  }
		  ?>
    </select>
    </label></td>
  </tr>
  <?php 
  } 
  else {
  ?>
  <tr bgcolor="#FCFCFC">
    <td valign="top"><strong><?php echo $j; ?></strong></td>
    <td valign="top"><label>
    <select name="a501<?php echo $j;?>" class="innerInputs selectbox" style="width:300px;" id="myselect">
      <option value="0" selected="selected">Select</option>
      <?php
		  require_once('includes/db_conn.php');
		   $icd="SELECT * FROM top_diagnosis ORDER BY name ASC";
		  $queryicd=mysql_query($icd);
		  while($arrayicd=mysql_fetch_array($queryicd))
		  {
		  ?>
      <option value="<?php echo $arrayicd['id'];?>"><?php echo $arrayicd['name'];?></option>
      <?php
		  }
		  ?>
    </select>
    </label></td>
  </tr>
  <?php 
  }//close else statement
  }//close for loop
  ?>
  <input name="total2" type="hidden" value="<?php echo $_GET['r']; ?>" />
</table>
<?php
}
elseif($_GET['q'] == 2900)
{
?>
<table width="37%">
  <tr>
    <td width="12%"><strong>#</strong></td>
    <td width="44%" align="left"><strong>Description of Expenditure</strong></td>
    <td width="44%" align="left"><strong>Amount</strong></td>
  </tr>
  <?php 
  for ($i=1; $i <= $_GET['r']; $i++)
  {
  if ($i % 2 != 0)
  {
  ?>
  <tr bgcolor="#F5F5F5">
    <td valign="top"><strong><?php echo $i; ?></strong></td>
    <td valign="top"><label></label>      <label>
      <textarea name="d<?php echo $i; ?>" cols="30" rows="3"></textarea>
    </label></td>
    <td valign="top"><input type="text" name="amount<?php echo $i; ?>" class="innerInputs mustValue" style="width:100px;" /></td>
  </tr>
  <?php 
  } 
  else {
  ?>
  <tr bgcolor="#FCFCFC">
    <td valign="top"><strong><?php echo $i; ?></strong></td>
    <td valign="top"><label>
      <textarea name="d<?php echo $i; ?>" cols="30" rows="3"></textarea>
    </label></td>
    <td valign="top"><input type="text" name="amount<?php echo $i; ?>" class="innerInputs mustValue" style="width:100px;" /></td>
  </tr>
  <?php 
  }//close else statement
  }//close for loop
  ?>
  <input name="total" type="hidden" value="<?php echo $_GET['r']; ?>" />
</table>
<?php
}
elseif($_GET['q'] == 21)
{
if($_GET['r'] == 1)
{
?>
<br/><input name="vaccination" type="text" class="form-control" placeholder="Specify Type of Vaccination" style="width:300px;" />
<?php
}
elseif($_GET['r'] == 2)
{
?>
<table width="43%" border="0">
          <tr>
            <td width="7%">&nbsp;</td>
            <td width="32%"><strong>Service</strong></td>
            <td width="61%"><strong>Amount</strong></td>
          </tr>
             <?php
			 //retrieve prescription table which consist with drugs as specified by doctor
	  require_once('includes/db_conn.php');
	  $counter=1;
	  $date=date('Y-m-d');
	  $array="SELECT * FROM clinic_service ORDER BY name ASC";
	  $query=mysqli_query($con,$array);
	 while($array=mysqli_fetch_array($query))
	 {	  
	 if($counter %2!=0)
  {
	  ?>
          <tr>
            <td><label>
              <input type="checkbox" name="user<?php echo $counter; ?>" value="<?php echo $array['id'];?>" />
            </label></td>
            <td><?php echo $array['name'];?></td>
            <td><label>
              <input type="number" name="amount<?php echo $counter; ?>" class="form-control" style="width:100px;" value="<?php echo $array['amount'];?>" />
            </label></td>
          </tr>
          <?php
		  }
		  else
		  {
		  ?>
          <tr>
            <td><input type="checkbox" name="user<?php echo $counter; ?>" value="<?php echo $array['id'];?>" /></td>
            <td><?php echo $array['name'];?></td>
            <td><input type="number" name="amount<?php echo $counter; ?>" class="form-control" style="width:100px;" value="<?php echo $array['amount'];?>"/></td>
          </tr>
          <?php
		  }
		  $counter++;
		  }
		  ?>
            <input name="totalusers" type="hidden" value="<?php echo $counter; ?>" />
        </table>
<?php
}
}
else if ($_GET['q'] == 2)
{
?>
<style type="text/css">
<!--
.style2 {	font-size: 24px;
	font-weight: bold;
}
.style3 {font-size: 18}
.style5 {font-size: 10px}
-->
</style>

<table width="100%">
  <tr>
    <td width="3%"><strong>#</strong></td>
    <td width="21%" align="left"><strong>Procedure Name</strong></td>
    <td width="24%" align="left"><strong>Specimen</strong></td>
    <td width="23%" align="left"><strong>Status</strong></td>
    <td width="29%" align="left"><strong>Result and Recommendation</strong></td>
  </tr>
  <?php 
  for ($i=1; $i <= $_GET['r']; $i++)
  {
  if ($i % 2 != 0)
  {
  ?>
  <tr bgcolor="#F5F5F5">
    <td valign="top"><strong><?php echo $i; ?></strong></td>
    <td valign="top"><label></label>      <label>
    <input type="text" name="bname<?php echo $i; ?>"  class="innerInputs mustValue"/>
      </label></td>
    <td valign="top" align="center"><input type="text" name="aname<?php echo $i; ?>" class="innerInputs mustValue" /></td>
    <td valign="top" align="center"><input type="text" name="anumber<?php echo $i; ?>" class="innerInputs mustValue" /></td>
    <td align="center" valign="top"><label>
    <textarea name="d<?php echo $i; ?>2" cols="30" rows="3"></textarea>
    </label></td>
  </tr>
  <?php 
  } 
  else {
  ?>
  <tr bgcolor="#FCFCFC">
    <td valign="top"><strong><?php echo $i; ?></strong></td>
    <td valign="top"><label>
    <input type="text" name="bname<?php echo $i; ?>" class="innerInputs mustValue"/>
    </label></td>
    <td valign="top" align="center"><input type="text" name="aname<?php echo $i; ?>" class="innerInputs mustValue" /></td>
    <td valign="top" align="center"><input type="text" name="anumber<?php echo $i; ?>" class="innerInputs mustValue" /></td>
    <td align="center" valign="top"><label>
    <textarea name="d<?php echo $i; ?>3" cols="30" rows="3"></textarea>
    </label></td>
  </tr>
  <?php 
  }//close else statement
  }//close for loop
  ?>
  <input name="total" type="hidden" value="<?php echo $_GET['r']; ?>" />
</table>
<?php 
}

else if ($_GET['q'] == 3)
{
?>
<table width="92%">
  <tr>
    <td width="2%"><strong>#</strong></td>
    <td width="34%" align="left"><strong>Drug Namez</strong></td>
    <td width="9%" align="left"><strong>Quantity</strong></td>
    <td width="12%" align="left"><strong>Form</strong></td>
    <td width="11%" align="left"><strong>Take</strong></td>
    <td width="9%" align="left"><strong>Frequency</strong></td>
    <td width="12%" align="left"><strong># of days</strong></td>
    <td width="11%" align="left"><strong>Unit Price</strong></td>
  </tr>
  <?php 
  for ($i=1; $i <= $_GET['r']; $i++)
  {
  if ($i % 2 != 0)
  {
  ?>
  <tr bgcolor="#F5F5F5">
    <td valign="top"><strong><?php echo $i; ?></strong></td>
    <td valign="top"><label></label>      <label>
    <select name="drug<?php echo $i;?>" onchange="filldata(this.value,<?php echo $i;?>)" class="jus" style="width:300px;">
      <option selected="selected">Select Drug Name</option>
      <?php
	  require_once('includes/db_conn.php');
	 // $select="SELECT * FROM stock_out WHERE amount > 0 AND stockin_id IN (SELECT * FROM stock_in ORDER BY trade_name ASC)";
	 $select="SELECT stock_out.*, stock_in.stock_id,stock_in.trade_name,stock_in.quantity FROM stock_out LEFT JOIN stock_in ON stock_out.stockin_id=stock_in.stock_id WHERE stock_out.amount > 0 ORDER BY stock_in.trade_name ASC";
	  $query=mysql_query($select);
	  while($array=mysql_fetch_array($query))
	  {
	  //select trade name
	  $trade="SELECT * FROM stock_in WHERE stock_id='".$array['stockin_id']."'";
	  $querytrade=mysql_query($trade);
	  $arraytrade=mysql_fetch_array($querytrade);
	  
	  //select generic name
	  $generic="SELECT * FROM medicine_generic WHERE medicine_id='".$arraytrade['generic_name']."'";
	  $querygeneric=mysql_query($generic);
	  $arraygeneric=mysql_fetch_array($querygeneric);
	  
	   //units
	  $unit = "SELECT * FROM units WHERE id='".$arraytrade['units']."'";
	  $queryunit = mysql_query($unit);
	  $arrayunit = mysql_fetch_array($queryunit);
	  
	  ?>
      <option value="<?php echo $array['stockout_id'];?>"><?php echo $array['trade_name']." || ". $arraygeneric['name']." || ".$array['quantity']."".$arrayunit['name']." || ".$array['amount'];?></option>
     <?php
	 }
	 ?>
    </select>
    </label></td>
    <td valign="top" align="left"><label for="select">
      <input type="text" name="quantity<?php echo $i; ?>" class="innerInputs mustValue" autocomplete="off" style="width:40px;" ng-model="quantity<?php echo $i; ?>" required />
    </label></td>
    <td align="left" valign="top"><input type="text" id ="unit_<?php echo $i;?>" name="unit<?php echo $i;?>" class="innerInputs mustValue" readonly="readonly" />      </td>
    <td align="left" valign="top"><input type="number" name="take<?php echo $i; ?>" class="innerInputs mustValue" autocomplete="off" style="width:40px;" /></td>
    <td align="left" valign="top"><input type="number" name="frequency<?php echo $i; ?>" class="innerInputs mustValue" autocomplete="off" style="width:40px;" /></td>
    <td align="left" valign="top"><input type="number" name="days<?php echo $i; ?>" class="innerInputs mustValue" autocomplete="off" style="width:40px;" /></td>
    <td align="left" valign="top"><input type="number" name="price<?php echo $i;?>" id="price_<?php echo $i;?>" class="innerInputs mustValue" autocomplete="off" style="width:60px;" readonly="readonly" /></td>
  </tr>
  <?php 
  } 
  else {
  ?>
  <tr bgcolor="#FCFCFC">
    <td valign="top"><strong><?php echo $i; ?></strong></td>
    <td valign="top"><label>
    <select  name="drug<?php echo $i;?>" class="jus" onchange="filldata(this.value,<?php echo $i;?>)" style="width:300px;">
      <option selected="selected">Select Drug Name</option>
      <?php
	  require_once('includes/db_conn.php');
	  //$select="SELECT * FROM stock_out WHERE amount > 0";
	  $select="SELECT stock_out.*, stock_in.stock_id,stock_in.trade_name,stock_in.quantity FROM stock_out LEFT JOIN stock_in ON stock_out.stockin_id=stock_in.stock_id WHERE stock_out.amount > 0 ORDER BY stock_in.trade_name ASC";
	  $query=mysql_query($select);
	  while($array=mysql_fetch_array($query))
	  {
	  //select trade name
	  $trade="SELECT * FROM stock_in WHERE stock_id='".$array['stockin_id']."'";
	  $querytrade=mysql_query($trade);
	  $arraytrade=mysql_fetch_array($querytrade);
	  
	  //select generic name
	  $generic="SELECT * FROM medicine_generic WHERE medicine_id='".$arraytrade['generic_name']."'";
	  $querygeneric=mysql_query($generic);
	  $arraygeneric=mysql_fetch_array($querygeneric);
	  
	  //units
	  $unit = "SELECT * FROM units WHERE id='".$arraytrade['units']."'";
	  $queryunit = mysql_query($unit);
	  $arrayunit = mysql_fetch_array($queryunit);
	  
	  ?>
      <option value="<?php echo $array['stockout_id'];?>"><?php echo $array['trade_name']." || ". $arraygeneric['name']." || ".$array['quantity']."".$arrayunit['name']." || ".$array['amount'];?></option>
      <?php
	 }
	 ?>
    </select>
    </label></td>
    <td valign="top" align="left"><input type="text"  name="quantity<?php echo $i; ?>" class="innerInputs mustValue" autocomplete="off" style="width:40px;" ng-model="quantity<?php echo $i; ?>" required /></td>
    <td align="left" valign="top"><input type="text" id ="unit_<?php echo $i;?>" name="unit<?php echo $i;?>" class="innerInputs mustValue" readonly="readonly" />      </td>
    <td align="left" valign="top"><input type="number" name="take<?php echo $i; ?>" class="innerInputs mustValue" autocomplete="off" style="width:40px;"></td>
    <td align="left" valign="top"><input type="number" name="frequency<?php echo $i; ?>" class="innerInputs mustValue" autocomplete="off" style="width:40px;"/></td>
    <td align="left" valign="top"><input type="number" name="days<?php echo $i; ?>" class="innerInputs mustValue" autocomplete="off" style="width:40px;" /></td>
    <td align="left" valign="top"><input type="number" name="price<?php echo $i;?>" id="price_<?php echo $i;?>" class="innerInputs mustValue" autocomplete="off" style="width:60px;" readonly="readonly" /></td>
  </tr>
  <?php 
  }//close else statement
  }//close for loop
  ?>
  <input name="total" type="hidden" value="<?php echo $_GET['r']; ?>" />
</table>
<?php 
}//close if for $_GET['q'] == 3
else if ($_GET['q'] == 900)
{
?>
<table width="92%">
  <tr>
    <td width="2%"><strong>#</strong></td>
    <td width="31%" align="left"><strong>Drug direct</strong></td>
    <td width="6%" align="left"><strong>Quantity</strong></td>
    <td width="6%" align="left"><strong>Form</strong></td>
    <td width="7%" align="left"><strong>Take</strong></td>
    <td width="7%" align="left"><strong>Frequency</strong></td>
    <td width="8%" align="left"><strong># of days</strong></td>
    <td width="13%" align="left"><strong>Price/item</strong></td>
  </tr>
  <?php 
  for ($i=1; $i <= $_GET['r']; $i++)
  {
  if ($i % 2 != 0)
  {
  ?>
  <tr bgcolor="#F5F5F5">
    <td valign="top"><strong><?php echo $i; ?></strong></td>
    <td valign="top"><label></label>      <label>
    <select name="drug<?php echo $i;?>" id="drug_<?php echo $i;?>" onchange="filldata(this.value,<?php echo $i;?>)" class="vige" style="width:300px;">
      <option selected="selected">Select Drug Name</option>
      <?php
	  require_once('includes/db_conn.php');
	  $select="SELECT stock_out.*, stock_in.stock_id,stock_in.trade_name,stock_in.quantity FROM stock_out LEFT JOIN stock_in ON stock_out.stockin_id=stock_in.stock_id WHERE stock_out.amount > 0 ORDER BY stock_in.trade_name ASC";
	  $query=mysql_query($select);
	  while($array=mysql_fetch_array($query))
	  {
	  //select trade name
	  $trade="SELECT * FROM stock_in WHERE stock_id='".$array['stockin_id']."'";
	  $querytrade=mysql_query($trade);
	  $arraytrade=mysql_fetch_array($querytrade);
	  
	  //select generic name
	  $generic="SELECT * FROM medicine_generic WHERE medicine_id='".$arraytrade['generic_name']."'";
	  $querygeneric=mysql_query($generic);
	  $arraygeneric=mysql_fetch_array($querygeneric);
	  
	   //units
	  $unit = "SELECT * FROM units WHERE id='".$arraytrade['units']."'";
	  $queryunit = mysql_query($unit);
	  $arrayunit = mysql_fetch_array($queryunit);
	  
	  ?>
      <option value="<?php echo $array['stockout_id'];?>"><?php echo $array['trade_name']." || ". $arraygeneric['name']." || ".$array['quantity']."".$arrayunit['name']." || ".$array['amount'];?></option>
     <?php
	 }
	 ?>
    </select>
    </label></td>
    <td valign="top" align="left"><label for="select">
    <input type="text" id="quantity_<?php echo $i; ?>" name="quantity<?php echo $i; ?>" class="innerInputs mustValue" autocomplete="off" style="width:40px;" required />
    </label></td>
    <td align="left" valign="top"><input type="text" id ="unit_<?php echo $i;?>" name="unit<?php echo $i;?>" class="innerInputs mustValue" readonly="readonly" style="width:40px;" /></td>
    <td align="left" valign="top"><input type="number" name="take<?php echo $i; ?>" class="innerInputs mustValue" autocomplete="off" style="width:40px;" id="take_<?php echo $i; ?>" onkeyup="sum(<?php echo $i;?>);" /></td>
    <td align="left" valign="top"><input type="number" name="frequency<?php echo $i; ?>" class="innerInputs mustValue" autocomplete="off" style="width:40px;" id="frequency_<?php echo $i; ?>" onkeyup="sum(<?php echo $i;?>);"   /></td>
    <td align="left" valign="top"><input type="number" name="days<?php echo $i; ?>" class="innerInputs mustValue" autocomplete="off" style="width:40px;" id="days_<?php echo $i; ?>" onkeyup="sum(<?php echo $i;?>);" /></td>
    <td align="left" valign="top"><input type="number" name="price<?php echo $i;?>" id="price_<?php echo $i;?>" class="innerInputs mustValue" autocomplete="off" style="width:60px;" readonly="readonly" /></td>
  </tr>
  <?php 
  } 
  else {
  ?>
  <tr bgcolor="#FCFCFC">
    <td valign="top"><strong><?php echo $i; ?></strong></td>
    <td valign="top"><label>
    <select name="drug<?php echo $i;?>" id="drug_<?php echo $i;?>" onchange="filldata(this.value,<?php echo $i;?>)" class="vige" style="width:300px;">
      <option selected="selected">Select Drug Name</option>
      <?php
	  require_once('includes/db_conn.php');
	  $select="SELECT stock_out.*, stock_in.stock_id,stock_in.trade_name,stock_in.quantity FROM stock_out LEFT JOIN stock_in ON stock_out.stockin_id=stock_in.stock_id WHERE stock_out.amount > 0 ORDER BY stock_in.trade_name ASC";
	  $query=mysql_query($select);
	  while($array=mysql_fetch_array($query))
	  {
	  //select trade name
	  $trade="SELECT * FROM stock_in WHERE stock_id='".$array['stockin_id']."'";
	  $querytrade=mysql_query($trade);
	  $arraytrade=mysql_fetch_array($querytrade);
	  
	  //select generic name
	  $generic="SELECT * FROM medicine_generic WHERE medicine_id='".$arraytrade['generic_name']."'";
	  $querygeneric=mysql_query($generic);
	  $arraygeneric=mysql_fetch_array($querygeneric);
	  
	   //units
	  $unit = "SELECT * FROM units WHERE id='".$arraytrade['units']."'";
	  $queryunit = mysql_query($unit);
	  $arrayunit = mysql_fetch_array($queryunit);
	  
	  ?>
      <option value="<?php echo $array['stockout_id'];?>"><?php echo $array['trade_name']." || ". $arraygeneric['name']." || ".$array['quantity']."".$arrayunit['name']." || ".$array['amount'];?></option>
     <?php
	 }
	 ?>
    </select>
    </label></td>
    <td valign="top" align="left"><input type="text" id="quantity_<?php echo $i; ?>" name="quantity<?php echo $i; ?>" class="innerInputs mustValue" autocomplete="off" style="width:40px;" required /></td>
    <td align="left" valign="top"><input type="text" id ="unit_<?php echo $i;?>" name="unit<?php echo $i;?>" class="innerInputs mustValue" readonly="readonly" style="width:40px;" /></td>
    <td align="left" valign="top"><input type="number" name="take<?php echo $i; ?>" class="innerInputs mustValue" autocomplete="off" style="width:40px;" id="take_<?php echo $i; ?>" onkeyup="sum(<?php echo $i;?>);" ></td>
    <td align="left" valign="top"><input type="number" name="frequency<?php echo $i; ?>" class="innerInputs mustValue" autocomplete="off" style="width:40px;" id="frequency_<?php echo $i; ?>" onkeyup="sum(<?php echo $i;?>);" /></td>
    <td align="left" valign="top"><input type="number" name="days<?php echo $i; ?>" class="innerInputs mustValue" autocomplete="off" style="width:40px;" id="days_<?php echo $i; ?>" onkeyup="sum(<?php echo $i;?>);" /></td>
    <td align="left" valign="top"><input type="number" name="price<?php echo $i;?>" id="price_<?php echo $i;?>" class="innerInputs mustValue" autocomplete="off" style="width:60px;" readonly="readonly" /></td>
  </tr>
  <?php 
  }//close else statement
  }//close for loop
  ?>
  <input name="total" type="hidden" value="<?php echo $_GET['r']; ?>" />
</table>
<?php 
}//close if for $_GET['q'] == 900
else if($_GET['q'] == 40)
{
	?>
    <table width="88%">
  <tr>
    <td width="10%"><strong>#</strong></td>
    <td width="34%" align="left"><strong>Procedure Name</strong></td>
    <td width="26%" align="left"><strong>Payment Method</strong></td>
    <td width="30%" align="left"><strong>Category</strong></td>
  </tr>
  <?php 
  for ($i=1; $i <= $_GET['r']; $i++)
  {
  if ($i % 2 != 0)
  {
  ?>
  <tr bgcolor="#F5F5F5">
    <td valign="top"><strong><?php echo $i; ?></strong></td>
    <td valign="top"><label></label>      <label>
      <select name="pname<?php echo $i;?>" class="innerInputs mustValue">
        <option selected="selected">Select Procedures</option>
        <?php
	  require_once('includes/db_conn.php');
	  $select="SELECT * FROM procedures ORDER BY name ASC";
	  $query=mysql_query($select);
	  while($array=mysql_fetch_array($query))
	  {
	  ?>
        <option value="<?php echo $array['name'];?>"><?php echo $array['name']." | | ".number_format($array['price']);?></option>
        <?php
	  }
	  ?>
        </select>
    </label></td>
    <td align="left" valign="top"><select name="method<?php echo $i; ?>" id="select" class="innerInputs mustValue" style="width:100px;">
      <option value="0" selected="selected">Select</option>
      <option value="1">Cash</option>
      <option value="2">Insurance</option>
      <option value="3">Credit</option>
    </select></td>
    <td align="left" valign="top"><select name="cat<?php echo $i; ?>"  class="innerInputs mustValue" style="width:150px;">
      <option value="0" selected="selected">Select</option>
      <option value="1">Laboratory Test</option>
      <option value="2">Imaging Test</option>
      <option value="3">Dressing</option>
    </select></td>
  </tr>
  <?php 
  } 
  else {
  ?>
  <tr bgcolor="#FCFCFC">
    <td valign="top"><strong><?php echo $i; ?></strong></td>
    <td valign="top"><label>
      <select name="pname<?php echo $i;?>" class="innerInputs mustValue">
        <option selected="selected">Select Procedures</option>
        <?php
	  require_once('includes/db_conn.php');
	  $select="SELECT * FROM procedures ORDER BY name ASC";
	  $query=mysql_query($select);
	  while($array=mysql_fetch_array($query))
	  {
	  ?>
        <option value="<?php echo $array['name'];?>"><?php echo $array['name']." | | ".number_format($array['price']);?></option>
        <?php
	  }
	  ?>
        </select>
    </label></td>
    <td align="left" valign="top"><select name="method<?php echo $i; ?>" id="method<?php echo $i; ?>" class="innerInputs mustValue" style="width:100px;">
      <option value="0" selected="selected">Select</option>
      <option value="1">Cash</option>
      <option value="2">Insurance</option>
      <option value="3">Credit</option>
    </select></td>
    <td align="left" valign="top"><select name="cat<?php echo $i; ?>"  class="innerInputs mustValue" style="width:150px;">
      <option value="0" selected="selected">Select</option>
     <option value="1">Laboratory Test</option>
      <option value="2">Imaging Test</option>
      <option value="3">Dressing</option>
    </select></td>
  </tr>
  <?php 
  }//close else statement
  }//close for loop
  ?>
  <input name="total" type="hidden" value="<?php echo $_GET['r']; ?>" />
</table>
<?php 
}//close if for $_GET['q'] == 3

else if($_GET['q'] == 4)
{ 

if ($_GET['r'] == 3 || $_GET['r'] == 4) {
?>
<table width="500">
  <tr>
    <td colspan="4">Select Service Unit </td>
  </tr>
  <?php
  $counter = 1;
  require_once('db_conn.php');
  $select = "SELECT * FROM service_units ORDER BY unit_name ASC";
  $query = mysql_query($select);
  
  while ( $array = mysql_fetch_array($query))
  {
  
  if ( (( $counter + 1) % 2 == 0) && (( $counter + 1) % 4 != 0))
  {
  ?>
  <tr bgcolor="#F5F5F5">
    <td width="5%"><input type="checkbox" name="unit<?php echo $counter; ?>" value="<?php echo $array['unit_id']; ?>" /></td>
    <td width="45%"><?php echo $array['unit_name']; ?></td>
  <?php 
  }
  
  else if ( (( $counter) % 2 == 0) && (( $counter) % 4 != 0))
  {
  ?>
    <td width="5%"><input type="checkbox" name="unit<?php echo $counter; ?>" value="<?php echo $array['unit_id']; ?>" /></td>
    <td width="45%"><?php echo $array['unit_name']; ?></td>
  </tr>
  <?php 
  }
  
  else if ( ( $counter + 1) % 4 == 0)
  {
  ?>
  <tr>
    <td><input type="checkbox" name="unit<?php echo $counter; ?>" value="<?php echo $array['unit_id']; ?>" /></td>
    <td><?php echo $array['unit_name']; ?></td>
	<?php 
  }
  
  else if ( ( $counter) % 4 == 0)
  {
  ?>
    <td><input type="checkbox" name=" unit<?php echo $counter; ?>" value="<?php echo $array['unit_id']; ?>" /></td>
    <td><?php echo $array['unit_name']; ?></td>
  </tr>
  <?php 
  }
  $counter++;
  }//close while loop
  $total = $counter - 1;
  ?>
  <input name="total" type="hidden" value="<?php echo $total; ?>" />
</table>
<?php 
}
else echo "&nbsp;";
}//close if for $_GET['q'] == 4

else if ( $_GET['q'] == 600 )
{
   if ( $_GET['r'] == 1 )
   {
?>
<br/><br/><br/>
    <table width="43%" border="0">
          <tr>
            <td width="7%">&nbsp;</td>
            <td width="32%"><strong>Service Name</strong></td>
            <td width="61%"><strong>Amount to Pay</strong></td>
          </tr>
             <?php
			 //retrieve prescription table which consist with drugs as specified by doctor
	  require_once('includes/db_conn.php');
	  $counter=1;
	  $date=date('Y-m-d');
	  $array="SELECT * FROM services ORDER BY name ASC";
	  $query=mysql_query($array);
	 while($array=mysql_fetch_array($query))
	 {	  
	 if($counter %2!=0)
  {
	  ?>
          <tr>
            <td><label>
              <input type="checkbox" name="user<?php echo $counter; ?>" value="<?php echo $array['id'];?>" />
            </label></td>
            <td><?php echo $array['name'];?></td>
            <td><label>
              <input type="number" name="amount<?php echo $counter; ?>" value="<?php echo $array['amount'];?>" class="innerInputs mustValue" style="width:100px;" readonly="readonly" />
            </label></td>
          </tr>
          <?php
		  }
		  else
		  {
		  ?>
          <tr>
            <td><input type="checkbox" name="user<?php echo $counter; ?>" value="<?php echo $array['id'];?>" /></td>
            <td><?php echo $array['name'];?></td>
            <td><input type="number" name="amount<?php echo $counter; ?>" value="<?php echo $array['amount'];?>" class="innerInputs mustValue" style="width:100px;" readonly="readonly"/></td>
          </tr>
          <?php
		  }
		  $counter++;
		  }
		  ?>
            <input name="totalusers" type="hidden" value="<?php echo $counter; ?>" />
        </table>

<?php 
   }//close if for $_GET['r'] == 1
   
   elseif($_GET['r'] == 2)
   {
   ?>
   <br/><br/><br/>
  <select name="total" class="innerInputs mustValue" style="width:300px;"  onChange="loading(900,this.value)">
          <option value="0" selected="selected">Select number</option>
		  <?php 
		  for ($i=1; $i < 10; $i++)
		  {
		  ?>
		  <option><?php echo $i; ?></option>
		  <?php 
		  }
		  ?>
</select>
        <br/><br/><br/><br/>
        <div id="loadparts"></div>
  <?php
   }//end of get r==2
   elseif($_GET['r'] == 3)
   {
   ?>
   <br/><br/><br/>
   <table width="43%" border="0">
          <tr>
            <td width="7%">&nbsp;</td>
            <td width="32%"><strong>Test Name</strong></td>
            <td width="61%"><strong>Amount Paid</strong></td>
          </tr>
             <?php
			 //retrieve prescription table which consist with drugs as specified by doctor
	  require_once('includes/db_conn.php');
	  $counter=1;
	  $date=date('Y-m-d');
	  $array="SELECT * FROM procedures ORDER BY name ASC";
	  $query=mysql_query($array);
	 while($array=mysql_fetch_array($query))
	 {	  
	 if($counter %2!=0)
  {
	  ?>
          <tr>
            <td><label>
            <input type="checkbox" name="user<?php echo $counter; ?>" value="<?php echo $array['id'];?>" />
            </label></td>
            <td><?php echo $array['name'];?></td>
<td><label>
              <input type="text" name="amount<?php echo $counter; ?>" class="innerInputs mustValue" style="width:100px;" value="<?php echo $array['price'];?>" readonly="readonly"/>
            </label></td>
          </tr>
          <?php
		  }
		  else
		  {
		  ?>
          <tr>
            <td><input type="checkbox" name="user<?php echo $counter; ?>" value="<?php echo $array['id'];?>" /></td>
            <td><?php echo $array['name'];?></td>
            <td><input type="text" name="amount<?php echo $counter; ?>" class="innerInputs mustValue" style="width:100px;" value="<?php echo $array['price'];?>" readonly="readonly"/></td>
          </tr>
          <?php
		  }
		  $counter++;
		  }
		  ?>
            <input name="totalusers" type="hidden" value="<?php echo $counter; ?>" />
        </table>
        <?php
		}
}//close
?>