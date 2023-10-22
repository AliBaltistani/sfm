<?php

include("php/dbconnect.php");

if (isset($_POST['req']) && $_POST['req'] == '2') {

  $sid = (isset($_POST['student'])) ? mysqli_real_escape_string($conn, $_POST['student']) : '';


  $sql = "SELECT fd.*, std.sname, std.contact,std.father_name,std.srollno, gd.grade FROM 
  fees_details fd 
  JOIN student std ON fd.stdid = std.id 
  JOIN grade gd ON fd.grade_id = gd.id
  WHERE fd.id='$sid'";

  $fq = $conn->query($sql);

  if ($fq->num_rows > 0) {
    $sr = $fq->fetch_assoc();
    extract($sr);
  } else {
    die("no records Found");
  }
}
?>

<table id="myTable">
  <style>
    table {
      width: 100%;
      border: 1px solid black;
      border-collapse: collapse;
    }

    td,
    th {
      padding: 5px;

    }

    .title {
      text-align: center;
    }
  </style>
  <tbody>
    <tr>
      <!-- Student Copy -->
      <td>
        <table style="border-collapse: collapse; " width="100%">
          <thead style="padding:10px 0;">
            <tr>
              <th colspan="4" Class="title">
                <h3><strong>SUNRISE PUBLIC SCHOOL MURKUNJA SHIGAR</strong></h3>
                <p>Micro Finace Bank Shigar/ Karakuram Coop-Bank Shigar</p>
                <h4>Student Copy</h4>
              </th>
            </tr>
            <tr>
              <td border="none" width="20%">Name: </td>
              <td width="30%"><u>
                  <?php echo $sname; ?>
                </u></td>

              <td border="none" width="20%">Class: </td>
              <td width="30%"><u>
                  <?php echo $grade; ?>
                </u></td>
            </tr>
            <tr>
              <td border="none" width="20%">F.Name: </td>
              <td width="30%"><u>
                  <?php echo $father_name; ?>
                </u></td>

              <td border="none" width="20%">Roll no: </td>
              <td width="30%"><u>
                  <?php echo $srollno; ?>
                </u></td>
            </tr>
            <tr>
              <td border="none" width="20%">Issue Date: </td>
              <td width="30%"><u>
                  <?php echo date("d-M-Y", strtotime($sr['timestamp'])); ?>
                </u></td>
              <td border="none" width="20%">Last Date: </td>
              <td width="30%"><u>
                  <?php echo date("d-M-Y", strtotime($sr['timestamp'] . "+ 10 days")); ?>
                </u></td>
            </tr>
            <tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="4">
                <table border="1px solid black" style="border-collapse: collapse; " width="100%">
                  <tbody>
                    <tr>
                      <th width="16%">Sr#</th>
                      <th>Particular</th>
                      <th>Amount</th>
                    </tr>
                    <tr>
                      <td>1</td>
                      <td>Admission Fees</td>
                      <td>
                        <?php echo $admissionfee; ?>
                      </td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Tution Fees</td>
                      <td>
                        <?php echo $tutionfee; ?>
                      </td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Hostel Fees</td>
                      <td>
                        <?php echo $hostelfee; ?>
                      </td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>Library Fees</td>
                      <td>
                        <?php echo $libraryfee; ?>
                      </td>
                    </tr>
                    <tr>
                      <td>5</td>
                      <td>Transport Fees</td>
                      <td>
                        <?php echo $transportfee; ?>
                      </td>
                    </tr>
                    <tr>
                      <td>6</td>
                      <td>Other Fees</td>
                      <td>
                        <?php echo $otherfee; ?>
                      </td>
                    </tr>
                    <tr>
                      <td>7</td>
                      <td>Discount (%) </td>
                      <td>
                        <?php
                        $dis = ($dscount_percent / 100) * $totalfee;
                        echo ($dscount_percent != 0) ? "" . $dis . " ( " . $dscount_percent . " % )" : 0; ?>
                      </td>
                    </tr>
                    
                    <tr>
                      <td><b>8</b></td>
                      <td><strong>Total Fees</strong> </td>
                      <td><strong>
                          <?php echo ($dscount_percent != 0) ? "<strike>" . $totalfee . "</strike>" : $totalfee; ?>
                        </strong></td>
                    </tr>
                    <?php if($dscount_percent != 0){ ?> 
                    <tr>
                      <td><b>9</b></td>
                      <td><strong>Total Discount</strong> </td>
                      <td><strong>
                          <?php echo $total_discount; ?>
                        </strong></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr style="border: none; margin-top: 20px;">
                      <td colspan="3"></td>
                    </tr>

                    <tr style="border: none; margin-top: 20px;">
                      <td>Paid fees : </td>
                      <td colspan="2">
                        <?php echo ($dscount_percent != 0) ? $total_discount - $remainfees : $totalfee - $remainfees; ?>
                      </td>
                    </tr>
                    <tr style="border: none; margin-top: 20px;">
                      <td>Remaining fees: </td>
                      <td colspan="2">
                        <?php echo $remainfees; ?>
                      </td>
                    </tr>
                  </tfoot>
                </table>
              </td>
            </tr>
          </tbody>
        </table>
      </td>
      <!-- end student copy -->

      <!-- Bank Copy -->
      <td>
        <table style="border-collapse: collapse; " width="100%">
          <thead style="padding:10px 0;">
            <tr>
              <th colspan="4" Class="title">
                <h3><strong>SUNRISE PUBLIC SCHOOL MURKUNJA SHIGAR</strong></h3>
                <p>Micro Finace Bank Shigar/ Karakuram Coop-Bank Shigar</p>
                <h4> Bank Copy</h4>
              </th>
            </tr>
            <tr>
              <td border="none" width="20%">Name: </td>
              <td width="30%"><u>
                  <?php echo $sname; ?>
                </u></td>

              <td border="none" width="20%">Class: </td>
              <td width="30%"><u>
                  <?php echo $grade; ?>
                </u></td>
            </tr>
            <tr>
              <td border="none" width="20%">F.Name: </td>
              <td width="30%"><u>
                  <?php echo $father_name; ?>
                </u></td>

              <td border="none" width="20%">Roll no: </td>
              <td width="30%"><u>
                  <?php echo $srollno; ?>
                </u></td>
            </tr>
            <tr>
              <td border="none" width="20%">Issue Date: </td>
              <td width="30%"><u>
                  <?php echo date("d-M-Y", strtotime($sr['timestamp'])); ?>
                </u></td>
              <td border="none" width="20%">Last Date: </td>
              <td width="30%"><u>
                  <?php echo date("d-M-Y", strtotime($sr['timestamp'] . "+ 10 days")); ?>
                </u></td>
            </tr>
            <tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="4">
                <table border="1px solid black" style="border-collapse: collapse; " width="100%">
                  <tbody>
                    <tr>
                      <th width="16%">Sr#</th>
                      <th>Particular</th>
                      <th>Amount</th>
                    </tr>
                    <tr>
                      <td>1</td>
                      <td>Admission Fees</td>
                      <td>
                        <?php echo $admissionfee; ?>
                      </td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Tution Fees</td>
                      <td>
                        <?php echo $tutionfee; ?>
                      </td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Hostel Fees</td>
                      <td>
                        <?php echo $hostelfee; ?>
                      </td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>Library Fees</td>
                      <td>
                        <?php echo $libraryfee; ?>
                      </td>
                    </tr>
                    <tr>
                      <td>5</td>
                      <td>Transport Fees</td>
                      <td>
                        <?php echo $transportfee; ?>
                      </td>
                    </tr>
                    <tr>
                      <td>6</td>
                      <td>Other Fees</td>
                      <td>
                        <?php echo $otherfee; ?>
                      </td>
                    </tr>
                    <tr>
                      <td>7</td>
                      <td>Discount (%) </td>
                      <td>
                        <?php
                        $dis = ($dscount_percent / 100) * $totalfee;
                        echo ($dscount_percent != 0) ? "" . $dis . " ( " . $dscount_percent . " % )" : 0; ?>
                      </td>
                    </tr>
                  
                    <tr>
                      <td><b>8</b></td>
                      <td><strong>Total Fees</strong> </td>
                      <td><strong>
                          <?php echo ($dscount_percent != 0) ? "<strike>" . $totalfee . "</strike>" : $totalfee; ?>
                        </strong></td>
                    </tr>
                    <?php if($dscount_percent != 0){ ?> 
                    <tr>
                      <td><b>9</b></td>
                      <td><strong>Total Discount</strong> </td>
                      <td><strong>
                          <?php echo $total_discount; ?>
                        </strong></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr style="border: none; margin-top: 20px;">
                      <td colspan="3"></td>
                    </tr>

                    <tr style="border: none; margin-top: 20px;">
                      <td>Paid fees : </td>
                      <td colspan="2">
                        <?php echo ($dscount_percent != 0) ? $total_discount - $remainfees : $totalfee - $remainfees; ?>
                      </td>
                    </tr>
                    <tr style="border: none; margin-top: 20px;">
                      <td>Remaining fees: </td>
                      <td colspan="2">
                        <?php echo $remainfees; ?>
                      </td>
                    </tr>
                  </tfoot>
                </table>
              </td>
            </tr>
          </tbody>
        </table>
      </td>
      <!-- end Bank copy -->

      <!-- Admin Copy -->
      <td>
        <table style="border-collapse: collapse; " width="100%">
          <thead style="padding:10px 0;">
            <tr>
              <th colspan="4" Class="title">
                <h3><strong>SUNRISE PUBLIC SCHOOL MURKUNJA SHIGAR</strong></h3>
                <p>Micro Finace Bank Shigar/ Karakuram Coop-Bank Shigar</p>
                <h4>Admin/School Copy</h4>
              </th>
            </tr>
            <tr>
              <td border="none" width="20%">Name: </td>
              <td width="30%"><u>
                  <?php echo $sname; ?>
                </u></td>

              <td border="none" width="20%">Class: </td>
              <td width="30%"><u>
                  <?php echo $grade; ?>
                </u></td>
            </tr>
            <tr>
              <td border="none" width="20%">F.Name: </td>
              <td width="30%"><u>
                  <?php echo $father_name; ?>
                </u></td>

              <td border="none" width="20%">Roll no: </td>
              <td width="30%"><u>
                  <?php echo $srollno; ?>
                </u></td>
            </tr>
            <tr>
              <td border="none" width="20%">Issue Date: </td>
              <td width="30%"><u>
                  <?php echo date("d-M-Y", strtotime($sr['timestamp'])); ?>
                </u></td>
              <td border="none" width="20%">Last Date: </td>
              <td width="30%"><u>
                  <?php echo date("d-M-Y", strtotime($sr['timestamp'] . "+ 10 days")); ?>
                </u></td>
            </tr>
            <tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="4">
                <table border="1px solid black" style="border-collapse: collapse; " width="100%">
                  <tbody>
                    <tr>
                      <th width="16%">Sr#</th>
                      <th>Particular</th>
                      <th>Amount</th>
                    </tr>
                    <tr>
                      <td>1</td>
                      <td>Admission Fees</td>
                      <td>
                        <?php echo $admissionfee; ?>
                      </td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Tution Fees</td>
                      <td>
                        <?php echo $tutionfee; ?>
                      </td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Hostel Fees</td>
                      <td>
                        <?php echo $hostelfee; ?>
                      </td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>Library Fees</td>
                      <td>
                        <?php echo $libraryfee; ?>
                      </td>
                    </tr>
                    <tr>
                      <td>5</td>
                      <td>Transport Fees</td>
                      <td>
                        <?php echo $transportfee; ?>
                      </td>
                    </tr>
                    <tr>
                      <td>6</td>
                      <td>Other Fees</td>
                      <td>
                        <?php echo $otherfee; ?>
                      </td>
                    </tr>
                    <tr>
                      <td>7</td>
                      <td>Discount (%) </td>
                      <td>
                        <?php
                        $dis = ($dscount_percent / 100) * $totalfee;
                        echo ($dscount_percent != 0) ? "" . $dis . " ( " . $dscount_percent . " % )" : 0; ?>
                      </td>
                    </tr>
                    
                    <tr>
                      <td><b>8</b></td>
                      <td><strong>Total Fees</strong> </td>
                      <td><strong>
                          <?php echo ($dscount_percent != 0) ? "<strike>" . $totalfee . "</strike>" : $totalfee; ?>
                        </strong></td>
                    </tr>
                    <?php if($dscount_percent != 0){ ?> 
                    <tr>
                      <td><b>9</b></td>
                      <td><strong>Total Discount</strong> </td>
                      <td><strong>
                          <?php echo $total_discount; ?>
                        </strong></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr style="border: none; margin-top: 20px;">
                      <td colspan="3"></td>
                    </tr>

                    <tr style="border: none; margin-top: 20px;">
                      <td>Paid fees : </td>
                      <td colspan="2">
                        <?php echo ($dscount_percent != 0) ? $total_discount - $remainfees : $totalfee - $remainfees; ?>
                      </td>
                    </tr>
                    <tr style="border: none; margin-top: 20px;">
                      <td>Remaining fees: </td>
                      <td colspan="2">
                        <?php echo $remainfees; ?>
                      </td>
                    </tr>
                  </tfoot>
                </table>
              </td>
            </tr>
          </tbody>
        </table>
      </td>
      <!-- end Admin copy -->

    </tr>
  </tbody>
</table>