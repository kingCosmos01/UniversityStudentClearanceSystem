<?php 

    session_start();

    require_once './app/Admin.php';
    require_once './app/Database.php';

    if(isset($_SESSION['student'])) {
        header("Location: http://localhost/clearancems/student/");
    }
    if(isset($_SESSION['admin']))
    {
        header("Location: http://localhost/clearancems/admin/dashboard/");
    }

    
	if(isset($_POST['register_student'])) {
		echo $_POST['register_student'];
		$studentName = htmlentities($_POST['fullname']);
		$matricNo = htmlentities($_POST['matricNo']);
		$department = htmlentities($_POST['department']);
		$course_of_study = htmlentities($_POST['course']);
		$student_residence = htmlentities($_POST['residence']);
		$password = htmlentities($_POST['password']);
		$c_pass = htmlentities($_POST['c_pass']);

		$default_clearance_status = "Not Cleared";

		require_once './app/Register.php';

		$registerOBJ = new Register($matricNo, $studentName, $department, $course_of_study, $student_residence, $password, $c_pass, $default_clearance_status);

	}

    $departmentCoreOBJ = new Admin();
    $departments = $departmentCoreOBJ->AvailableDepartments();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Clearance Form</title>
    <link rel="stylesheet" href="./student/css/form.css">
</head>
<body>
    <div class="clearance-form">
        <div class="head">
            <h2>Student Clearance Form</h2>
        </div>
        <hr>
            <!-- ERROR AND SUCCESS HANDLERS -->
        <form action="" method="post">
            <div class="input-group">
                <label>Fullname</label><br>
                <input type="text" name="fullname" placeholder="Enter your fullname" required>
            </div>
            <div class="input-group">
                <label>Matriculation Number</label><br>
                <input type="text" name="matricNo" placeholder="Enter your Matriculation Number" required>
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
                <label>Course of Study</label><br>
                <select name="course" id="">
                    <option>Computer Science</option>
                    <option>Mathematics</option>
                    <option>Statistics</option>
                    <option>ICH</option>
                    <option>BioChemistry</option>
                    <option>Anatomy</option>
                </select>
            </div>
            <div class="input-group">
                <label>Residence</label><br>
                <select name="residence" id="">
                    <option>On Campus</option>
                    <option>Off Campus</option>
                </select>
            </div>
            <div class="input-group">
                <label>Password</label><br>
                <input type="password" name="password" placeholder="Choose your Password" required>
            </div>
            <div class="input-group">
                <label>Confirm Password</label><br>
                <input type="password" name="c_pass" placeholder="Confirm your Password" required>
            </div>
            <div class="form-cta">
                <button type="submit" name="register_student">Send Records for Clearance</button>
                <p>Already Sent your Records? <a href="./student/login.php">Login Here </a>  Instead </p>
            </div>
        </form>
    </div>
</body>
</html>

