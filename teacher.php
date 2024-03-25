<?php

  require_once 'connection.php';
  $conn = connectToDatabase();
  $sql = "SELECT * FROM `teacher`";
  $rs = $conn->query($sql);

  while ($row = mysqli_fetch_assoc($rs)) {
    echo
      '     <div class="r4-r2-c1">
      
                      <div class="r4-r2-c1-r1">
                          <img src="../VGROWPHP/admin/assets/Teacher/'. $row['Image'].'" alt="' . $row['Image'] . '" />
                      </div>
                      <div class="r4-r2-c1-r2">
                        <h6>' . $row['Name'] . '</h6>
                      </div>
                      
                  </div>
            ';
  
 } // C:\xampp\htdocs\V-Grow\VGROWphp\admin\assets\Teacher\teacher-1.jpg

  $conn->close();





?>