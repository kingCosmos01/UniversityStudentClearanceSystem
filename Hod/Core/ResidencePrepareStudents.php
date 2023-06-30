<?php


    class ResidencePrepareStudents extends Database {

        public function __construct()
        {
            $studentData = $this->ResidenceGetStudentsPrepared();

            if($studentData != null)
            {
                $student_id = $studentData[0]['id'];
                $student_fullname = $studentData[0]['fullname'];
                $student_department = $studentData[0]['department'];
                $student_course = $studentData[0]['course'];
                $student_residence = $studentData[0]['residence'];

                $this->ResidenceGetStudentsReady($student_id, $student_fullname, $student_department, $student_course, $student_residence, 'Ready');

            }
            else
            {
                echo "Nothing Found!";
            }
           
        }


        
        private function ResidenceGetStudentsReady($id, $name, $department, $course, $residence, $status)
        {
            $query = "INSERT INTO residence_prepared (student_id, student_name, department, course, residence, status) 
            VALUES(?, ?, ?, ?, ?, ?)";

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

        protected function ResidenceGetStudentsPrepared()
        {
            $query = "SELECT * FROM students WHERE residence = ?";
            $stmt = $this->connect()->prepare($query);

            $residence = 'On Campus';

            $stmt->execute(array($residence));
            $rows = $stmt->rowCount();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);  
        }


    }