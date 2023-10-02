
<Style>
  .form-control{
    margin: 10px auto;
  }
</Style>

<?php
include("php/dbconnect.php");


if (isset($_POST['save'])) {
   

  $feeID = mysqli_real_escape_string($conn, $_POST['feeID']);
  $std_id = mysqli_real_escape_string($conn, $_POST['stdid']);
  $grade = mysqli_real_escape_string($conn, $_POST['class']);
  $paid = mysqli_real_escape_string($conn, $_POST['adpay']);
  $remark = mysqli_real_escape_string($conn, $_POST['remark']);
  $remFee = mysqli_real_escape_string($conn, $_POST['remFee']);

  $total_rem = $remFee - $paid;

   $sql = $conn->query("INSERT INTO fees_transaction (stdid,trans_id,grade,paid, transcation_remark) VALUES ('$std_id','$feeID', '$grade', '$paid', '$remark')");

   $update_fd = "UPDATE fees_details SET remainfees = '$total_rem' WHERE id= '$feeID' ";
  
  $sql = $conn->query($update_fd);

  $update_sd = "UPDATE student SET balance = '$total_rem' WHERE id= '$std_id' ";
  $sql = $conn->query($update_sd);
  echo '<script type="text/javascript">window.location="add-fees.php?act=1";</script>';

		$_POST['action'] = "";

}
 $sid = (isset($_POST['student'])) ? mysqli_real_escape_string($conn, $_POST['student']) : '';

  
 $sql = "SELECT  fd.id AS feeID, fd.totalfee, fd.advancefee, fd.remainfees , fd.timestamp, std.id, std.sname, std.contact, gd.grade 
          FROM fees_details fd 
          JOIN student std ON fd.stdid = std.id 
          JOIN grade gd ON fd.grade_id = gd.id
          WHERE fd.id='$sid'";
 
 $fq = $conn->query($sql);

 if ($fq->num_rows > 0) {
   $sr = $fq->fetch_assoc();
  
 ?>
 <form action="feeCollect.php" method="POST" >
<fieldset class="scheduler-border">
  <legend class="scheduler-border">Optional Information:</legend>
  
  <div class="form-group">
    <label class="col-sm-3  control-label" for="">Student Name </label>
    <div class="col-sm-9">
    <input type="hidden" class="form-control" id="stdid" name="stdid" value="<?php echo $sr['id']; ?>" />
    <input type="hidden" class="form-control" id="feeID" name="feeID" value="<?php echo $sr['feeID']; ?>" />
      <input class="form-control" id="sname" name="sname" value="<?php echo $sr['sname']; ?>" readonly="true" />
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label" for="">Class </label>
    <div class="col-sm-9">
      <input class="form-control" id="sname" name="class"  value="<?php echo $sr['grade']; ?>" readonly="true" />
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label" for="">Date </label>
    <div class="col-sm-9">
      <input class="form-control" id="sname" name="date"  value="<?php echo $sr['timestamp']; ?>" readonly="true" />
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label" for="">Total Fee </label>
    <div class="col-sm-9">
      <input class="form-control" id="sname" name="tfee"  value="<?php echo $sr['totalfee']; ?>" readonly="true" />
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label" for="">Payable Fee </label>
    <div class="col-sm-9">
      <input class="form-control" id="sname" name="remFee"  value="<?php echo $sr['remainfees']; ?>" readonly="true" />
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label" for=""> Payment </label>
    <div class="col-sm-9">
      <input type="number" class="form-control" id="sname" name="adpay"  />
    </div>
  </div>

  <div class="form-group">
										<label class="col-sm-3 control-label" for="Password">Remark </label>
										<div class="col-sm-9">
											<textarea class="form-control" id="about" name="remark"></textarea>
										</div>
									</div>

                  <div class="form-group">
										<label class="col-sm-3 control-label" for="Password"> </label>
										<div class="col-sm-9">
											<button class="btn btn-success"  type="submit" name="save"  value="save">Submit</button>
										</div>
									</div>

</fieldset>
</form>
<?php } ?>