<?php
//Connect to database
require 'connectDB.php';
date_default_timezone_set('Africa/Lagos');
$d = date("Y-m-d");
$t = date("H:i:sa");

if (!empty($_GET['FingerID'])) {

    $fingerID = $_GET['FingerID'];

    $sql = "SELECT * FROM users WHERE fingerprint_id=?";
    $result = mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($result, $sql)) {
        echo "SQL_Error_Select_card";
        exit();
    } else {
        mysqli_stmt_bind_param($result, "s", $fingerID);
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
        if ($row = mysqli_fetch_assoc($resultl)) {
            //*****************************************************
            //An existed fingerprint has been detected for Login or Logout
            if ($row['username'] != "Name") {
                $Uname = $row['username'];
                $Number = $row['serialnumber'];
                $Uname = $row['username'];
                $Number = $row['serialnumber'];
                // Define the data to be queried
                $d = date('Y-m-d');

                // Define the SQL query to select data from the TEST101 table
                $sql = "SELECT * FROM TEST101 WHERE fingerprint_id=? AND checkindate=? AND timeout=''";

                // Initialize a prepared statement
                $stmt = mysqli_stmt_init($conn);

                // Prepare the statement with the query
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    // If there's an error, exit the script
                    echo "SQL Error: Statement preparation failed";
                    exit();
                } else {
                    // Bind the input parameters to the statement
                    mysqli_stmt_bind_param($stmt, "ss", $fingerID, $d);

                    // Execute the statement
                    mysqli_stmt_execute($stmt);

                    // Get the result set from the executed statement
                    $resultl = mysqli_stmt_get_result($stmt);
                    //*****************************************************
                    //Login
                    if (!$row = mysqli_fetch_assoc($resultl)) {
                        // Define the data to be inserted
                        $Uname = $Uname;
                        $Number = $Number;
                        $fingerID = $fingerID;
                        $d = date('Y-m-d');
                        $t = date('H:i:s');
                        $timeout = '0';

                        // Define the SQL query to insert data into the TEST101 table
                        $sql = "INSERT INTO TEST101 (username, serialnumber, fingerprint_id, checkindate, timein, timeout) VALUES (?, ?, ?, ?, ?, ?)";

                        // Initialize a prepared statement
                        $stmt = mysqli_stmt_init($conn);

                        // Prepare the statement with the query
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            // If there's an error, exit the script
                            echo "SQL Error: Statement preparation failed";
                            exit();
                        } else {
                            // Bind the input parameters to the statement
                            mysqli_stmt_bind_param($stmt, "ssisss", $Uname, $Number, $fingerID, $d, $t, $timeout);

                            // Execute the statement
                            mysqli_stmt_execute($stmt);

                            // Print a success message and exit the script
                            echo "Successfully logged in as " . $Uname;
                            exit();
                        }
                    } else {
                        $fingerID = $fingerID;
                        $d = date('Y-m-d');
                        $t = date('H:i:s');

                        // Define the SQL query to update data in the TEST101 table
                        $sql = "UPDATE TEST101 SET timeout=? WHERE checkindate=? AND fingerprint_id=? AND timeout='0'";

                        // Initialize a prepared statement
                        $stmt = mysqli_stmt_init($conn);

                        // Prepare the statement with the query
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            // If there's an error, exit the script
                            echo "SQL Error: Statement preparation failed";
                            exit();
                        } else {
                            // Bind the input parameters to the statement
                            mysqli_stmt_bind_param($stmt, "ssi", $t, $d, $fingerID);

                            // Execute the statement
                            mysqli_stmt_execute($stmt);

                            // Print a success message and exit the script
                            echo "Successfully logged out " . $Uname;
                            exit();
                        }
                    }
                }
            }
            else {
                // Define the SQL query to select the user with the fingerprint_select value of 1
                $sql = "SELECT fingerprint_select FROM users WHERE fingerprint_select=1";
                
                // Initialize a prepared statement
                $stmt = mysqli_stmt_init($conn);
                
                // Prepare the statement with the query
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    // If there's an error, exit the script
                    echo "SQL Error: Statement preparation failed";
                    exit();
                } else {
                    // Execute the statement
                    mysqli_stmt_execute($stmt);
                
                    // Get the result set from the executed statement
                    $result = mysqli_stmt_get_result($stmt);
                
                    // Check if there is a row with fingerprint_select value of 1
                    if ($row = mysqli_fetch_assoc($result)) {
                        // If there is, update the users table to set fingerprint_select to 0
                        $sql = "UPDATE users SET fingerprint_select=0";
                
                        // Re-initialize a prepared statement
                        $stmt = mysqli_stmt_init($conn);
                
                        // Prepare the statement with the query
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            // If there's an error, exit the script
                            echo "SQL Error: Statement preparation failed";
                            exit();
                        } else {
                            // Execute the statement to set fingerprint_select to 0
                            mysqli_stmt_execute($stmt);
                
                            // Update the users table to set fingerprint_select to 1 for the current fingerprint_id
                            $sql = "UPDATE users SET fingerprint_select=1 WHERE fingerprint_id=?";
                
                            // Re-initialize a prepared statement
                            $stmt = mysqli_stmt_init($conn);
                
                            // Prepare the statement with the query
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                // If there's an error, exit the script
                                echo "SQL Error: Statement preparation failed";
                                exit();
                            } else {
                                // Bind the input parameter to the statement
                                mysqli_stmt_bind_param($stmt, "i", $fingerID);
                
                                // Execute the statement to set fingerprint_select to 1 for the current fingerprint_id
                                mysqli_stmt_execute($stmt);
                
                                // Echo the "available" message and exit the script
                                echo "available";
                                exit();
                            }
                        }
                    } else {
                        // If there isn't a row with fingerprint_select value of 1, update the users table to set fingerprint_select to 1 for the current fingerprint_id
                        $sql = "UPDATE users SET fingerprint_select=1 WHERE fingerprint_id=?";
                
                        // Re-initialize a prepared statement
                        $stmt = mysqli_stmt_init($conn);
                
                        // Prepare the statement with the query
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            // If there's an error, exit the script
                            echo "SQL Error: Statement preparation failed";
                            exit();
                        } else {
                            // Bind the input parameter to the statement
                            mysqli_stmt_bind_param($stmt, "i", $fingerID);
                
                            // Execute the statement to set fingerprint_select to 1 for the current fingerprint_id
                            mysqli_stmt_execute($stmt);
                
                            // Echo the "available" message and exit the script
                            echo "available";
                            exit();
                        }
                    }
                }
            }
        } 
        //New Fingerprint has been added
        else {
            $Uname = "Name";
            $Number = "000000";
            $Email = " Email";
            $Timein = "00:00:00";
            $Gender = "Gender";
        
            $sql = "UPDATE users SET fingerprint_select=0";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                echo "SQL_Error_insert";
                exit();
            } else {
                $sql = "INSERT INTO users (username, serialnumber, gender, email, fingerprint_id, fingerprint_select, user_date, time_in, add_fingerid) VALUES (?, ?, ?, ?, ?, 1, CURDATE(), ?, 0)";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo "SQL_Error_Select_add";
                    exit();
                } else {
                    mysqli_stmt_bind_param($result, "ssssis", $Uname, $Number, $Gender, $Email, $fingerID, $Timein);
                    mysqli_stmt_execute($result);
        
                    echo "successful1";
                    exit();
                }
            }
        }  
    }
}

