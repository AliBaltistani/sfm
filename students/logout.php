<?php

ob_start();
session_start();
unset($_SESSION['rainbow_name']);
unset($_SESSION['rainbow_uid']);
unset($_SESSION['rainbow_username']);
unset($_SESSION['student_detail']);
echo '<script type="text/javascript">window.location="login.php"; </script>';


?>