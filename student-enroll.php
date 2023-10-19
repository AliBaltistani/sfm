<?php $page = 'student-enroll';
include("php/dbconnect.php");
include("php/checklogin.php");

$errormsg = '';
$action = "add";

$grade = '';
$detail = '';
$id = '';
if (isset($_POST['save'])) {
  

  $std_id = mysqli_real_escape_string($conn, $_POST['std_id']);
  $grade = mysqli_real_escape_string($conn, $_POST['grade']);
  $courses =  $_POST['course'];


  if ($_POST['action'] == "sv1") {

    foreach($courses as $crs)
    {
      $sql = $conn->query("INSERT INTO enroll_course (student_id,class_id, course_id) VALUES ('$std_id','$grade','$crs')");
    }
  
    $update_sd = "UPDATE student SET grade= '$grade' WHERE id = '$std_id' ";
  $sql = $conn->query($update_sd);

    echo '<script type="text/javascript">window.location="student-enroll.php?act=1";</script>';
    $_POST['action'] = "";

  } else
    if ($_POST['action'] == "up1") {
       $id = mysqli_real_escape_string($conn, $_POST['ec_id']);
        $crs_up = mysqli_real_escape_string($conn, $_POST['crs_up']);
    
      $sql = $conn->query("UPDATE  enroll_course  SET  student_id  = '$std_id', class_id  = '$grade' , course_id  = '$crs_up'  WHERE  id  = '$id'");
       
      echo '<script type="text/javascript">window.location="student-enroll.php?act=2";</script>';
    }



}




if (isset($_GET['action']) && $_GET['action'] == "delete") {

  $conn->query("UPDATE  enroll_course  set delete_status = '1'  WHERE id='" . $_GET['id'] . "'");
  header("location: student-enroll.php?act=3");

}


$action = "add";
if (isset($_GET['action']) && $_GET['action'] == "edit") {
  $action = "update";
  // echo $id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';
 
  // $sqlEdit = $conn->query("SELECT * FROM grade WHERE id='" . $id . "'");
  // if ($sqlEdit->num_rows) {
  //   $rowsEdit = $sqlEdit->fetch_assoc();
  //   extract($rowsEdit);
    
  // } else {
  //   $_GET['action'] = "";
  // }

}


