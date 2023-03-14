<?php include 'cachestart.php'; ?>
<html lang="en">

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
                <button id="yes-button" name="user_rmo" class="user_rmo">Yes</button><button id="no-button">No</button>
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

</html>
<?php include 'cacheend.php'; ?>