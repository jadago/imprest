<?php 
if ( $_GET['q'] == 1 )
{
?>
       
                                  <?php 
		  require_once('includes/db_conn.php');
		  $select1 = "SELECT id, subcategory_name FROM subcategory WHERE category = '".$_GET['r']."' ORDER BY subcategory_name ASC";
		  $query1 = mysqli_query($con,$select1);
		  
		  while ( $array1 = mysqli_fetch_array($query1))
		  {
		  ?>
		                          <option value="<?php echo $array1['id'];?>"><?php echo $array1['subcategory_name'];?></option>
		                          <?php 
		                           }
		                          ?>
                               
                          
<?php
}//close if ( $_GET['q'] == 1 )
else if ( $_GET['q'] == 2 )
{
?>
         <div class="form-group">
                            <label class="col-sm-2 control-label"><font color="#FF0000">Unritered Balance</font></label>
                            <div class="col-sm-10">
                               <?php
							   require_once('includes/db_conn.php'); 
							   $unretired = "SELECT imprest.*,imprest_item.amount,SUM(imprest_item.amount) AS tamount,imprest_item.imprest_id FROM imprest,imprest_item WHERE imprest.addedby = '".$_GET['r']."' AND imprest.imprest_id = imprest_item.imprest_id AND imprest.status =5 AND imprest.stage=1 ";
							   $queryimprest = mysqli_query($con,$unretired);
							   $arrayimprest = mysqli_fetch_array($queryimprest);
							   ?>
                           <input type="text" class="form-control" readonly="readonly" value="<?php echo  number_format($arrayimprest['tamount'],0);?>" style="width:320px;">
                            </div>
                        </div>
<?php 
}//close if ( $_GET['q'] == 2 )
else if ( $_GET['q'] == 3 )
{     
?>
       
	   <select name="dis" class="innerInputs mustValue" id="dis">
		  <option value="0" selected="selected">Select District</option>
		  <?php 
		  require_once('includes/db_conn.php');
		  $select = "SELECT id, district FROM districts WHERE status = '1' AND region = '".$_GET['r']."' ORDER BY district ASC";
		  $query = mysql_query($select);
		  
		  while ( $array = mysql_fetch_array($query))
		  {
		  ?>
          <option value="<?php echo $array['id']; ?>"><?php echo stripslashes($array['district']); ?></option>
		  <?php 
		  }
		  ?>
</select>
		
<?php 
}//close if ( $_GET['q'] == 3 )
else if ( $_GET['q'] == 4 )
{  
      if (  $_GET['r'] == 2 )
   {
?>
         <select name="lap" id="lap" class="innerInputs mustValue" onchange="lap_unit( 5, this.value)">
          <option value="0" selected="selected">Select legal aid provider/Grantee</option>
		  <?php 
		  require_once('includes/db_conn.php');
		  $getlap = "SELECT lap_no, lap_name FROM lap ORDER BY lap_name ASC";
		  $querylap = mysql_query($getlap);
		  
		  while ( $arraylap = mysql_fetch_array($querylap))
		  {
		  ?>
          <option value="<?php echo $arraylap['lap_no']; ?>"><?php echo $arraylap['lap_name']; ?></option>
		  <?php 
		  }
		  ?>
        </select><br /><br /><br /><br />
		<div id="inner2">&nbsp;</div>
<?php
   }
   else if ( $_GET['r'] == 1 || $_GET['r'] == 3 )
   {
?><br /><br />
  <table width="100%" border="0" cellspacing="2" cellpadding="0">
          
          <tr>
            <td colspan="3"><strong>Select Menu Access </strong></td>
          </tr>
          <tr>
            <td width="29%"><label>
              <input name="b1" type="checkbox" id="b1" value="1" />
              Dashboard</label></td>
            <td width="36%"><label>
			<input name="b6" type="checkbox" id="b6" value="1" /> 
              System Users </label></td>
            <td width="35%"><label>
			<input name="b11" type="checkbox" id="b11" value="1" />
			Monthly Reports </label></td>
          </tr>
          <tr>
            <td><label>
			<input name="b2" type="checkbox" id="b2" value="1" />
			Legal Clients 
            </label></td>
            <td><label><input name="b7" type="checkbox" id="b7" value="1" /> 
              TOT Training </label></td>
            <td><label><input name="b12" type="checkbox" id="b12" value="1" /> 
              Grantee Performance </label></td>
          </tr>
          <tr>
            <td><label><input name="b3" type="checkbox" id="b3" value="1" />
              Paralegals</label></td>
            <td><label><input name="b8" type="checkbox" id="b8" value="1" />
              Paralegal Training </label></td>
            <td><label><input name="b13" type="checkbox" id="b13" value="1" /> 
              Admin Tasks</label>
</td>
          </tr>
          <tr>
            <td><label><input name="b4" type="checkbox" id="b4" value="1" />
Paralegals Units</label></td>
            <td><label><input name="b9" type="checkbox" id="b9" value="1" />
            Workshops</label></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><label><input name="b5" type="checkbox" id="b5" value="1" /> 
              Grantees</label>
</td>
            <td><label><input name="b10" type="checkbox" id="b10" value="1" />
Reports</label></td>
            <td>&nbsp;</td>
          </tr>
</table>
<?php
   }
}//close if ( $_GET['q'] == 4 )
else if ( $_GET['q'] == 5 )
{
?>
         <select name="unit" id="unit" class="innerInputs mustValue">
          <option value="0" selected="selected">Select Paralegal Unit</option>
		  <?php 
		  require_once('includes/db_conn.php');
		  $getunit = "SELECT unit_no, unit_name FROM units WHERE lap_no = '".$_GET['r']."'ORDER BY unit_name ASC";
		  $queryunit = mysql_query($getunit);
		  while ( $arrayunit = mysql_fetch_array($queryunit))
		  {
		  ?>
          <option value="<?php echo $arrayunit['unit_no']; ?>"><?php echo $arrayunit['unit_name']; ?></option>
		  <?php 
		  }
		  ?>
        </select><br /><br />
        <?php
		}//close q=5
		
