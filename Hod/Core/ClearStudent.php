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

            if($this->setStudentCleared($student_id, $student_fullname, $student_department, 
            $student_course, $student_residence) == true)
            {                
                header("Location: http://localhost/clearancems/hod/dashboard/cmp/");
                echo "<div class='success' id='success'>Student Cleared!</div>";
            }
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
            $res = $stmt->execute(array($student_id, $student_fullname, $student_department, $student_course, $student_residence, 'cleared'));
            
            if($res)
            {
                $this->deleteUser($student_id);
                return true; 
            }
            else
            {
                return false;
            }
            
           

        }

        private function deleteUser($id)
        {
            $query = "DELETE FROM ready_for_clearance WHERE student_id = ? ";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute(array($id));

            return true;
        }


        protected function getStudent($id)
        {
            $query = "SELECT * FROM students WHERE id = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute(array($id));

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }





        // Residence Clear Student Starts Here
        public function ResidenceGetAndClearStudent($id)
        {
            $studentData = $this->getStudent($id);

            $student_id = $studentData[0]['id'];
            $student_fullname = $studentData[0]['fullname'];
            $student_department = $studentData[0]['department'];
            $student_course = $studentData[0]['course'];
            $student_residence = $studentData[0]['residence'];



        }


        private function ResidenceSetStudentCleared()
        {
            $result;
            // insert student record into residence cleared students
            $isResidenceSetStudentRecord = $this->ResidenceSetStudentRecord($id, $name, $department, $course, $residence, $status);
            if($isResidenceSetStudentRecord == true)
            {
                $result = true;

                // delete student's record from residence availble for clearance
                $isResidenceDeleteStudent = $this->ResidenceDeleteStudent($id);
                if($isResidenceDeleteStudent == true)
                {
                    $result = true;
                }
            }
           
            
        }

        private function ResidenceDeleteStudent($id)
        {
            $query = "DELETE FROM residence WHERE student_id = ? ";
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

            return true;
        }


    }