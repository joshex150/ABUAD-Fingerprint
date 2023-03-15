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
                        ' . $course . ' ' . ' ' . $Log_date . '
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
            if ($row['timeout'] == "00:00:00") {
                $present = 'NO';
            } else {
                $present = 'YES';
            }
            $output .= '
                              <TR style="text-align:center; border: 1px solid black;"> 
                                  <TD> ' . $row['id'] . '</TD>
                                  <TD> ' . $row['username'] . '</TD>
                                  <TD> ' . $row['serialnumber'] . '</TD>
                                  <TD> ' . $row['timein'] . '</TD>
                                  <TD> ' . $row['timeout'] . '</TD>
                                  <TD>' . $present . '</TD>
                              </TR>';
        }
        $output .= '</table>';
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename='.$course.' '.$Log_date.'.xls');

        echo $output;
        exit();
    } else {
        header("location: UsersLog.php");
        exit();
    }
}

if (isset($_POST["Range_Excel"])) {
    // Define the date range
    $start = $_POST['range_start'];
    $stop = $_POST['range_end'];
    $date_from = $start;
    $date_to = $stop;

    if (empty($_POST['range_start']) || empty($_POST['range_stop'])) {
        header("location: UsersLog.php?empty-inputs");
    }
    // Initialize output
    $output = '';

    // Loop through the date range
    for ($date = $date_from; $date <= $date_to; $date = date('Y-m-d', strtotime($date . ' +1 day'))) {

        // Execute the query
        $sql = "SELECT * FROM $course ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);


        // Generate table if there are results
        if ($result->num_rows > 0) {
            $output .= '<table class="table" style="width:100%; border: 1px solid black;">';
            $output .= '<caption><h1>' . $course . ' ' . $date . '</h1></caption>';
            $output .= '<tr style="text-align:center; border: 1px solid black;">';
            $output .= '<th>ID</th>';
            $output .= '<th>Name</th>';
            $output .= '<th>Matric Number</th>';
            $output .= '<th>Time In</th>';
            $output .= '<th>Time Out</th>';
            $output .= '<th>Present</th>';
            $output .= '</tr>';

            while ($row = $result->fetch_assoc()) {
                if ($row['checkindate'] == $date) {
                    $present = ($row['timeout'] == "00:00:00") ? 'NO' : 'YES';
                    $output .= '<tr style="text-align:center; border: 1px solid black;">';
                    $output .= '<td>' . $row['id'] . '</td>';
                    $output .= '<td>' . $row['username'] . '</td>';
                    $output .= '<td>' . $row['serialnumber'] . '</td>';
                    $output .= '<td>' . $row['timein'] . '</td>';
                    $output .= '<td>' . $row['timeout'] . '</td>';
                    $output .= '<td>' . $present . '</td>';
                    $output .= '</tr>';
                }
            }

            $output .= '</table><br><br>';
        }
    }

    // Output the results
    if (!empty($output)) {
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename='.$course.' '.$start.'-'.$stop.'.xls');
        echo $output;
        exit();
    } else {
        header("location: UsersLog.php");
        exit();
    }
}

?>