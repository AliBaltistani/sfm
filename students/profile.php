<?php $page = 'profile';
include("../php/dbconnect.php");
include("../php/checklogin.php");
$error = '';

$id = $_SESSION['rainbow_uid'];
$sql = "select  s.*, g.grade AS stdClass from student s 
								       JOIN grade g ON s.grade = g.id
								      where  s.id = ".$id;

$sqlEdit = $conn->query($sql);
if ($sqlEdit->num_rows) {
  $rowsEdit = $sqlEdit->fetch_assoc();
  extract($rowsEdit);
}

if (isset($_REQUEST['acts']) && $_REQUEST['acts'] == "update") {
  $image_path = 'images/'.$_FILES['image']['name'];
  $image_temp =  $_FILES['image']['tmp_name'];
  move_uploaded_file($image_temp, $image_path);
  
  $sid = mysqli_real_escape_string($conn, $_REQUEST['sid']);
  $contact = mysqli_real_escape_string($conn, $_REQUEST['contact']);
  $about = mysqli_real_escape_string($conn, $_REQUEST['about']);
  $emailid = mysqli_real_escape_string($conn, $_REQUEST['emailid']);

  $sql = $conn->query(" UPDATE  student  SET contact = '$contact', about = '$about', emailid = '$emailid' , image = '$image_path'  WHERE  id  = '$sid' ");
  echo '<script type="text/javascript">window.location="profile.php";</script>';

  $_SESSION['student_detail']['image'] = $image_path;

}

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

  <script type="text/javascript" src="../js/validation/jquery.validate.min.js"></script>

  <style>
    .main-body {
      padding: 15px;
    }

    .card {
      box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
    }

    .card {
      position: relative;
      display: flex;
      flex-direction: column;
      min-width: 0;
      word-wrap: break-word;
      background-color: #fff;
      background-clip: border-box;
      border: 0 solid rgba(0, 0, 0, .125);
      border-radius: .25rem;
    }

    .card-body {
      flex: 1 1 auto;
      min-height: 1px;
      padding: 1rem;
    }

    .gutters-sm {
      margin-right: -8px;
      margin-left: -8px;
    }

    .gutters-sm>.col,
    .gutters-sm>[class*=col-] {
      padding-right: 8px;
      padding-left: 8px;
    }

    .mb-3,
    .my-3 {
      margin-bottom: 1rem !important;
    }

    .bg-gray-300 {
      background-color: #e2e8f0;
    }

    .h-100 {
      height: 100% !important;
    }

    .shadow-none {
      box-shadow: none !important;
    }
  </style>

</head>
<?php
include("layouts/header.php");
?>
<div id="page-wrapper">
  <div id="page-inner">
    <div class="row">
      <div class="col-md-12">
        <h1 class="page-head-line">My Profile </h1>

        <?php
        if (isset($_REQUEST['act']) && @$_REQUEST['act'] == '1') {
          echo '<div class="alert alert-success">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> Password Change Successfully.
</div>';

        }
        echo $error;
        ?>
      </div>
    </div>
    <!-- /. ROW  -->
    <div class="row">

      <div class="col-sm-12 ">

        <fieldset class="scheduler-border">
          <form action="profile.php?acts=update" method="POST" enctype="multipart/form-data">
            <legend class="scheduler-border">Personal Information:</legend>
            <div class="row gutters-sm">
              <div class="col-md-4 mb-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">

                    <?php if(isset($_SESSION['student_detail']['image'])){
                      echo '<img src="'.$_SESSION['student_detail']['image'].'" alt="Student" class="rounded-circle"
                      width="150">';
                    }else{ ?>
                      <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle"
                        width="150">
                        <?php
                    }