else if ( $_GET['q'] == 95 )
{
?>
         <select name="gbv" id="unit" class="innerInputs mustValue">
          <option value="0" selected="selected">Select GBV Case</option>
		  <?php 
		  require_once('includes/db_conn.php');
		  $getunit = "SELECT id,gbv_category,case_name FROM gbv_cases WHERE gbv_category = '".$_GET['r']."' ORDER BY case_name ASC";
		  $queryunit = mysql_query($getunit);
		  while ( $arrayunit = mysql_fetch_array($queryunit))
		  {
		  ?>
          <option value="<?php echo $arrayunit['id']; ?>"><?php echo $arrayunit['case_name']; ?></option>
		  <?php 
		  }
		  ?>
        </select><br /><br />
<?php 
}//close if ( $_GET['q'] == 95 )
else if ( $_GET['q'] == 6 )
{
   if ( $_GET['r'] == 3 )
   {
?>  <br /><br /><br /><br /><label>Referred to?<br />
    <select name="referedto" class="innerInputs mustValue">
          <option value="0" selected="selected">Select where referred to</option>
          <option value="1">Court</option>
          <option value="2">Police</option>
          <option value="3">Ward Tribunal</option>
          <option value="4">Other Legal Provider</option>
</select></label><br /><br /><br /><br />
	<label>Enter name/Description of where referred to
   <input type="text" name="refereddescription" class="innerInputs mustValue" /></label>
<?php 
   }//close if for $_GET['r'] == 3
}//close if ( $_GET['q'] == 6 )
else if ( $_GET['q'] == 7 )
{
  if ( $_GET['r'] == 2 )
  {
  ?>
  <table width="100%" border="0" cellspacing="0" cellpadding="8">
      <tr>
        <td width="30%">First name<br />
          <span class="valueDescription">&nbsp; </span></td>
        <td width="70%"><input type="text" name="a1" class="innerInputs mustValue" /></td>
      </tr>
      <tr>
        <td>Middle name<br />
          <span class="valueDescription">&nbsp;</span></td>
        <td><input type="text" name="a2" class="innerInputs mustValue" /></td>
      </tr>
      <tr>
        <td>Last name<br />
          <span class="valueDescription">&nbsp;</span></td>
        <td><input type="text" name="a3" class="innerInputs mustValue" /></td>
      </tr>
      <tr>
        <td>Gender
          <span class="valueDescription">&nbsp;</span></td>
        <td><select name="a4" class="innerInputs mustValue">
          <option value="0" selected="selected">Select gender</option>
          <option value="M">Male</option>
          <option value="F">Female</option>
        </select></td>
      </tr>
      <tr>
        <td>Education</td>
        <td><select name="a10" class="innerInputs mustValue">
          <option value="0" selected="selected">Select education level</option>
		  <option value="1">Secondary</option>
          <option value="2">Ordinary Certificate</option>
		  <option value="3">Diploma</option>
		  <option value="4">Bachelor</option>
		  <option value="5">Master</option>
		  <option value="6">PhD</option>
        </select></td>
      </tr>
      <tr>
        <td>Profession</td>
        <td><select name="a11" class="innerInputs mustValue">
          <option value="0" selected="selected">Select profession</option>
          <option value="1">Lawyer</option>
          <option value="2">Non Lawyer</option>
        </select></td>
      </tr>
	  <tr>
        <td>Organization</td>
        <td><input type="text" name="a9" class="innerInputs mustValue" /></td>
      </tr>
      <tr>
        <td>Email</td>
        <td><input type="text" name="a5" class="innerInputs mustValue" /></td>
      </tr>
      <tr>
        <td>Phone number <br />
          <span class="valueDescription">&nbsp;</span></td>
        <td><input type="text" name="a6" class="innerInputs mustValue" /></td>
      </tr>
</table>
  <?php
  }
  else if ( $_GET['r'] == 1 )
  {
  ?>
  <select name="a13" class="innerInputs mustValue" id="a13">
          <option value="0" selected="selected">Select Facilitator</option>
		  <?php 
		  require_once('includes/db_conn.php');
		  $getfac = "SELECT participant_no, fname, mname, lname, organization FROM trainings_tot_participants ORDER BY fname ASC";
		  $queryfac = mysql_query($getfac);
		  
		  while ( $arrayfac = mysql_fetch_array($queryfac))
		  {
		  ?>
          <option value="<?php echo $arrayfac['participant_no']; ?>"><?php echo $arrayfac['fname']." ".$arrayfac['mname']." ".$arrayfac['lname']."  (".$arrayfac['organization'].")"; ?></option>
		  <?php 
		  }
		  ?>
</select>
  <?php 
  } 
}//close if for $_GET['q'] == 7 
else if ( $_GET['q'] == 8 )
{         
          $yearStart = 2013;
		  $year = date('Y');
?>
	
		<table width="100%" border="0" cellspacing="4" cellpadding="0">
		<tr>
			  <td colspan="12"><span class="reportTextHeader">Total Disputes per Month: <?php echo $_GET['r']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</span>
		 <select name="a4" onchange="reportYear( 8 , this.value )"  class="reportInputs">
          <option value="0" selected="selected">Change Year</option>
		  <?php 
		  for ($i=$yearStart; $i <= $year; $i++)
		  {
		  ?>
          <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
		  <?php 
		  }
		  ?>
        </select></td>
		  </tr>
		  <tr>
		  <?php 
		  require_once('includes/db_conn.php');
	  if ( $arraylogUser['user_type'] == 2 || $arraylogUser['user_type'] == 5 )
	 {
       $getyear = "select COUNT(*) AS totalyear from disputes where YEAR(date) ='".$_GET['r']."' AND lap_no = '".$arraylogUser['org_no']."'";
	 }
	 else 
	 {
	    $getyear = "select COUNT(*) AS totalyear from disputes where YEAR(date) ='".$_GET['r']."'";
	 }
     $queryyear = mysql_query($getyear);
     $arrayyear = mysql_fetch_array($queryyear);
	 
		  for ($i=1; $i <= 12; $i++)
		  {
		      if ( $i < 10 ) $month = "0".$i; else $month = $i;
			  if ( $arraylogUser['user_type'] == 2 || $arraylogUser['user_type'] == 5 )
	          {
		        $getdate = "select COUNT(*) AS totalmonth from disputes where YEAR(date) ='".$_GET['r']."' AND MONTH(date) ='".$month."' AND lap_no = '".$arraylogUser['org_no']."'";
			  }
			  else
			  {
			    $getdate = "select COUNT(*) AS totalmonth from disputes where YEAR(date) ='".$_GET['r']."' AND MONTH(date) ='".$month."'";
			  }
			  $querydate = mysql_query($getdate);
			  
			  while ( $arraydate = mysql_fetch_array($querydate))
			  {
		  ?>
            <td valign="bottom" align="center"><?php echo $arraydate['totalmonth']; ?><div style="width:90%; height:<?php $percentage = round (($arraydate['totalmonth']/$arrayyear['totalyear'])*100, 2); echo $percentage*2; ?>px; background-color:#59ACFF; padding-right: 5px; padding-top: 5px; color:#FBFBFB;"></div></td>
			<?php
		      }//close while
		  }//close for loop 
		  ?>
          </tr>
			<tr>
			  <td><div align="center">Jan</div></td>
			  <td><div align="center">Feb</div></td>
			  <td><div align="center">Mar</div></td>
			  <td><div align="center">Apr</div></td>
			  <td><div align="center">May</div></td>
			  <td><div align="center">Jun</div></td>
			  <td><div align="center">Jul</div></td>
			  <td><div align="center">Aug</div></td>
			  <td><div align="center">Sep</div></td>
			  <td><div align="center">Oct</div></td>
			  <td><div align="center">Nov</div></td>
			  <td><div align="center">Dec</div></td>
			</tr>
			<tr>
			  <td colspan="12"><h3>Overall total <?php echo $_GET['r']; ?> : <?php echo $arrayyear['totalyear']; ?></h3></td>
		  </tr>
        </table>
<?php 
}//close if for $_GET['q'] == 8
else if ( $_GET['q'] == 9 && $_GET['r'] == "1.1" )
{
?>
<table width="100%" border="0" cellpadding="8" cellspacing="0" bgcolor="#FBFBFB">
	  <?php 
       if ( $_GET['s'] == 1 )
       {
       ?>
      <tr>
        <td width="40%" align="right">Firstname<br />
          <span class="valueDescription">&nbsp;Enter citizen's name </span></td>
        <td width="60%"><input name="firstname" type="text" class="innerInputs mustValue" id="firstname" /></td>
      </tr>
      <tr>
        <td align="right">Middle name<br />
          <span class="valueDescription">&nbsp;Enter citizen's middle name</span></td>
        <td><input name="middlename" type="text" class="innerInputs" id="middlename" /></td>
      </tr>
      <tr>
        <td align="right">Last name<br />
          <span class="valueDescription">&nbsp;Enter citizen's last name</span></td>
        <td><input name="lastname" type="text" class="innerInputs mustValue" id="lastname" /></td>
      </tr>
      <tr>
        <td align="right">Phone number <br />
          <span class="valueDescription">&nbsp;</span></td>
        <td><input name="phone" type="text" class="innerInputs mustValue" id="phone" /></td>
      </tr>
      <tr>
        <td align="right">Year of birth <br />
          <span class="valueDescription">&nbsp;</span></td>
        <td><input name="year" type="text" class="innerInputs mustValue" id="year" maxlength="4" /></td>
      </tr>
	  <?php 
       }
	   else if ( $_GET['s'] == 2 )
       {
       ?>
	   <tr>
        <td align="right">Client code<br />
          <span class="valueDescription">&nbsp;Enter client's code</span></td>
        <td><input type="text" name="code" class="innerInputs mustValue" /></td>
      </tr>
	   <?php 
       }
       ?>
      <tr>
        <td align="right">Gender
          <span class="valueDescription">&nbsp;</span></td>
        <td><select name="gender" class="innerInputs mustValue" id="gender">
          <option value="0" selected="selected">Select gender</option>
          <option value="M">Male</option>
          <option value="F">Female</option>
        </select></td>
      </tr>
      <tr>
        <td align="right">Occupation<span class="valueDescription"></span></td>
        <td><select name="occupation" class="innerInputs mustValue" id="occupation">
          <option value="0" selected="selected">Select occupation</option>
          <?php 
		  require_once('includes/db_conn.php');
		  $select = "SELECT occ_id, occ_name FROM occupations ORDER BY occ_name ASC";
		  $query = mysql_query($select);
		  
		  while ( $array = mysql_fetch_array($query))
		  {
		  ?>
          <option value="<?php echo $array['occ_id']; ?>"><?php echo stripslashes($array['occ_name']); ?></option>
		  <?php 
		  }
		  ?>
        </select></td>
      </tr>
      <tr>
        <td align="right">Region</td>
        <td><select name="reg" id="reg" class="innerInputs mustValue" onchange="district( 1, this.value)">
		  <option value="0" selected="selected">Select Region</option>
		  <?php 
		  require_once('includes/db_conn.php');
		  $select = "SELECT id, region FROM regions WHERE status = '1' ORDER BY region ASC";
		  $query = mysql_query($select);
		  
		  while ( $array = mysql_fetch_array($query))
		  {
		  ?>
          <option value="<?php echo $array['id']; ?>"><?php echo stripslashes($array['region']); ?></option>
		  <?php 
		  }
		  ?>
        </select></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><div id="inner"></div></td>
      </tr>
	  <tr>
        <td align="right">Street/Office Location </td>
        <td><input type="text" name="office" id="office" class="innerInputs mustValue" /></td>
      </tr>
</table>
<?php
}//close if for $_GET['q'] == 9
else if ( $_GET['q'] == 20 )
{
   if ( $_GET['r'] == 5)
   {
?> 
	<label><font color="red">Enter Type of work eg.Teacher etc</font>
   <input type="text" name="work" class="innerInputs mustValue" /></label>
<?php 
   }//close if for $_GET['r'] == 3
}//close if ( $_GET['q'] == 6 )
else if ( $_GET['q'] == 870 )
{  
      if (  $_GET['r'] == 8 )
   {
?>
         <select name="gbv_category" id="lap" class="innerInputs mustValue" onchange="gbv_unit( 95, this.value)">
          <option value="0" selected="selected">Select GBV </option>
		  <?php 
		  require_once('includes/db_conn.php');
		  $getlap = "SELECT id, name FROM gbv_category ORDER BY name ASC";
		  $querylap = mysql_query($getlap);
		  
		  while ( $arraylap = mysql_fetch_array($querylap))
		  {
		  ?>
          <option value="<?php echo $arraylap['id']; ?>"><?php echo $arraylap['name']; ?></option>
		  <?php 
		  }
		  ?>
        </select><br /><br /><br /><br />
		<div id="inner61">&nbsp;</div>
<?php
}
}//close if ( $_GET['q'] == 4 )
?>