if (!empty($_GET['Get_Fingerid'])) {
    
    if ($_GET['Get_Fingerid'] == "get_id") {
        $sql= "SELECT fingerprint_id FROM users WHERE add_fingerid=1";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo "SQL_Error_Select";
            exit();
        }
        else{
            $row = mysqli_fetch_assoc($result);
            if ($row) {
                echo "add-id".$row['fingerprint_id'];
                exit();
            }
            else{
                echo "Nothing";
                exit();
            }
        }
    }
    else{
        exit();
    }
}
if (!empty($_GET['confirm_id'])){
    $fingerid = $_GET['confirm_id'];
    $sql = "UPDATE users SET fingerprint_select=0 WHERE fingerprint_select=1";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo "SQL_Error_Select";
        exit();
    } else {
        $sql = "UPDATE users SET add_fingerid=0, fingerprint_select=1 WHERE fingerprint_id=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "SQL_Error_Select";
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $fingerid);
            mysqli_stmt_execute($stmt);
            echo "Fingerprint has been added!";
            exit();
        }
    }
}
if (!empty($_GET['DeleteID'])) {
    if ($_GET['DeleteID'] == "check") {
        // Define the SQL query to select the fingerprint_id with del_fingerid value of 1
        $sql = "SELECT fingerprint_id FROM users WHERE del_fingerid=1";
        // Initialize a prepared statement
        $stmt = mysqli_stmt_init($conn);
        // Prepare the statement with the query
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            // If there's an error, exit the script
            echo "SQL Error: Statement preparation failed";
            exit();
        } else {
            // Execute the statement
            mysqli_stmt_execute($stmt);
            // Get the result set from the executed statement
            $resultl = mysqli_stmt_get_result($stmt);
            // Check if there is a row with del_fingerid value of 1
            if ($row = mysqli_fetch_assoc($resultl)) {
                // Echo the "del-id" message with the fingerprint_id value and exit the script
                echo "del-id" . $row['fingerprint_id'];
                // Define the SQL query to delete the row with del_fingerid value of 1
                $sql = "DELETE FROM users WHERE del_fingerid=1";
                // Re-initialize a prepared statement
                $stmt = mysqli_stmt_init($conn);
                // Prepare the statement with the query
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    // If there's an error, exit the script
                    echo "SQL Error: Statement preparation failed";
                    exit();
                } else {
                    // Execute the statement to delete the row
                    mysqli_stmt_execute($stmt);
                    // Exit the script
                    exit();
                }
            } else {
                // If there isn't a row with del_fingerid value of 1, echo the "nothing" message and exit the script
                echo "nothing";
                exit();
            }
        }
    } else {
        // If the value of DeleteID is not "check", exit the script
        exit();
    }
}

mysqli_stmt_close($result);
mysqli_close($conn);
?>