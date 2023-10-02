<?php $page = 'add-fees';
include("php/dbconnect.php");
include("php/checklogin.php");


if (isset($_POST['save'])) {


  $std_id = mysqli_real_escape_string($conn, $_POST['std_id']);
  $grade = mysqli_real_escape_string($conn, $_POST['grade']);
  $feesdate = mysqli_real_escape_string($conn, $_POST['feesdate']);
  
  $adm_fees = mysqli_real_escape_string($conn, $_POST['adm_fees']);
  $tu_fees = mysqli_real_escape_string($conn, $_POST['tu_fees']);
  $ho_fees = mysqli_real_escape_string($conn, $_POST['ho_fees']);
  $lib_fees = mysqli_real_escape_string($conn, $_POST['lib_fees']);
  $trn_fees = mysqli_real_escape_string($conn, $_POST['trn_fees']);
  $otr_fees = mysqli_real_escape_string($conn, $_POST['otr_fees']);
  $tl_fees = mysqli_real_escape_string($conn, $_POST['tl_fees']);
  $adv_fees = mysqli_real_escape_string($conn, $_POST['adv_fees']);
  $rem_fees = mysqli_real_escape_string($conn, $_POST['rem_fees']);

  if ($_POST['action'] == "sv1") {

      $sql = $conn->query("INSERT INTO fees_details (stdid,grade_id,admissionfee, tutionfee,hostelfee, libraryfee, transportfee, otherfee, totalfee,advancefee,remainfees, timestamp) VALUES ('$std_id', '$grade', '$adm_fees',  '$tu_fees', '$ho_fees', '$lib_fees', '$trn_fees', '$otr_fees', '$tl_fees','$adv_fees', '$rem_fees', '$feesdate')");
       
      
		 $feeID = $conn->insert_id;
     if($adv_fees){
      $sql = $conn->query("INSERT INTO fees_transaction (stdid,trans_id,grade,paid, transcation_remark) VALUES ('$std_id','$feeID', '$grade', '$adv_fees', '-')");
    }
    
  
      $update_sd = "UPDATE student SET fees= '$tl_fees',  balance = '$rem_fees' WHERE id= '$std_id' ";
  $sql = $conn->query($update_sd);

  
  
  
    echo '<script type="text/javascript">window.location="add-fees.php?act=1";</script>';
    $_POST['action'] = "";

  }

}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>School Fees Management System</title>

  <!-- BOOTSTRAP STYLES-->
  <link href="css/bootstrap.css" rel="stylesheet" />
  <!-- FONTAWESOME STYLES-->
  <link href="css/font-awesome.css" rel="stylesheet" />
  <!--CUSTOM BASIC STYLES-->
  <link href="css/basic.css" rel="stylesheet" />
  <!--CUSTOM MAIN STYLES-->
  <link href="css/custom.css" rel="stylesheet" />
  <!-- GOOGLE FONTS-->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

  <link href="css/ui.css" rel="stylesheet" />
  <link href="css/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" />
  <link href="css/datepicker.css" rel="stylesheet" />
  <link href="css/datatable/datatable.css" rel="stylesheet" />

  <script src="js/jquery-1.10.2.js"></script>
  <script type='text/javascript' src='js/jquery/jquery-ui-1.10.1.custom.min.js'></script>
  <script type="text/javascript" src="js/validation/jquery.validate.min.js"></script>

  <script src="js/dataTable/jquery.dataTables.min.js"></script>



