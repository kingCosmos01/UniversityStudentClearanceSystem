<?php

    require 'Student.php';

    class StudentModel implements Student {

        public function getResidenceClearanceStatus()
        {
            $studentId = $_SESSION['id'];
            echo $studentId;

        }

        public function getLibraryClearanceStatus()
        {
            echo "Library Clears You!";
        }

        private function getStudent($id)
        {
            $query = "SELECT * FROM students WHERE id = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute(array($id));
        }

    }