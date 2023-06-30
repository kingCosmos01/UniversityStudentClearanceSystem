<?php 

    session_start();

    require_once '../app/Database.php';
    require_once '../app/StudentDocs.php';

    if(isset($_POST['upload_course_forms'])) 
    {
        $course_forms = $_FILES['course_forms'];
        $user_id = $_SESSION['id'];
        $courseFormDocument = new StudentDocs($course_forms, 'course_form', $user_id);   
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Clearance</title>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="../admin/dashboard/css/hod.css">
</head>
<body>
    <?php include('./includes/navbar.php'); ?>

    <?php include('./includes/cta.php'); ?>

    <div class="sidebar">
        <ul class="content">
            <div class="wrapper">
                <li><a href="index.php">Overview</a></li>
                <li><a class="active" href="documents.php">Documents</a></li>
                <li><a href="messages.php">Messages</a></li>
                <li><a href="logout.php">Logout</a></li>
            </div>
        </ul>
    </div>

    <div class="spinner" id="spinner">
        <div class="spin">Uploading...</div>
    </div>
    <div class="doneModal" id="doneModal">
        
    </div>

    <div class="center-container">
        <div class="wrapper">
            <div class="head">
                <h2>UPLOAD ALL YOUR FORMS AND RECEIPTS</h2>
                <div class="hod-cta">
                    <button id="UploadDropDown" style="font-weight:bold;font-size:20px;padding:5px;width:40px">&plus;</button>
                </div>
            </div>

            <div class="content" id="UploadContent">
                <div class="form-box">
                    <div class="form-item">
                        <form action="" enctype="multipart/form-data" method="post">
                            <div class="input-group">
                                <label>UPLOAD ALL 8 COURSE FORMS <span>*</span> </label><br>
                                <input type="file" name="course_forms[]" multiple="multiple" required>
                            </div>
                            <div class="cta">
                                <button type="submit" id="uploadCourseFormBtn" name="upload_course_forms">&plus; UPLOAD COURSE FORMS</button>
                            </div>
                        </form>
                    </div>
                    
                    <div class="form-item">
                        <form action="" enctype="multipart/form-data" method="post">
                            <div class="input-group">
                                <label>UPLOAD ALL 4 DEPARTMENTAL DUES RECEIPTS <span>*</span></label><br>
                                <input type="file" name="receipts[]" multiple="multiple" required>
                            </div>
                            <div class="cta">
                                <button type="submit" name="upload_receipt">&plus; UPLOAD RECEIPTS</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>

        </div>
    </div>


    <script src="./js/main.js"></script>
    <script src="./js/Documents.js"></script>
</body>
</html>