</head>
<?php
include("php/header.php");
?>
<div id="page-wrapper">
  <div id="page-inner">
    <div class="row">
      <div class="col-md-12">
        <h1 class="page-head-line">Fees Management
          <?php
          echo (isset($_GET['action']) && @$_GET['action'] == "add" || @$_GET['action'] == "edit") ?
            ' <a href="add-fees.php" class="btn btn-success btn-sm pull-right" style="border-radius:0%">Go Back </a>' : '<a href="add-fees.php?action=add" class="btn btn-danger btn-sm pull-right" style="border-radius:0%"><i class="glyphicon glyphicon-plus"></i> Add New Fees </a>';
          ?>
        </h1>

      </div>
    </div>

    <?php
    if (isset($_GET['action']) && @$_GET['action'] == "add" || @$_GET['action'] == "edit") {
      ?>
      <script type="text/javascript" src="js/validation/jquery.validate.min.js"></script>
      <div class="row">

        <div class="col-sm-12 ">
          <div class="panel panel-success">
            <div class="panel-heading">
              <?php echo ($_GET['action'] == "add") ? "Add Fees" : "Edit Fees"; ?>
            </div>
            <form action="add-fees.php" method="post" id="signupForm1" class="form-horizontal">
              <div class="panel-body">

                <div class="form-group">
                  <label class="col-sm-3 control-label" for="Old">Student * </label>
                  <div class="col-sm-9">
                    <select class="form-control" id="std_id" name="std_id" required>
                      <option value="" selected>Select Class Level</option>
                      <?php
                      $gid = "";
                      (isset($_GET['gid'])) ? $gid = $_GET['gid'] : "";
                      $sql = "select student.id, student.sname  from student  where delete_status='0' ";
                      $stdres = $conn->query($sql);

                      while ($r1 = $stdres->fetch_assoc()) {
                        $sl = (isset($_GET['std']) && $_GET['std'] == $r1['id']) ? "selected" : "";
                        echo '<option ' . $sl . ' value="' . $r1['id'] . '">' . $r1['sname'] . '</option>';
                      }

                      ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label " for="Old"> Class* </label>
                  <div class="col-sm-9">
                    <select class="form-control" id="grade" name="grade" onchange="changeGrade(this.value)" required>
                      <option value="" selected>Select Class Level</option>
                      <?php
                      $gid = "";
                      (isset($_GET['gid'])) ? $gid = $_GET['gid'] : "";
                      $sql_grade = "select *  from grade  where delete_status='0' ";
                      $res_grade = $conn->query($sql_grade);

                      while ($rg = $res_grade->fetch_assoc()) {

                        $sl = (isset($_GET['cls']) && $_GET['cls'] == $rg['id']) ? "selected" : "";

                        echo '<option ' . $sl . ' value="' . $rg['id'] . '">' . $rg['grade'] . '</option>';
                      }

                      ?>
                    </select>
                  </div>
                </div>
                   
                <div class="form-group">
										<label class="col-sm-2 control-label" for="Old">Date* </label>
										<div class="col-sm-10">
											<input type="date" class="form-control" placeholder="Date of Joining"
												id="joindate" name="feesdate"
												value="<?php echo date("Y-m-d"); ?>"
												style="background-color: #fff;"  />
										</div>
									</div>


                <div class="form-group">
                  <label class="col-sm-2 control-label" for="adm_fees">Admission Fees </label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control getfees" id="adm_fees" name="adm_fees" value="0" required />
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label " for="tu_fees">Tution Fees </label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control getfees" id="tu_fees" name="tu_fees" value="<?php ?>"  required />
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label" for="ho_fees">Hostel Fees </label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control getfees" id="ho_fees" name="ho_fees" value="<?php ?>" />
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label" for="lib_fees">Library Fees </label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control getfees" id="lib_fees" name="lib_fees" value="<?php ?>" />
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label" for="trn_fees">Transport Fees </label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control getfees " id="trn_fees" name="trn_fees" value="<?php ?>" />
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label" for="otr_fees">Other Fees </label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control getfees " id="otr_fees" name="otr_fees" value="<?php ?>" />
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label" for="tl_fees">Total Fees </label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control " id="tl_fees" name="tl_fees" value="<?php ?>" />
                  </div>
                </div>

                <fieldset class="scheduler-border">
                  <legend class="scheduler-border">Optional Fees:</legend>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="adv_fees">Advance Fees </label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control getfees" id="adv_fees" name="adv_fees" value="<?php ?>" />
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="rem_fees">Remaning Fees </label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="rem_fees" name="rem_fees" value="<?php ?>" readonly="true" />
                    </div>
                  </div>

                </fieldset>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="rem_fees"> </label>
                    <div class="col-sm-10">
                       <input type="hidden" name="action" value="sv1">
                      <button type="submit" class="btn btn-success" name="save"  value="save">Save</button>
                    </div>
                  </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    <?php }  ?>

    
    

    <script type="text/javascript">

