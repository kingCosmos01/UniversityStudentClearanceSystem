<?php 

    session_start();
    
    if(!isset($_SESSION['admin'])) {
        header("Location: http://localhost/clearancems/admin/");
    }

    require_once '../../app/Admin.php';
    require_once '../../app/Hod.php';
    require_once '../../hod/Core/Department.php';
 
    if(isset($_POST['add_hod'])) {

        $id = uniqid();
        $fullname = htmlentities($_POST['fullname']);
        $department = htmlentities($_POST['department']);
        $assigned_password = htmlentities($_POST['password']);

        $hodOBJ = new HodModel($id, $fullname, $department, $assigned_password);
       
    }    

    $departmentOBJ = new Department();
    $departments = $departmentOBJ->getAllDepartments();

  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Clearance HODs</title>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/hod.css">
    <link rel="stylesheet" href="./css/forms.css">
</head>
<body>
    <?php include('./includes/navbar.php'); ?>

    <?php include('./includes/cta.php'); ?>

    <div class="sidebar">
        <ul class="content">
            <div class="wrapper">
                <li><a href="index.php">Overview</a></li>
                <li><a href="students.php">Students</a></li>
                <li><a class="active" href="hods.php">HODs</a></li>
                <li><a href="messages.php">Messages</a></li>
                <li><a href="logout.php">Logout</a></li>
            </div>
        </ul>
    </div>
    <?php if(isset($hodOBJ->message)) { ?>
         <div class="success">
            <?php echo $hodOBJ->message; ?>
         </div>
    <?php } ?>
    <?php if(isset($hodOBJ->error)) { ?>
         <div class="danger">
            <?php echo $hodOBJ->error; ?>
         </div>
    <?php } ?>
    <div class="center-container">
        <div class="wrapper">
            <div class="head">
                <h2>AVAILABLE HODs</h2>
                <div class="_dropDown" id="HodDropDown">
                    <span></span>
                    <span></span>
                </div>
                <div class="hod-cta">
                    <button id="addBtn">Add HOD</button>
                </div>
            </div>

            <div class="content" id="hodContent">
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
                            $adminOBJ->getAllHods();                            
                        ?>
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <div class="add-hod-box-overlay" id="overlay"></div>
    <div class="add-hod-box" id="addBox">
        <div class="head">
            <h2>Add HOD</h2>
            <div class="closeBtn" id="closeBtn">&times;</div>
        </div>
        <hr>
        <form action="" method="post">
            <div class="input-group">
                <label>Fullname</label><br>
                <input type="text" name="fullname" placeholder="Enter your fullname" required>
            </div>

            <div class="input-group">
                <label>Department</label><br>
                <select name="department">
                    <?php foreach ($departments as $key => $department) { ?>
                        <option><?php echo $department['name']; ?></option>
                    <?php } ?>
                </select>
            </div>
    
            <div class="input-group">
                <label>Assign Password</label><br>
                <input type="password" name="password" placeholder="Assign Password" required>
            </div>

            <div class="form-cta">
                <button type="submit" name="add_hod">Add HOD</button>
            </div>
        </form>
    </div>


    
    <?php include('./includes/footer.php'); ?>


    <script src="../../student/js/main.js"></script>
    <script src="./js/DropDown.js"></script>
    <script src="./js/dashboard.js"></script>
 
</body>
</html>