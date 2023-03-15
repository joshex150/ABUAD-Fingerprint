<?php include 'cachestart.php';
if (basename($_SERVER["PHP_SELF"]) == "ManageUsers.php") {
    echo '<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Popup</title>
        <link rel="stylesheet" type="text/css" href="css/popup.css?v=3">
    </head>
    
    <body>
        <main>
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <p style="padding-bottom: 60px; text-align: center;">This action cannot be undone, <br> are you sure?
                    </p>
                    <form action="POST">
                    <button id="yes-button" name="user_rmo" class="user_rmo">Yes</button><button id="no-button">No</button>
                    </form>
                </div>
            </div>
        </main>
    </body>
    <script>
        document.getElementById("yes-button").onclick = function () {
            modal.style.display = "none";
        }
        document.getElementById("no-button").onclick = function () {
            modal.style.display = "none";
        }
        // Get the modal
        var modal = document.getElementById("myModal");
    
        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");
    
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
    
        // When the user clicks the button, open the modal 
        btn.onclick = function () {
            modal.style.display = "block";
        }
    
        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            modal.style.display = "none";
        }
    
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        window.onsubmit = function (event) {
            event.preventDefault()
        }
    
        // Close modal when button with id "yes-button" is clicked
        document.getElementById("yes-button").onclick = function () {
            modal.style.display = "none";
        }
    </script>
    
    </html>';
}
if (basename($_SERVER["PHP_SELF"]) == "UsersLog.php") {
    echo '<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Popup</title>
        <link rel="stylesheet" type="text/css" href="css/popup.css?v=3">
    </head>
    
    <body>
        <main>
            <div id="myModal" class="modal">
                <div class="modal-content slideInDown animated">
                    <span class="close">&times;</span>
                    <p style="padding-bottom: 20px; text-align: center;">Select an export type</p>
                    <form method="POST" action="Export_Excel.php">
                    <div class="lector" >
                    <span style="padding-top: 15px;">Date:</span> <input class="excel" type="date" name="date_sel" id="date_sel" placeholder="dd-mm-yyyy">
                    </div>
                    <button id="yes-button" name="To_Excel" class="To_Excel">Export selected date</button><br><br> <div style="text-align: center;">OR</div>
                    <br><br><label>Advance Export select range:</label><br><br>
                    <div class="range"><span>Start:</span> <input type="date" name="range_start" id="range_start" placeholder="dd-mm-yyyy"> <span>Stop:</span> <input type="date" name="range_end" id="range_end" placeholder="dd-mm-yyyy"></div>
                    <button id="no-button" name="Range_Excel" class="Range_Excel">Export selected range</button>
                    </form>
                </div>
                    
            </div>
        </main>
    </body>
    <script>
        document.getElementById("yes-button").onclick = function () {
            modal.style.display = "none";
        }
        document.getElementById("no-button").onclick = function () {
            modal.style.display = "none";
        }
        // Get the modal
        var modal = document.getElementById("myModal");
    
        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");
    
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
    
        // When the user clicks the button, open the modal 
        btn.onclick = function () {
            modal.style.display = "block";
        }
    
        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            modal.style.display = "none";
        }
    
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

    
        // Close modal when button with id "yes-button" is clicked
        document.getElementById("yes-button").onclick = function () {
            modal.style.display = "none";
        }
    </script>
    
    </html>';
}
include 'cacheend.php'; ?>