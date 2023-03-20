<table cellpadding="0" cellspacing="0" border="0">
<tbody>
<?php
  //Connect to database
  require'connectDB.php';

    $sql = "SELECT * FROM users WHERE del_fingerid=0 ORDER BY id DESC";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
        echo '<p class="error">SQL Error</p>';
    }
    else{
      mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
      if (mysqli_num_rows($resultl) > 0){
          while ($row = mysqli_fetch_assoc($resultl)){
            if($row['add_fingerid'] == 1 && $row['fingerprint_select'] == 1){
                echo "<script>$(document).ready(function() {
                  function hidAlert() {
                    $('#alert').show(); $('#alert').text('This prompt will close when a Fingerprint is added');
                  }
                  hidAlert(); // hide alert every 10 seconds
                });</script>";
            }
  ?>
              <div>
              <TR>
              	<TD><?php  
                		if ($row['fingerprint_select'] == 1) {
                			echo "<img style='padding-right: 2.9px; width:14.5px; padding-top:2.5px;' src='/images/checkmark.png' title='The selected UID'>";
                		}
                    $fingerid = $row['fingerprint_id'];
                	?>
                	<form>
                		<button type="button" class="select_btn" id="<?php echo $fingerid;?>" title="select this UID"><?php echo $fingerid;?></button>
                	</form>
                </TD>
                <TD><?php echo $row['username'];?></TD>
                <TD><?php echo $row['gender'];?></TD>
                <TD><?php echo $row['serialnumber'];?></TD>
                <TD><?php echo $row['user_date'];?></TD>
                <!-- <TD><?php echo $row['time_in'];?></TD> -->
              </TR>
              </div>
<?php
      }   
    }
  }
?>
</tbody>
</table>