<?php 

    session_start();

    if(!isset($_SESSION['hod_cmp']))
    {
        header('Location: http://localhost/clearancems/hod/');
    }


    require_once '../../Core/Database.php';
    require_once '../../Core/Admin.php';

    require_once '../../Core/StudentDetails.php';

    require_once '../../Core/Router.php';
    require_once '../../Core/ClearStudent.php';

    
    $Route = new Router();
    $url = $Route->getUrl();

    $AdminClearanceOBJ = new ClearStudent($url);

    $studentDetailsOBJ = new StudentDetails;
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Hod Dashboard</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/hod.css">
    <link rel="stylesheet" href="../css/studentDetails.css">
</head>
<body>
    <?php include('../includes/navbar.php'); ?>

    <?php include('../includes/cta.php'); ?>

    <?php include('../includes/sidebar.php'); ?>
    

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
                        <h4 class="dep">Department</h4>
                        <h4 class="act">Status/Action</h4>
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
                        <h4 class="act">Status</h4>
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

    <div class="center-container">
        <div class="wrapper">
            <div class="head">
                <h2>ALL STUDENTS WHO HAVE UPLOADED THEIR DOCUMENTS</h2>
                <div class="_dropDown" id="CourseFormDropDown">
                    <span></span>
                    <span></span>
                </div>
            </div>

            <div class="content" id="CourseFormContent">
                <div class="wrapper">
                    <div class="head">
                        <h4 class="id">ID</h4>
                        <h4 class="fullname">Fullname</h4>
                        <h4 class="dep">Department</h4>
                        <h4 class="act">Course</h4>
                    </div>
                    <ul class="data">
                        <?php 
                            $adminOBJ = new Admin();
                            $adminOBJ->getAllStudentsWithCourseForms();                            
                        ?>
                    </ul>
                </div>
            </div>

        </div>
    </div>


    <?php include('../includes/footer.php'); ?>

    <script>
        setTimeout(() => {
            alert("Once you Clear a Student, you will not be able to UNDO the Action. Be sure to Check all their documents and ensure they are correct!");
        }, 2000);
    </script>


    <script src="../../student/js/main.js"></script>
    <script src="../js/DropDown.js"></script>
    <script src="../js/StudentDropDown.js"></script>
    <script src="../js/CourseFormsDropDown.js"></script>
</body>
</html>