<tbody>
            <?php
            //Connect to database
            require 'connectDB.php';

            $sql = "SELECT * FROM users WHERE NOT username='' ORDER BY id DESC";
            $result = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($result, $sql)) {
              echo '<p class="error">SQL Error</p>';
            } else {
              mysqli_stmt_execute($result);
              $resultl = mysqli_stmt_get_result($result);
              if (mysqli_num_rows($resultl) > 0) {
                while ($row = mysqli_fetch_assoc($resultl)) {
                  ?>
                  <TR>
                  <TD>
                      <?php echo $row['id'];?>
                    </TD>
                    <TD>
                      <?php echo $row['username']; ?>
                    </TD>
                    <TD>
                      <?php echo $row['serialnumber']; ?>
                    </TD>
                    <TD>
                      <?php echo $row['gender']; ?>
                    </TD>
                    <TD>
                      <?php echo $row['fingerprint_id']; ?>
                    </TD>
                    <TD>
                      <?php echo $row['user_date']; ?>
                    </TD>
                  </TR>
                  <?php
                }
              }
            }
            ?>
          </tbody>