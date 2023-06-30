<?php 

    session_start();
 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Messages</title>
    <link rel="stylesheet" href="./css/main.css">
</head>
<body>
    <?php include('./includes/navbar.php'); ?>

    <?php include('./includes/cta.php'); ?>

    <div class="sidebar">
        <ul class="content">
            <div class="wrapper">
                <li><a href="index.php">Overview</a></li>
                <li><a href="documents.php">Clearance</a></li>
                <li><a class="active" href="messages.php">Messages</a></li>
                <li><a href="logout.php">Logout</a></li>
            </div>
        </ul>
    </div>







    <script src="./js/main.js"></script>
</body>
</html>