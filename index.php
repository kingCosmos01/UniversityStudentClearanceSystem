<?php 

    session_start();

    if(isset($_SESSION['student'])) {
        header("Location: http://localhost/clearancems/student/");
    }



    if(isset($_SESSION['admin'])) {
        header("Location: http://localhost/clearancems/admin/dashboard/");
    }
    if(isset($_SESSION['hod_cmp']))
    {
        header("Location: http://localhost/clearancems/hod/dashboard/cmp/");
    }

    if(isset($_SESSION['hod_physics']))
    {
        header("Location: http://localhost/clearancems/hod/dashboard/physics/");
    }

    if(isset($_SESSION['hod_biology']))
    {
        header("Location: http://localhost/clearancems/hod/dashboard/biology/");
    }

    if(isset($_SESSION['hod_chemistry']))
    {
        header("Location: http://localhost/clearancems/hod/dashboard/chemistry/");
    }
    
    if(isset($_SESSION['hod_ict']))
    {
        header("Location: http://localhost/clearancems/hod/dashboard/ict/");
    }
    
    if(isset($_SESSION['hod_bursary']))
    {
        header("Location: http://localhost/clearancems/hod/dashboard/bursary/");
    }
    
    if(isset($_SESSION['hod_security']))
    {
        header("Location: http://localhost/clearancems/hod/dashboard/security/");
    }
    
    if(isset($_SESSION['hod_residence']))
    {
        header("Location: http://localhost/clearancems/hod/dashboard/residence/");
    }




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BSU Student Clearance System</title>
    <link rel="stylesheet" href="public/css/main.css">
</head>
<body>
    <div class="clearance-container">
        <div class="overlay"></div>
        <img src="./images/1.jpg" alt="">
        <ul class="navigations">
            <li><a href="./student">Student</a></li>
            <li><a href="./hod">Head of Department</a></li>
            <li><a href="./admin">School Admin</a></li>
            <li><a href="./about">About</a></li>
        </ul>
        <div class="head">
            <h2>BENUE STATE UNIVERSITY STUDENT CLEARANCE SYSTEM</h2>
        </div>
        <div class="footer">
            <p>&copy; Copyrights PointblancDev <?php echo date('Y'); ?> </p>
        </div>
    </div>
</body>
</html>