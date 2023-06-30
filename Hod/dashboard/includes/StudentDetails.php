<?php 

    $studentDetailsOBJ = new StudentDetails;

    $studentData = $studentDetailsOBJ->returnStudentData();
    $courseForms = $studentDetailsOBJ->returnAllCourseForms();
    
    $departmentalClearanceStatus = $studentDetailsOBJ->CheckDepartmentalClearanceStatus(
        $studentData[0],
        $studentData[3]
    );

    // echo $studentData[0];
    // echo $studentData[3];

    // print_r($departmentalClearanceStatus);

    if(isset($_POST['verifyDocuments']))
    {
        $studentId = $_POST['hidden_id'];
        $studentName = $_POST['hidden_name'];
        $studentCourse = $_POST['hidden_course'];
        $Department = $_POST['department'];
        $status = 'Ready';

        $isDocumentsVerified = $studentDetailsOBJ->VerifyDocuments($studentId, $studentName, $Department, $studentCourse, $status );
        $remainingCourseForms = $studentDetailsOBJ->getRemainingCourseForms($studentId);

        if($isDocumentsVerified == true)
        {
            $message = "Documents Verified!";
        }
        else
        {
            $error = "Error: There are " . $remainingCourseForms . " Missing Documents (Course Forms)";
        }
    }


?>

<div class="addMessageBoxOverlay" id="addMessageBoxOverlay"></div>
<div class="addMessageBox" id="addMessageBox">
    <div class="head">
        <h2>Add Exception</h2>
        <div class="closeBtn" id="closeExceptionModalBtn">&times;</div>
    </div>
    <form action="" method="post">
        <input type="hidden" name="student_id" value="<?php $studentData[0]; ?>">
        <input type="text" name="exception" placeholder="Exception Example: Upload 2nd Semester Course Form" requierd/><br>
        <button type="submit" class="addExceptionBtn">Add Exception</button>
    </form>
</div>

<div class="student-details-box">
    <div class="head">
        <a href="http://localhost/clearancems/hod/dashboard/cmp/" class="back-btn"> &LeftArrow; Back</a>
        <section class="student-info">
            <h2><?php echo $studentData[1]; ?></h2>
            <ul class="info">
                <li><?php echo $studentData[0]; ?></li>
                <li><?php echo $studentData[2]; ?></li>                
                   
                
                <?php if($departmentalClearanceStatus != null) { ?>
                    <li class="cleared"><?php echo $departmentalClearanceStatus['clearance_status']; ?></li> 
                <?php } else { ?>
                    <li class="not-cleared"><?php echo $studentData[4]; ?></li> 
                <?php } ?>
                <!-- Check Clearance Status -->
                <!-- Display not cleared if student clearance status is not cleared -->
                <!-- Display 'Cleared if student status is cleared!' -->

            </ul>            
        </section>
        <?php 
        
            if(isset($message))
            {
                echo "<div class='success' id='alertSuccess'>$message</div>";
            }
        
            if(isset($error))
            {
                echo "<div class='error' id='alertError'>$error <div class='closeBtn' id='errCloseBtn'>&times;</div> </div>";
            }

        ?>
        <div class="details-cta">
            <button class="messageBtn" id="addExceptionBtn">&plus; Add Exception</button><br>
            <form action="" method="post">
                <input type="hidden" name="hidden_id" value="<?php echo $studentData[0]; ?>">
                <input type="hidden" name="hidden_name" value="<?php echo $studentData[1]; ?>">
                <input type="hidden" name="hidden_course" value="<?php echo $studentData[2]; ?>">
                <input type="hidden" name="department" value="<?php echo $studentData[3]; ?>">
                
                <?php if($departmentalClearanceStatus != null) { ?>
                    <button class="verifyBtnDisabled">&check; Verify Documents</button>
                <?php }else { ?>
                    <button type="submit" name="verifyDocuments" class="verifyBtn" id="verifyBtn">&check; Verify Documents</button>
                <?php } ?>
            </form>
        </div>
    </div>

    <div class="course-form-content" id="contenBox">
        <div class="title">
            <h2>COURSE FORMS</h2>
            <div class="_dropDown" id="CourseFormDropDown">
                <span></span>
                <span></span>
            </div>

        </div>

        <div class="content" id="CourseFormContent">
        <?php foreach ($courseForms as $key => $courseForm) { ?>
            <div class="course-form">
                <img src="../../<?php echo $courseForm['form']; ?>" alt="">
            </div>
        <?php } ?>
        </div>

        <div class="title">
            <h2>DEPARTMENTAL DUES RECEIPTS</h2>
            <div class="_dropDown" id="">
                <span></span>
                <span></span>
            </div>
        </div>
        
        
    
    </div>
    <div class="details-footer">
        <p>Copyrights &copy; PointblancDev <?php echo date('Y'); ?> </p>
    </div>

</div>


<?php if(isset($error)) { ?>

    <script>
        setTimeout(() => {
            alert("Check All Documents and Ensure they are Complete! You can Add an Exception and Ask the Student to Submit the Missing Document(s)");
        }, 8000);

        const errorModal = document.getElementById('alertError');
        const errCloseBtn = document.getElementById('errCloseBtn');

        errCloseBtn.addEventListener('click', ()=>{ errorModal.style.display = 'none'; });

    </script>

<?php } ?>