<?php   


    class StudentDetails extends Database  {

        private $studentId;
        private $studentName;
        private $studentCourse;
        private $studentClearanceStatus;
        private $courseForms = [];
        private $courseFormId;

        protected $totalCourseForms;
        protected $totalReceipts;

        protected $studentDepartment;



        public function __construct()
        {
            $requestData = $this->getActionRequest();

            if($requestData != null)
            {
                $studentData = $this->getStudent($requestData[0]);

                // All course forms uploaded by this student
                $this->courseForms = $this->getStudentCourseForms($requestData[0]);

                // A few of the student's Data
                $this->studentId = $studentData['id'];
                $this->studentName = $studentData['fullname'];
                $this->studentCourse = $studentData['course'];
                $this->studentDepartment = $studentData['department'];
                $this->studentClearanceStatus = $studentData['cleared'];


            }
            else 
            {
                echo "No Request Data";
            }
            
        }



        private function getActionRequest()
        {
            if(isset($_GET['param']) && isset($_GET['req']) )
            {
                $id = $_GET['param'];
                $action = $_GET['req'];

                $this->getView();

                return $requestData = [$id, $action];
            }
            else 
            {
                return;
            }
        }

        public function getStudent($id)
        {
            $query = "SELECT * FROM students WHERE id = ? ";
            $stmt = $this->connect()->prepare($query);

            $stmt->execute(array($id));

            $studentData = $stmt->fetch(PDO::FETCH_ASSOC);
            return $studentData;
        }


        public function getStudentCourseForms($id)
        {
            $query = "SELECT form FROM course_forms WHERE student_id = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute(array($id));

            $courseForms = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $courseForms;
        }


        private function getView()
        {
            return require_once '../includes/StudentDetails.php';
        }


        public function returnStudentData()
        {
            return $studentData = [
                $this->studentId,
                $this->studentName,
                $this->studentCourse,
                $this->studentDepartment,
                $this->studentClearanceStatus
            ];   
        }

        public function returnAllCourseForms()
        {
            return $this->courseForms;
        }

        
        public function VerifyDocuments($studentId, $studentName, $studentDepartment, $studentCourse, $status)
        {
            if($this->CheckTotalCourseFormsSubmitedByStudent($studentId) == true )
            {
                $query = "INSERT INTO ready_for_clearance 
                (student_id, student_name, department, course, status)
                VALUES (?, ?, ?, ?, ?) ";

                $stmt = $this->connect()->prepare($query);
                $stmt->execute(array($studentId, $studentName, $studentDepartment, $studentCourse, $status));

                $stmt = null;
                return true;
            }
            else
            {
                return false;
            }
        }


        protected function CheckTotalCourseFormsSubmitedByStudent($student_id)
        {
            $query = "SELECT * FROM course_forms WHERE student_id = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute(array($student_id));

            $data = $stmt->rowCount();

            $MAX_COURSE_FORMS = 8;

            if($data >= $MAX_COURSE_FORMS )
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function getRemainingCourseForms($student_id)
        {
            $query = "SELECT * FROM course_forms WHERE student_id = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute(array($student_id));

            $data = $stmt->rowCount();
            echo $data;

            $MAX_COURSE_FORMS = 8;

            $remainingCourseForms = ( $MAX_COURSE_FORMS - $data);
            return $remainingCourseForms;
        }



        protected function CheckTotalReceiptsSubmitedByStudent($student_id)
        {

        }

        
        public function CheckDepartmentalClearanceStatus($student_id, $studentDepartment)
        {
            $query = "SELECT clearance_status FROM cleared_students WHERE student_id = ? AND department = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute(array(
                $student_id,
                $studentDepartment
            ));

            $status = $stmt->fetch(PDO::FETCH_ASSOC);
            return $status;
        }









    }