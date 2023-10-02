<style>
        /* Custom CSS for the print format */
        @media print {
            body {
                font-family: Arial, sans-serif;
                font-size: 12px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid #000;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }
        }
    </style>

<?php
include("../php/dbconnect.php");


echo '<table width="80%" style="margin:auto;" id="myTable" >
<tr>
  <td >';
if (isset($_POST['req']) && $_POST['req'] == '2') {

  $sid = (isset($_POST['student'])) ? mysqli_real_escape_string($conn, $_POST['student']) : '';

  
  $sql = "SELECT ft.id, std.sname, std.contact, std.joindate, ft.grade FROM fees_transaction ft
  JOIN student std ON ft.stdid = std.id
  WHERE ft.trans_id='$sid'";
  
  $fq = $conn->query($sql);

  if ($fq->num_rows > 0) {
    $sr = $fq->fetch_assoc();


    echo '
<h4>Student Info</h4>
<div class="table-responsive">
<table class="table table-bordered">
<tr>
<th>Full Name</th>
<td>' . $sr['sname'] . '</td>
<th>Grade</th>
<td>' . $sr['grade'] . '</td>
</tr>
<tr>
<th>Contact</th>
<td>' . $sr['contact'] . '</td>
<th>Fees Issue </th>
<td>' . date("d-m-Y", strtotime($sr['joindate'])) . '</td>
</tr>


</table>
</div>
';

$raa = '
<h4>Transcation Details</h4>
<div class="table-responsive">
<table class="table table-bordered">
 <thead>
   <tr>
      <th>Transcation Date</th>
      <th>Amount Paid</th>
      <th>Transcation Remark</th>
   </tr>
 </thead>
 <tbody>';

$sql = "SELECT *  FROM fees_transaction
WHERE trans_id='$sid'";

$fq = $conn->query($sql);

if ($fq->num_rows > 0) {
  while($sr = $fq->fetch_assoc()){
 
    $raa .= '
          <tr>
            <td> ' . $sr['submitdate'] . '</td>
            <td> Rs. ' . $sr['paid'] . '</td>
            <td> ' . $sr['transcation_remark'] . '</td>
          </tr>
        ';
  }}
 
  $raa .= '
 </tbody>

</table>
</div>
';

echo $raa;

$sql = "SELECT totalfee,advancefee, remainfees  FROM fees_details
WHERE id='$sid'";

$fq = $conn->query($sql);

if ($fq->num_rows > 0) {
  while($sr = $fq->fetch_assoc()){

    echo ' 
<table  >
<tr>
<th>Total Fees: 
</th>
<td style="padding-left: 10px;" >' . 'Rs. ' . $sr['totalfee'] . '
</td>
</tr>

<tr>
<th>Total Paid: 
</th>
<td style="padding-left: 10px; color:green;" >' . 'Rs. ' . $sr['totalfee'] - $sr['remainfees'] . '
</td>
</tr>

<tr>
<th>Remaning Fees: 
</th>
<td style="padding-left: 10px; color:red; " >' . 'Rs. ' . $sr['remainfees'] . '
</td>
</tr>
</table>
 ';
  }}

  } else {
    echo 'No fees submit.';
  }

} else {
  echo "Some thing went wrong.. please try again later";
}


echo '
            </td>
          </tr>
         </table>
         ';

?>




