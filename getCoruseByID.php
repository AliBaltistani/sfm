 <?php
 
 include("php/dbconnect.php");
      $gid = $_POST['grade'];
    $sql = "select * from course where delete_status='0' AND grade_id = '$gid' ";
									$q = $conn->query($sql);
                  $output = "";

									while($r = $q->fetch_assoc())
									{
                      $output .= "<option value='".$r['id']."'> ".$r['c_name']."</option> ";
                    
                  }
                
                
                  echo $output;
?>