 <table class="table table-striped" style="width:500px;">
    <tbody>
      <tr>
        <td width="43%">Main Complain</td>
        <td width="57%"> <textarea rows="3" cols="3" class="limited form-control" placeholder="Limited to 100 characters" name="a1"><?php echo $arraylast['main_complain'];?></textarea></td>
      </tr>
      <tr>
        <td>History of Presenting Illness</td>
        <td><textarea rows="3" cols="3" class="limited form-control" placeholder="Limited to 100 characters" name="a2"><?php echo $arraylast['history'];?></textarea></td>
      </tr>
      <tr>
        <td>Review of other systems</td>
        <td><textarea rows="3" cols="3" class="limited form-control" placeholder="Limited to 100 characters" name="a3"><?php echo $arraylast['review'];?></textarea></td>
      </tr>
      <tr>
        <td>Past Medical History</td>
        <td><textarea rows="3" cols="3" class="limited form-control" placeholder="Limited to 100 characters" name="a4"><?php echo $arraylast['past_history'];?></textarea></td>
      </tr>
      <tr>
        <td>Family & Social History</td>
        <td><textarea rows="3" cols="3" class="limited form-control" placeholder="Limited to 100 characters" name="a5"><?php echo $arraylast['family_history'];?></textarea></td>
      </tr>
            <tr>
        <td>Gynacological History</td>
        <td><textarea rows="3" cols="3" class="limited form-control" placeholder="Limited to 100 characters" name="a6"><?php echo $arraylast['gyna_history'];?></textarea></td>
      </tr>
            <tr>
        <td>Medications</td>
        <td><textarea rows="3" cols="3" class="limited form-control" placeholder="Limited to 100 characters" name="a7"><?php echo $arraylast['medication'];?></textarea></td>
      </tr>
            <tr>
        <td>Allergies</td>
        <td><textarea rows="3" cols="3" class="limited form-control" placeholder="Limited to 100 characters" name="a8"><?php echo $arraylast['allergies'];?></textarea></td>
      </tr>
    </tbody>
  </table>