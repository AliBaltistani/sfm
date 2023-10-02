<?php $page = 'fees';

include("../php/dbconnect.php");
include("../php/checklogin.php");
$errormsg = '';
$action = "add";

$grade = '';
$detail = '';
$id = '';

$session_id = $_SESSION['rainbow_uid'];

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>School Fees Management System</title>

  <!-- BOOTSTRAP STYLES-->
  <link href="../css/bootstrap.css" rel="stylesheet" />
  <!-- FONTAWESOME STYLES-->
  <link href="../css/font-awesome.css" rel="stylesheet" />
  <!--CUSTOM BASIC STYLES-->
  <link href="../css/basic.css" rel="stylesheet" />
  <!--CUSTOM MAIN STYLES-->
  <link href="../css/custom.css" rel="stylesheet" />



  <!-- GOOGLE FONTS-->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

  <script src="../js/jquery-1.10.2.js"></script>



</head>
<?php
include("layouts/header.php");
?>
<div id="page-wrapper">
  <div id="page-inner">
    <div class="row">
      <div class="col-md-12">
        <h1 class="page-head-line">Fees Detail
        </h1>
            <?php echo $errormsg; ?>
      </div>
    </div>

      <?php
      {
        ?>

      <link href="css/datatable/datatable.css" rel="stylesheet" />

      <div class="panel panel-default">
        <div class="panel-heading">
          Manage My Fees
        </div>
        <div class="panel-body">
          <div class="table-sorting table-responsive">

            <table class="table table-striped table-bordered table-hover" id="tSortable22">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Total Fees</th>
                  <th>Remaining Fees</th>
                  <th>DOJ</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sql = "select fd.* ,s.sname from fees_details fd 
                JOIN student s ON fd.stdid = s.id
                where  s.id = '$session_id' ";
                $q = $conn->query($sql);
                $i = 1;
                while ($r = $q->fetch_assoc()) {
                  echo '<tr>
                              <td>' . $i . '</td>
                              <td>' . $r['sname'] . '</td>
                              <td>' . $r['totalfee'] . '</td>
                              <td class="text-danger" >' . $r['remainfees'] . '</td>
                              <td>' . $r['timestamp'] . '</td>
											<td>
                      <button class="btn btn-warning btn-sm"  onclick="FeeInfo('.$r['id'].')" > Fee Info </button>
                      <button class="btn btn-primary btn-sm"  onclick="openModel('.$r['id'].')" > Check Report </button>
											</td>
											';
                  $i++;
                }
                ?>



              </tbody >
            </table>
          </div>
        </div>
      </div>

      <!-- <script src="../js/dataTable/jquery.dataTables.min.js"></script> -->
     

      <?php
    }
    ?>



<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Fee Report</h4>
        </div>
        <div class="modal-body"  id="formcontent" >
         
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" style="border-radius:0%" data-dismiss="modal">Close</button>
          <button class="btn btn-primary" id="downloadButton">Download as PDF</button>
        </div>
      </div>
    </div>
  </div>
  <!----END Model----->


  </div>
  <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
</div>
<!-- /. WRAPPER  -->




<!-- BOOTSTRAP SCRIPTS -->
<script src="../js/bootstrap.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="../js/jquery.metisMenu.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="../js/custom1.js"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script> -->
   


<script>
  function openModel(sid){
          // alert(sid)
          $.ajax({
            type: 'post',
            url: 'getmyfeeinfo.php',
            data: {student:sid,req:'2'},
            success: function (data) {
              $('#formcontent').html(data);
			        $("#myModal").modal({backdrop: "static"});
            }
          });

          }

          function FeeInfo(sid){
          // alert(sid)
          $.ajax({
            type: 'post',
            url: 'transcation_report.php',
            data: {student:sid,req:'2'},
            success: function (data) {
              $('#formcontent').html(data);
			        $("#myModal").modal({backdrop: "static"});
            }
          });

          }
      </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.3/html2canvas.min.js"></script> -->



<script>
  function printDiv() {
        //Get the HTML of div
        var divElements = document.getElementById("formcontent").innerHTML;
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
    const printButton = document.getElementById('downloadButton');
    printButton.addEventListener('click', printDiv);


    </script>
</script>


</body>

</html>