if (isset($_REQUEST['act']) && @$_REQUEST['act'] == "1") {
  $errormsg = "<div class='alert alert-success'> Class has been added successfully</div>";
} else if (isset($_REQUEST['act']) && @$_REQUEST['act'] == "2") {
  $errormsg = "<div class='alert alert-success'> Class has been updated successfully</div>";
} else if (isset($_REQUEST['act']) && @$_REQUEST['act'] == "3") {
  $errormsg = "<div class='alert alert-success'> Class has been deleted successfully</div>";
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

  <script src="js/jquery-1.10.2.js"></script>



</head>
<?php
include("php/header.php");
?>
<div id="page-wrapper">
  <div id="page-inner">
    <div class="row">
      <div class="col-md-12">
        <h1 class="page-head-line">course Enrollment
          <?php
          echo (isset($_GET["action"]) && @$_GET["action"] == "add" || @$_GET["action"] == "edit") ?
            ' <a href="student-enroll.php" class="btn btn-success btn-sm pull-right" style="border-radius:0%">Go Back </a>' : '<a href="student-enroll.php?action=add" class="btn btn-danger btn-sm pull-right" style="border-radius:0%"><i class="glyphicon glyphicon-plus"></i> New Enroll  </a>';
          ?>
        </h1>

        <?php

        echo $errormsg;
        ?>
      </div>
    </div>



    <?php
    if (isset($_GET["action"]) && @$_GET["action"] == "add" || @$_GET["action"] == "edit") {
      ?>

      <script type="text/javascript" src="js/validation/jquery.validate.min.js"></script>
      <div class="row">

        <div class="col-sm-8 col-sm-offset-2">
          <div class="panel panel-success">
            <div class="panel-heading">
              <?php echo ($action == "add") ? "Add Grade" : "Edit Grade"; ?>
            </div>
            <form action="student-enroll.php" method="post" id="signupForm1" class="form-horizontal">
              <div class="panel-body">


                <fieldset class="scheduler-border">
                  <legend class="scheduler-border"> Course Enrollment:</legend>

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
                             $sl = (isset($_GET['std']) && $_GET['std'] == $r1['id'] )? "selected" : "";
                          echo '<option '.$sl .' value="' . $r1['id'] . '">' . $r1['sname'] . '</option>';
                        }

                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-3 control-label getfees" for="Old"> Class* </label>
                    <div class="col-sm-9">
                      <select class="form-control" id="grade" name="grade" onchange="changeGrade(this.value)" required>
                        <option value="" selected>Select Class Level</option>
                        <?php
                        $gid = "";
                        (isset($_GET['gid'])) ? $gid = $_GET['gid'] : "";
                        $sql_grade = "select *  from grade  where delete_status='0' ";
                        $res_grade = $conn->query($sql_grade);

                        while ($rg = $res_grade->fetch_assoc()) {
                          
                          $sl = (isset($_GET['cls']) && $_GET['cls'] == $rg['id'] )? "selected" : "";

                          echo '<option '.$sl.' value="' . $rg['id'] . '">' . $rg['grade'] . '</option>';
                        }

                        ?>
                      </select>
                    </div>
                  </div>
                    
                  <?php
                  if(isset($_GET['action']) && $_GET['action'] == "edit" && isset($_GET['cls'])){ 
                  ?>
                    <div class="form-group">
                    <label class="col-sm-3 control-label" for="Old"> Course* </label>
                    <div class="col-sm-9">
                    
                      <select  class="form-control" id="slCourse" name="crs_up"  required>
                        <option value="">Select Course </option>
                        <?php 

                         $gradeID = $_GET['cls'];
                         $sql_crs = "select * from course  where grade_id = '$gradeID' AND delete_status='0' ";
                       
                        $res_crs = $conn->query($sql_crs);
                        while ($crs1 = $res_crs->fetch_assoc()) {
                          
                          $sl = (isset($_GET['crs']) && $_GET['crs'] == $crs1['id'] )? "selected" : "";

                          echo '<option '.$sl .' value="' . $crs1['id'] . '">' . $crs1['c_name'] . '</option>';
                        }
                         ?>
                      </select>
                       
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label" for="Old"> </label>
                    <div class="col-sm-9">

                      <input type="hidden" name="course[]" value="" multiple>
                      <input type="hidden" name="action" value="up1">
                      <input type="hidden" name="ec_id" value="<?php echo $_GET['id']; ?>">
                      <button type="submit" class="btn btn-success" name="save" value="save">Save</button>
                    </div>
                  </div>
                  <?php }else{ ?>
                  <div class="form-group">
                    <label class="col-sm-3 control-label" for="Old"> Course* </label>
                    <div class="col-sm-9">
                      <select multiple class="form-control" id="slCourse" name="course[]" required>
                        <option value="">Select Course </option>
                        <?php 
                          $sl = (isset($_GET['cls']) && $_GET['cls'] == $rg['id'] )? "selected" : "";
                         ?>
                      </select>
                      <small> cltr + 'left click' </small> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label" for="Old"> </label>
                    <div class="col-sm-9">
                      <input type="hidden" name="action" value="sv1">
                      <button type="submit" class="btn btn-success" name="save" value="save">Save</button>
                    </div>
                  </div>
                  <?php } ?>


                </fieldset>
                 
                
              </div>
            </form>

          </div>
        </div>


      </div>




      <script type="text/javascript">



        function changeGrade(gid) {
          // alert(gid)
          $.ajax({
            type: 'post',
            url: 'getCoruseByID.php',
            data: { grade: gid, req: '1' },
            success: function (data) {
              
              $('#slCourse').html(data);
              // $("#myModal").modal({backdrop: "static"});
            }
          });
        }

        $(document).ready(function () {

          if ($("#signupForm1").length > 0) {
            $("#signupForm1").validate({
              rules: {
                grade: "required",




              },
              messages: {
                grade: "Please enter class name",


              },
              errorElement: "em",
              errorPlacement: function (error, element) {
                // Add the `help-block` class to the error element
                error.addClass("help-block");

                // Add `has-feedback` class to the parent div.form-group
                // in order to add icons to inputs
                element.parents(".col-sm-10").addClass("has-feedback");

                if (element.prop("type") === "checkbox") {
                  error.insertAfter(element.parent("label"));
                } else {
                  error.insertAfter(element);
                }

                // Add the span element, if doesn't exists, and apply the icon classes to it.
                if (!element.next("span")[0]) {
                  $("<span class='glyphicon glyphicon-remove form-control-feedback'></span>").insertAfter(element);
                }
              },
              success: function (label, element) {
                // Add the span element, if doesn't exists, and apply the icon classes to it.
                if (!$(element).next("span")[0]) {
                  $("<span class='glyphicon glyphicon-ok form-control-feedback'></span>").insertAfter($(element));
                }
              },
              highlight: function (element, errorClass, validClass) {
                $(element).parents(".col-sm-10").addClass("has-error").removeClass("has-success");
                $(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
              },
              unhighlight: function (element, errorClass, validClass) {
                $(element).parents(".col-sm-10").addClass("has-success").removeClass("has-error");
                $(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove");
              }
            });

          }

        });
      </script>



      <?php
    } else {
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
                  <th>St. Name</th>
                  <th>St. Class</th>
                  <th>st. Courses</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sql = "select ec.*, st.sname ,gd.grade, cr.c_name  from  
                enroll_course  ec 
                JOIN student st ON  ec.student_id = st.id
                JOIN grade gd ON  ec.class_id = gd.id
                JOIN course cr ON ec.course_id = cr.id
                where ec.delete_status='0'";
                $q = $conn->query($sql);
                $i = 1;
                while ($r = $q->fetch_assoc()) {
                  
                  $url = "action=edit&id=".$r['id']."&std=".$r['student_id']."&cls=".$r['class_id']."&crs=".
                  
                  $r['course_id'];
                  echo '<tr>
                          <td>' . $i . '</td>
                          <td>' . $r['sname'] . '</td>
                          <td>' . $r['grade'] . '</td>
                          <td>' . $r['c_name'] . '</td>
											<td>
                      
											<a href="student-enroll.php?'.$url.' " class="btn btn-success btn-xs" style="border-radius:60px;"><span class="glyphicon glyphicon-edit"></span></a>
											
											<a onclick="return confirm(\'Are you sure you want to delete this record\');" href="student-enroll.php?action=delete&id=' . $r['id'] . '" class="btn btn-danger btn-xs" style="border-radius:60px;"><span class="glyphicon glyphicon-remove"></span></a> </td>
                                        </tr>';
                  $i++;
                }
                ?>



              </tbody>
            </table>
          </div>
        </div>
      </div>

      <script src="js/dataTable/jquery.dataTables.min.js"></script>
      <script>
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

      <?php
    }
    ?>



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