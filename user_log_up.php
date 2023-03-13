<table cellpadding="0" cellspacing="0" border="0">
  <tbody>
    <?php

      session_start();
      //Connect to database
      require'connectDB.php';
      $course = $_SESSION['course'];

      if (isset($_POST['log_date'])) {
        if ($_POST['date_sel'] != 0) {
            $_SESSION['seldate'] = $_POST['date_sel'];
        }
    }
    
    if (isset($_POST['select_date']) && $_POST['select_date'] == 1) {
        $_SESSION['seldate'] = date("Y-m-d");
    }
    
    $seldate = $_SESSION['seldate'] ?? date("Y-m-d");

      
      $sql = "SELECT * FROM $course WHERE checkindate='$seldate' ORDER BY id DESC";
      $result = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($result, $sql)) {
          echo '<p class="error">SQL Error</p>';
      }
      else{
        mysqli_stmt_execute($result);
          $resultl = mysqli_stmt_get_result($result);
        if (mysqli_num_rows($resultl) > 0){
            while ($row = mysqli_fetch_assoc($resultl)){
      ?>
                  <TR>
                  <TD><?php echo $row['id'];?> | <?php echo $row['username'];?></TD>
                  <TD><?php echo $row['serialnumber'];?></TD>
                  <TD><?php echo $row['checkindate'];?></TD>
                  <TD><?php echo $row['timein'];?></TD>
                  <TD><?php echo $row['timeout'];?></TD>
                  </TR>
    <?php
            }   
        }
      }
    ?>
  </tbody>
</table>