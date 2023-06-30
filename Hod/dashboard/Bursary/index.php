<?php 

    session_start();

    if(!isset($_SESSION['hod_bursary']))
    {
        header('Location: http://localhost/clearancems/hod/');
    }


    require_once '../../Core/Database.php';
    require_once '../../Core/Admin.php';
    require_once '../../Core/ResidencePrepareStudents.php';
    require_once '../../Core/ResidenceClearStudent.php';

    require_once '../../Core/Router.php';

    
    $Route = new Router();
    $url = $Route->getUrl();

    $residenceOBJ = new ResidenceClearStudent($url);

    $residencePrepareStudentsOBJ = new ResidencePrepareStudents();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Residence Dashboard</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/hod.css">
    <link rel="stylesheet" href="../css/studentDetails.css">
</head>
<body>

    <div class="nabvar">
        <div class="wrapper">
            <div class="left">
                <h4>Bursary Dashboard</h4>
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
                <li><a class="active" href="index.php">Overview</a></li>
                <li><a href="messages.php">Messages</a></li>
                <li><a href="?url=logout">Logout</a></li>
            </div>
        </ul>
    </div>

    

    <div class="center-container students">
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
                        <h4 class="dep">Residence</h4>
                        <h4 class="act">Status/Action</h4>
                    </div>
                    <ul class="data">
                        <?php 
                            $adminOBJ = new Admin();
                            $adminOBJ->ResidenceGetAllStudentsPreapredForClearance();
                            
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
                        <h4 class="act">Status</h4>
                    </div>
                    <ul class="data">
                        <?php 
                            $adminOBJ = new Admin();
                            $adminOBJ->ResidenceGetAllStudentsCleared();                            
                        ?>
                    </ul>
                </div>
            </div>

        </div>
    </div>

   

    <?php include('../includes/footer.php'); ?>



    <script src="../../student/js/main.js"></script>
    <script src="../js/DropDown.js"></script>
    <script src="../js/StudentDropDown.js"></script>
    <script src="../js/CourseFormsDropDown.js"></script>
</body>
</html>