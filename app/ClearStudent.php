<?php

    class ClearStudent extends Database {

        protected $url;

        public function __construct($url) {


            $this->url = $url;
            
            if(isset($this->url)){
                $this->getAndClearStudent($this->url[0]);
            }
  
        }
        

     

        private function getAndClearStudent($id)
        {
            $studentData = $this->getStudent($id);
            // var_dump($studentData);
            $student_id = $studentData[0]['id'];
            $student_fullname = $studentData[0]['fullname'];
            $student_department = $studentData[0]['department'];
            $student_course = $studentData[0]['course'];
            $student_residence = $studentData[0]['residence'];

            $this->setStudentCleared($student_id, $student_fullname, $student_department, 
            $student_course, $student_residence);
        }


        private function setStudentCleared($student_id, $student_fullname, $student_department, 
                        $student_course, $student_residence) 
        {
            $query = "INSERT INTO cleared_students (
                    student_id, 
                    student_fullname,
                    department,
                    course,
                    residence,
                    clearance_status
                    ) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->connect()->prepare($query);
            if($stmt->execute(array(
                $student_id, $student_fullname, $student_department, 
                $student_course, $student_residence, 'cleared'
                )))
            {
                $query = "DELETE FROM students WHERE id = ?";
                $stmt = $this->connect()->prepare($query);
                $response = $stmt->execute(array($student_id));
                if($response)
                {
                    $message = "Student Cleared!";
                    header("location: http://localhost/clearancems/admin/dashboard/?success=". urlencode($message));
                    exit();   
                }
            }
            else 
            {
                $message = "Error Clearing Student!";
                header("location: http://localhost/clearancems/admin/dashboard/?err=". urlencode($message));
                exit();
            }
        }


        protected function getStudent($id)
        {
            $query = "SELECT * FROM students WHERE id = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute(array($id));

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }










    }