function calculateFee(){
				    const admissionFee = parseFloat($('#adm_fees').val()) || 0;
				    const tutionFee = parseFloat($('#tu_fees').val()) || 0;
			    	const transportFee = parseFloat($('#trn_fees').val()) || 0;
            const hostelFee = parseFloat($('#ho_fees').val()) || 0;
            const libraryFee = parseFloat($('#lib_fees').val()) || 0;
            const otherFee = parseFloat($('#otr_fees').val()) || 0;

						const totalFee = admissionFee+ tutionFee + transportFee + hostelFee + libraryFee + otherFee;
						$('#tl_fees').val(totalFee);
           if(totalFee){
							if (totalFee != '' && !isNaN(totalFee)) {
								$("#adv_fees").removeAttr("readonly");
								$("#rem_fees").val(totalFee);
								$('#adv_feess').rules("add", {
									max: parseInt(totalFee)
								});

							}
							else {
								$("#adv_fees").attr("readonly", "readonly");
							}
					 }
					
			}

			$('.getfees').on('keyup', calculateFee);
			calculateFee();

      $("#adv_fees").keyup(function () {

var advancefees = parseInt($.trim($(this).val()));
var totalfee = parseInt($("#tl_fees").val());
if (advancefees != '' && !isNaN(advancefees) && advancefees <= totalfee) {
  var balance = totalfee - advancefees;
  $("#rem_fees").val(balance);

}
else {
  $("#rem_fees").val(totalfee);
}

});


        /*
        $('#doj').datepicker( {
                changeMonth: true,
                changeYear: true,
                showButtonPanel: false,
                dateFormat: 'mm/yy',
                onClose: function(dateText, inst) { 
                    $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
                }
            });
          
        */

        /******************/
        $("#doj").datepicker({

          changeMonth: true,
          changeYear: true,
          showButtonPanel: true,
          dateFormat: 'mm/yy',
          onClose: function (dateText, inst) {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).val($.datepicker.formatDate('MM yy', new Date(year, month, 1)));
          }
        });

        $("#doj").focus(function () {
          $(".ui-datepicker-calendar").hide();
          $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
          });
        });

        /*****************/

        $('#student').autocomplete({
          source: function (request, response) {
            $.ajax({
              url: 'ajx.php',
              dataType: "json",
              data: {
                name_startsWith: request.term,
                type: 'report'
              },
              success: function (data) {

                response($.map(data, function (item) {

                  return {
                    label: item,
                    value: item
                  }
                }));
              }



            });
          }
          /*,
              autoFocus: true,
              minLength: 0,
                   select: function( event, ui ) {
                var abc = ui.item.label.split("-");
                //alert(abc[0]);
                 $("#student").val(abc[0]);
                 return false;
  
                },
                   */



        });


      

    




      function GetFeeForm(sid) {

        $.ajax({
          type: 'post',
          url: 'getfeeform.php',
          data: { student: sid, req: '2' },
          success: function (data) {
            $('#formcontent').html(data);
            $("#myModal").modal({ backdrop: "static" });
          }
        });


      }

    </script>




    <style>
      #doj .ui-datepicker-calendar {
        display: none;
      }
    </style>

