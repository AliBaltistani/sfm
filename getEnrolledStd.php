 <?php
 
 include("php/dbconnect.php");
      $gid = $_POST['student'];
    $sql = "select * from student where delete_status='0' AND grade = '$gid' ORDER BY joindate = 'DESC'";
									$q = $conn->query($sql);
                  $output = "";

									while($r = $q->fetch_assoc())
									{
                      $output .= "<option value='".$r['id']."'> ".$r['sname']." <strong> ( S.O/D.O ) </strong> ".$r['father_name']."</option> ";
                    
                  }
                  if($q->num_rows == 0){
                    $output .= "<option value=''>No Records Found</option> ";
                  }
                
                
                  echo $output;
?>