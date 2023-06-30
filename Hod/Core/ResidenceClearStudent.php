<?php

    class ResidenceClearStudent extends Database {

        protected $url;

        public function __construct($url) {


            $this->url = $url;
            
            if(isset($this->url)){
                
                if($this->ResidenceGetAndClearStudent($this->url[0]) == true)
                {
                    $message = "Student Cleared!";
                    header("Location: http://localhost/clearancems/hod/dashboard/residence/?success=" . urlencode($message));
                }
            }
            
        }





        //clear

        public function ResidenceGetAndClearStudent($id)
        {
            $studentData = $this->getStudent($id);

            $student_id = $studentData[0]['id'];
            $student_fullname = $studentData[0]['fullname'];
            $student_department = $studentData[0]['department'];
            $student_course = $studentData[0]['course'];
            $student_residence = $studentData[0]['residence'];

            if($this->ResidenceSetStudentCleared($student_id, $student_fullname, $student_department, $student_course, $student_residence, 'Cleared') == true)
            {
                $message = "Student Cleared!";
                echo "<div class='success' id='alertSuccess'>$message</div>";
            }
            return true;
        }


        private function ResidenceSetStudentCleared($id, $name, $department, 
        $course, $residence, $status)
        {
            $result;
            // insert student record into residence cleared students
            $isResidenceSetStudentRecord = $this->ResidenceSetStudentRecord($id, $name, $department, 
            $course, $residence, $status);

            if($isResidenceSetStudentRecord == true)
            {
                $result = true;

                // delete student's record from residence availble for clearance
                $isResidenceDeleteStudent = $this->ResidenceDeleteStudent($id);
                if($isResidenceDeleteStudent == true)
                {
                    $result = true;
                }
                else
                {
                    $result = false;
                }
            }
            else
            {
                $result = false;
            }
           
            return $result;
            
        }
        
        

        // Clear functionality
        private function ResidenceDeleteStudent($id)
        {
            $query = "DELETE FROM residence_prepared WHERE student_id = ? ";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute(array($id));

            return true;
        }

        private function ResidenceSetStudentRecord($id, $name, $department, $course, $residence, $status)
        {
            $query = "INSERT INTO residence_cleared_students
            (student_id, student_name, department, course, residence, status)
            VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute(array(
                $id, 
                $name, 
                $department,
                $course,
                $residence,
                $status
            ));
            $stmt = null;
            return true;
        }





        protected function getStudent($id)
        {
            $query = "SELECT * FROM students WHERE id = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute(array($id));

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


    }