<?php 
$_GET['action'] = ''; 
if ( $_GET['action'] == "" ) {
?>
<link href="css/datatable/datatable.css" rel="stylesheet" />
<div class="panel panel-default">
				<div class="panel-heading">
					Manage Class Level
				</div>
				<div class="panel-body">
					<div class="table-sorting table-responsive">

						<table class="table table-striped table-bordered table-hover" id="tSortable22">
							<thead>
								<tr>
									<th>#</th>
									<th>St. Name | Class</th>
									<th>Total Fee</th>
                  <th>Remain Fee</th>
                  <th>Fee Issue Date </th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$sql = "select fd.id ,fd.totalfee,fd.remainfees, fd.timestamp, std.sname,gd.grade  from fees_details fd 
                JOIN student std ON fd.stdid = std.id 
                JOIN grade gd ON fd.grade_id = gd.id
                where fd.delete_status='0'";
								$q = $conn->query($sql);
								$i = 1;
								while ($r = $q->fetch_assoc()) {
									echo '<tr>
                                            <td>' . $i . '</td>
                                            <td>' . $r['sname'] ." | ".$r['grade']. '</td>
                                            <td>' . $r['totalfee'] . '</td>
                                            <td>' . $r['remainfees'] . '</td>
                                            <td>' . $r['timestamp'] . '</td>
											<td>
                     
                      <button class="btn btn-info btn-sm"  onclick="openModel('.$r['id'].')" > More Details </button>

                      <button class="btn btn-success btn-sm"  onclick="collectFee('.$r['id'].')" >Collect Fee </button>
											
											</td>
                                        </tr>';
									$i++;
								}
								?>



							</tbody>
						</table>
					</div>
				</div>
			</div>

    <?php }?>
			<script src="js/dataTable/jquery.dataTables.min.js"></script>
			<script>

function openModel(sid){
          // alert(sid)
          $.ajax({
            type: 'post',
            url: 'feeDetails.php',
            data: {student:sid,req:'2'},
            success: function (data) {
              
              $('#formcontent').html(data);
			        $("#myModal").modal({backdrop: "static"});
            }
          });

          }

          function collectFee(sid){
          $.ajax({
            type: 'post',
            url: 'feeCollect.php',
            data: {student:sid,req:'2'},
            success: function (data) {
              
              $('#formcontent').html(data);
			        $("#myModal").modal({backdrop: "static"});
            }
          });

          }


				$(document).ready(function () {
					$('#tSortable22').dataTable({
						"bPaginate": true,
						"bLengthChange": false,
						"bFilter": true,
						"bInfo": false,
						"bAutoWidth": true
					});

				});


			</script>

    <!-------->

    <!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Fee Slip: </h4>
        </div>
        <div class="modal-body"  id="formcontent" >
         
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" style="border-radius:0%" data-dismiss="modal">Close</button>
          
          <button  class="btn btn-primary" id="printButton">Print Slip</button>
        </div>
      </div>
    </div>
  </div>
  <!----END Model----->


    <script>

function printDiv() {
        //Get the HTML of div
        var divElements = document.getElementById("myTable").innerHTML;
        //Get the HTML of whole page
        var oldPage = document.body.innerHTML;
        //Reset the page's HTML with div's HTML only
        document.body.innerHTML = 
          "<html><head><title></title></head><body>" + 
          divElements + "</body>";
        //Print Page
        window.print();
        //Restore orignal HTML
        document.body.innerHTML = oldPage;

    }
    const printButton = document.getElementById('printButton');
    printButton.addEventListener('click', printDiv);


    </script>


    <!-- <script>
        // Function to print the table data
        function printTable() {
            // Open the print dialog
            window.print();
        }

        // Add a click event listener to the print button
        const printButton = document.getElementById('printButton');
        printButton.addEventListener('click', printTable);
    </script> -->

    <!--------->


  </div>
  <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
</div>
<!-- /. WRAPPER  -->


<!-- BOOTSTRAP SCRIPTS -->
<script src="js/bootstrap.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="js/jquery.metisMenu.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="js/custom1.js"></script>


</body>

</html>