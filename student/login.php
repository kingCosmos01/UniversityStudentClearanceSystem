<?php 

    session_start();

    require_once '../app/Database.php';
    require_once '../app/StudentLogin.php';

    require_once '../hod/Core/Department.php';


    if(isset($_SESSION['student'])) {
        header("Location: http://localhost/clearancems/student/");
    }

    if(isset($_SESSION['admin'])) {
        header("Location: http://localhost/clearancems/admin/dashboard/");
    }

    if(isset($_POST['login_admin'])) {

        $matric_no = htmlentities($_POST['matric_no']);
        $student_department = htmlentities($_POST['department']);
        $password = htmlentities($_POST['password']);

        $adminLoginOBJ = new StudentLogin($matric_no, $student_department, $password);
    }

    $department = new Department;
    $departments = $department->getAllDepartments();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <link rel="stylesheet" href="../student/css/form.css">
</head>
<body>
    <div class="clearance-form">
        <div class="head">
            <a href="http://localhost/clearancems/" class="back-btn"> &LeftArrow; Back to Home</a>
            <h2>Student Login</h2>
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
                <label>Matriculation Number</label><br>
                <input type="text" name="matric_no" placeholder="BSU/SC/CMP/19/54271" required>
            </div>

            <div class="input-group">
                <label>Department</label><br>
                <select name="department" erquired>
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
                <button type="submit" name="login_admin">Login to Dashboard</button>
                <p>Send your Data for Clearance? <a href="../form.php">Sign Up </a></p>
            </div>
        </form>
    </div>

    <script src="./dashboard/js/Alert.js"></script>
</body>
</html>