<?php 

    session_start();

    if(!isset($_SESSION['admin'])) {
        header("Location: http://localhost/clearancems/admin/");
    }

    require_once '../../app/Admin.php';


    require_once '../../app/Route.php';
    require_once '../../app/ClearStudent.php';
    
    $Route = new Route();
    $url = $Route->getUrl();

    $AdminClearanceOBJ = new ClearStudent($url);

    if(isset($_POST['add_department']))
    {
        $id = $_POST['hidden_id'];
        $department = htmlentities($_POST['addedDepartment']);

        $addDepartmentOBJ = new Admin();
        $addDepartmentOBJ->addDepartment($id, $department);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/hod.css">
</head>
<body>
    <?php include('./includes/navbar.php'); ?>

    <?php include('./includes/cta.php'); ?>

    <?php include('./includes/sidebar.php'); ?>

    <div class="add-department-box-overlay" id="addDepartmentOverlay"></div>
    <div class="add-department-box" id="addDepartmentBox">
        <div class="head">
            <h2>Add Department</h2>
            <div class="closeBtn" id="closeDepartmentBoxBtn">&times;</div>
        </div>

        <form action="" method="post">
            <?php $id = uniqid(); ?>
            <input type="hidden" name="hidden_id" value="<?php echo $id; ?>">
            <div class="input-group">
                <label>Department</label><br>
                <input type="text" name="addedDepartment" placeholder="Enter a Department" required/>
            </div>

            <div class="form-cta">
                <button type="submit" name="add_department">Add Department</button>
            </div>
        </form>
    </div>
    

    <div class="center-container">
        <div class="wrapper">
            <div class="head">
                <h2>AVAILABLE DEPARTMENTS</h2>
                <div class="_dropDown" id="DepartmentsDropDown">
                    <span></span>
                    <span></span>
                </div>
                <div class="hod-cta">
                    <button id="addDepartmentBtn">Add Department</button>
                </div>
            </div>

            <div class="content" id="DepartmentsContent">
                <div class="wrapper">
                    <div class="head">
                        <h4 class="id">ID</h4>
                        <h4 class="dep">Department</h4>
                        <h4 class="act">Action</h4>
                    </div>
                    <ul class="data">
                        <?php 
                            $adminOBJ = new Admin();
                            $adminOBJ->getAllDepartments();                            
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="center-container">
        <div class="wrapper">
            <div class="head">
                <h2>AVAILABLE HODs</h2>
                <div class="hod-cta">
                    <button id="addBtn">Add HOD</button>
                </div>
                <div class="_dropDown" id="HodDropDown">
                    <span></span>
                    <span></span>
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



    <script src="../../student/js/main.js"></script>
    <script src="./js/DropDown.js"></script>
    <script src="./js/StudentDropDown.js"></script>
</body>
</html>