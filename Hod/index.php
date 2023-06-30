<?php 
    session_start();

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


    require './Core/Database.php';
    require './Core/Department.php';
    require './Core/HodLogin.php';

    $department = new Department;
    $departments = $department->getAllDepartments();


    if(isset($_POST['login_hod']))
    {
        $fullname = htmlentities($_POST['fullname']);
        $department = htmlentities($_POST['department']);
        $password = htmlentities($_POST['password']);

        $HodLoginOBJ = new HodLogin($fullname, $department, $password);
    }
   
   

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOD Login</title>
    <link rel="stylesheet" href="../student/css/form.css">
</head>
<body>
    <div class="clearance-form">
        <div class="head">
            <h2>Head of Department - Login</h2>
        </div>
        <hr>
        <?php 
            if(isset($_GET['param']) && isset($_GET['message']))
            {
                $param = $_GET['param'];

                $message = $_GET['message'];


                if($param === 'success')
                {
                    echo "<div class='alert success' id='alertSuccess'>$message</div>";
                }
                else 
                {
                    echo "<div class='alert danger' id='alertDanger'>$message</div>";
                }
            }
        ?>
        <form action="" method="post">
            <div class="input-group">
                <label>Fullname</label><br>
                <input type="text" name="fullname" placeholder="Enter your fullname" required>
            </div>
        
            <div class="input-group">
                <label>Department</label><br>
                <select name="department" id="">
                <?php 
                    foreach ($departments as $key => $department) {
                        echo "<option>" . $department['name'] . "</option>";
                    }
                ?>
                </select>
            </div>
    
            <div class="input-group">
                <label>Password</label><br>
                <input type="password" name="password" placeholder="Enter your Password" required>
            </div>

            <div class="form-cta">
                <button type="submit" name="login_hod">Login to Dashboard</button>
                <p>Want to Reset your Password? <a href="?url=password_reset">Reset Here </a></p>
            </div>
        </form>
    </div>

    <script src="./dashboard/js/Alert.js"></script>
</body>
</html>