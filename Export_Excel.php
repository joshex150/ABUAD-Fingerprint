<?php
//Connect to database
require 'connectDB.php';

$output = '';

session_start();

$course = $_COOKIE['course'];


if (isset($_POST["To_Excel"])) {

    if (empty($_POST['date_sel'])) {

        $Log_date = date("Y-m-d");
    } else if (!empty($_POST['date_sel'])) {

        $Log_date = $_POST['date_sel'];
    }
    $sql = "SELECT * FROM $course WHERE checkindate='$Log_date' ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $output .= '
                        
                        <table class="table" style="width:100%; border: 1px solid black;" >  
                        <center><h1>
                        '. $course .' '.' '. $Log_date .'
                        </h1></center>
                          <TR style="text-align:center; border: 1px solid black;">
                            <TH>ID</TH>
                            <TH>Name</TH>
                            <TH>Matric Number</TH>
                            <TH>Time In</TH>
                            <TH>Time Out</TH>
                            <TH>Present</TH>
                          </TR>';
        while ($row = $result->fetch_assoc()) {
            if($row['timeout'] == "00:00:00"){
                $present = 'NO';
            }else{
                $present = 'YES';
            }
            $output .= '
                              <TR style="text-align:center; border: 1px solid black;"> 
                                  <TD> ' . $row['id'] . '</TD>
                                  <TD> ' . $row['username'] . '</TD>
                                  <TD> ' . $row['serialnumber'] . '</TD>
                                  <TD> ' . $row['timein'] . '</TD>
                                  <TD> ' . $row['timeout'] . '</TD>
                                  <TD>'. $present .'</TD>
                              </TR>';
        }
        $output .= '</table>';
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=User_Log' . $Log_date . '.xls');

        echo $output;
        exit();
    } else {
        header("location: UsersLog.php");
        exit();
    }
}
?>