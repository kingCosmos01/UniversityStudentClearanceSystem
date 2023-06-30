<?php 

    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Clearance Messages</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>

    <div class="nabvar">
        <div class="wrapper">
            <div class="left">
                <h4>Residence Dashboard</h4>
            </div>
            <div class="right">
                <p class="dropDown" id="dropDown">
                <?php

                        if(isset($_SESSION['hod']))
                        {
                            echo "<b>" . "Hi, " . $_SESSION['hod'] . "</b>";
                        }

                ?>

                    <span></span>
                    <span></span>
                </p>
            </div>
        </div>
    </div>


    <?php include('../includes/cta.php'); ?>

    <div class="sidebar">
        <ul class="content">
            <div class="wrapper">
                <li><a href="index.php">Overview</a></li>
                <li><a class="active" href="messages.php">Messages</a></li>
                <li><a href="?url=logout">Logout</a></li>
            </div>
        </ul>
    </div>







    <script src="../../student/js/main.js"></script>
</body>
</html>