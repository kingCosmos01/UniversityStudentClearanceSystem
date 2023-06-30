<?php 

    session_start();
    
    require '../app/Database.php';
    require '../app/StudentModel.php';
    require '../app/StudentClearance.php';

    if(!isset($_SESSION['student'])) {
        header("Location: http://localhost/clearancems/student/login.php");
    }

    $studentModelOBJ = new StudentModel();
    $studentModelOBJ->getResidenceClearanceStatus();
    $studentModelOBJ->getLibraryClearanceStatus();

    $studentId = $_SESSION['id'];
    $studentDepartment = $_SESSION['department'];

    $StudentClearanceOBJ = new StudentClearance($studentId, $studentDepartment);

    $departmentalClearanceStatus = $StudentClearanceOBJ->GetDepartmentalClearanceStatus();
    $residenceClearanceStatus = $StudentClearanceOBJ->GetResidenceClearanceStatus();

    print_r($departmentalClearanceStatus);
    print_r($residenceClearanceStatus);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Dashboard</title>
    <link rel="stylesheet" href="./css/main.css">
</head>
<body>
    <?php include('./includes/navbar.php'); ?>

    <?php include('./includes/cta.php'); ?>

    <?php include('./includes/sidebar.php'); ?>

    <div class="clearance-overview">
        <div class="head">
            <h2>Clearance Overview</h2>
            <div class="dropDown" id="dropDown">
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="details">
            <div class="detailBox">
                <span>DEPARTMENT</span>
                <div class="status" id="depStatus">
                    <?php if($departmentalClearanceStatus != null) { ?>
                        <div class="status success">
                        &check;<?php echo ucwords($departmentalClearanceStatus[0]['clearance_status']); ?>
                        </div>
                    <?php }else { ?>
                        <div class="status not-cleared">Awaiting Clearance</div>
                    <?php } ?>
                </div>
            </div>

            <div class="detailBox">
                <span>Security</span>
                <div class="status" id="ictStatus">
                    <small><?php echo $_SESSION['clearance']; ?></small>
                </div>
            </div>
            <div class="detailBox">
                <span>Residence</span>
                <div class="status" id="ictStatus">
                    <?php if($residenceClearanceStatus != null) { ?>
                        <div class="status success">
                            &check;<?php echo ucwords($residenceClearanceStatus[0]['status']); ?>
                        </div>
                    <?php }else { ?>
                        <div class="status not-cleared">Awaiting Clearance</div>
                    <?php } ?>
                </div>
            </div>
            <div class="detailBox">
                <span>Library</span>
                <div class="status" id="ictStatus">
                    <small><?php echo $_SESSION['clearance']; ?></small>
                </div>
            </div>
            <div class="detailBox">
                <span>Ict</span>
                <div class="status" id="ictStatus">
                    <small><?php echo $_SESSION['clearance']; ?></small>
                </div>
            </div>
            <div class="detailBox">
                <span>Bursary</span>
                <div class="status" id="ictStatus">
                    <small><?php echo $_SESSION['clearance']; ?></small>
                </div>
            </div>
        </div>
    </div>





    <script src="./js/main.js"></script>
</body>
</html>