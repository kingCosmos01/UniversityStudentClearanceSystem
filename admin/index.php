<?php 

    session_start();

    include('../app/Database.php');
    include('../app/adminLogin.php');

    if(isset($_SESSION['student'])) {
        header("Location: http://localhost/clearancems/student/");
    }

    if(isset($_SESSION['admin'])) {
        header("Location: http://localhost/clearancems/admin/dashboard/");
    }

    if(isset($_POST['login_admin'])) {

        $fullname = htmlentities($_POST['fullname']);
        $password = htmlentities($_POST['password']);

        $adminLoginOBJ = new AdminLogin($fullname, $password);
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Admin Login</title>
    <link rel="stylesheet" href="../student/css/form.css">
</head>
<body>
    <div class="clearance-form">
        <div class="head">
            <h2>School Admin Login</h2>
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
                <label>Password</label><br>
                <input type="password" name="password" placeholder="Enter your Password" required>
            </div>

            <div class="form-cta">
                <button type="submit" name="login_admin">Login to Dashboard</button>
                <p>Want to Reset your Password? <a href="?url=password_reset">Reset Here </a></p>
            </div>
        </form>
    </div>

    <script src="./dashboard/js/Alert.js"></script>
</body>
</html>