if (isset($_GET['acts']) && $_GET['acts'] == "edit") {
  echo '<input type="file" name="image" value="">';

  echo '<input type="hidden" name="sid" value="'.$id .'">';
} 
?>
                      <div class="mt-3">
                        <h3>
                          <?php
                            echo $sname;
                          
                          ?>
                        </h3>

                        <p class="text-muted font-size-sm">
                          <?php

                          if (isset($_GET['acts']) && $_GET['acts'] == "edit") {
                            echo '<input name="contact" value="' . $contact . '">';
                          } else {
                            echo $contact;
                          }
                          ?>
                        </p>
                        <p class="text-secondary mb-1">
                          <?php
                          if (isset($_GET['acts']) && $_GET['acts'] == "edit") {
                            echo '<textarea name="about" placeholder="Tell us About yourself" >' . $about . ' </textarea>';
                          } else {
                            echo $about;
                          }
                          ?>
                        </p>
                        <button class="btn btn-primary">Follow</button>
                        <button class="btn btn-outline-primary">Message</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="card mb-3">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-3">
                        <label class="mb-0 control-label">Account Status</label>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <?php echo ($delete_status == 1) ? "Deactivated" : "<span class='btn btn-sm bg-success' >Active</span>"; ?>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <label class="mb-0 control-label">Join Date</label>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <?php echo $joindate; ?>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <label class="mb-0 control-label">Email</label>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <?php
                        if (isset($_GET['acts']) && $_GET['acts'] == "edit") {
                          echo '<input name="emailid" value="' . $emailid . '">';
                        } else {
                          echo $emailid;
                        } ?>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <label class="mb-0 control-label">Enroll Class</label>

                      </div>
                      <div class="col-sm-9 text-secondary">
                        <?php echo $stdClass; ?>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <label class="control-label" for="phone"> Total Fees</label>

                      </div>
                      <div class="col-sm-9 text-secondary">
                        <?php echo $fees; ?>
                      </div>
                    </div>

                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <label class="mb-0 control-label">Remaning Fees</label>

                      </div>
                      <div class="col-sm-9 text-secondary">
                        <?php echo $balance; ?>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-12">

                        <?php
                        if (isset($_GET['acts']) && $_GET['acts'] == "edit") {
                          echo '<button type="submit" class="btn btn-warning " >Update</button>';
                        } else {
                          echo '<a class="btn btn-info " href="profile.php?acts=edit">Edit</a>';
                        } ?>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- <div class="row gutters-sm">
                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">assignment</i>Project Status</h6>
                      <small>Web Design</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Website Markup</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>One Page</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Mobile Template</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Backend API</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">assignment</i>Project Status</h6>
                      <small>Web Design</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Website Markup</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>One Page</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Mobile Template</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Backend API</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->



              </div>
            </div>

          </form>
        </fieldset>

       
      </div>


    </div>
    <!-- /. ROW  -->


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

<script type="text/javascript">


  $(document).ready(function () {

    $("#signupForm1").validate({
      rules: {
        oldpassword: "required",

        newpassword: {
          required: true,
          minlength: 6
        },

        confirmpassword: {
          required: true,
          minlength: 6,
          equalTo: "#newpassword"
        }
      },
      messages: {
        oldpassword: "Please enter your old password",

        newpassword: {
          required: "Please provide a password",
          minlength: "Your password must be at least 6 characters long"
        },
        confirmpassword: {
          required: "Please provide a password",
          minlength: "Your password must be at least 6 characters long",
          equalTo: "Please enter the same password as above"
        }
      },
      errorElement: "em",
      errorPlacement: function (error, element) {
        // Add the `help-block` class to the error element
        error.addClass("help-block");

        // Add `has-feedback` class to the parent div.form-group
        // in order to add icons to inputs
        element.parents(".col-sm-5").addClass("has-feedback");

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
        $(element).parents(".col-sm-5").addClass("has-error").removeClass("has-success");
        $(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).parents(".col-sm-5").addClass("has-success").removeClass("has-error");
        $(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove");
      }
    });
  });
</script>


</body>

</html>