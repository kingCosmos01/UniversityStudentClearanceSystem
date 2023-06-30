<?php 

    session_start();
    
    if(!isset($_SESSION['admin'])) {
        header("Location: http://localhost/clearancems/admin/");
    }

    require_once '../../app/Admin.php';
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Clearance</title>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/hod.css">
</head>
<body>
    <?php include('./includes/navbar.php'); ?>

    <?php include('./includes/cta.php'); ?>

    <div class="sidebar">
        <ul class="content">
            <div class="wrapper">
                <li><a href="index.php">Overview</a></li>
                <li><a class="active" href="students.php">Students</a></li>
                <li><a href="hods.php">HODs</a></li>
                <li><a href="messages.php">Messages</a></li>
                <li><a href="logout.php">Logout</a></li>
            </div>
        </ul>
    </div>

    <div class="center-container">
        <div class="wrapper">
            <div class="head">
                <h2>AVAILABLE STUDENTS FOR CLEARANCE</h2>
                <div class="_dropDown" id="StudentDropDown">
                    <span></span>
                    <span></span>
                </div>
            </div>

            <div class="content" id="studentContent">
                <div class="wrapper">
                    <div class="head">
                        <h4 class="id">ID</h4>
                        <h4 class="fullname">Fullname</h4>
                        <h4 class="dep">Department</h4>
                        <h4 class="act">Action</h4>
                    </div>
                    <ul class="data">
                        <?php 
                            $adminOBJ = new Admin();
                            $adminOBJ->getAllStudents();                            
                        ?>
                    </ul>
                </div>
            </div>

        </div>
    </div>


    <div class="center-container">
        <div class="wrapper">
            <div class="head">
                <h2>ALL STUDENTS CLEARED</h2>
                <div class="_dropDown" id="ClearedStudentDropDown">
                    <span></span>
                    <span></span>
                </div>
            </div>

            <div class="content" id="ClearedStudentContent">
                <div class="wrapper">
                    <div class="head">
                        <h4 class="id">ID</h4>
                        <h4 class="fullname">Fullname</h4>
                        <h4 class="dep">Department</h4>
                        <h4 class="act">Action</h4>
                    </div>
                    <ul class="data">
                        <?php 
                            $adminOBJ = new Admin();
                            $adminOBJ->getAllClearedStudents();                            
                        ?>
                    </ul>
                </div>
            </div>

        </div>
    </div>


    
    <?php include('./includes/footer.php'); ?>


    <script src="./js/StudentDropDown.js"></script>
    <script src="../../student/js/main.js"></script>
</body>
</html>