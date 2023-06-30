<?php


    class Admin extends Database {


        private function getAllHods() {

            $query = "SELECT * FROM head_of_department";
            $stmt = $this->connect()->prepare($query);

            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        }


        public function getAllStudents() {

            $query = "SELECT * FROM ready_for_clearance WHERE department = ?";
            $stmt = $this->connect()->prepare($query);

            $stmt->execute(array($_SESSION['department']));
            $rows = $stmt->rowCount();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if($rows > 0)
            {
                foreach ($data as $student) {
                    $id = $student["student_id"];
                    echo "<li class='head'>";
                    echo "<h4>" . $student["student_id"] ."</h4>";
                    echo "<h4>". ucwords($student["student_name"]) ."</h4>";
                    echo "<h4>". $student["department"] ."</h4>";
                    echo "<h4>
                            <span class='warning-info'>uncleared</span>
                            <a href='http://localhost/clearancems/hod/dashboard/cmp/?id=$id&req=clear' class='clear'>Clear</a>
                         </h4>";
                    echo "</li>";
                }
            }
            else
            {
                echo "<div class='warning'>There are no Student Available to be Cleared!</div>";
            }
            
        }


        public function getAllClearedStudents() {

            $query = "SELECT * FROM cleared_students WHERE department = ?";
            $stmt = $this->connect()->prepare($query);

            $stmt->execute(array($_SESSION['department']));
            $rows = $stmt->rowCount();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if($rows > 0) 
            {
                foreach ($data as $student) {
                    echo "<li class='head'>";
                    echo "<h4>" . $student["student_id"] ."</h4>";
                    echo "<h4>". ucwords($student["student_fullname"]) ."</h4>";
                    echo "<h4>". $student["department"] ."</h4>";
                    echo "<h4 class='cleared'>" . $student["clearance_status"] ."</h4>";
                    echo "</li>";
                }
            }
            else
            {
                echo "<div class='warning'>No Student Have been Cleared Yet !</div>";
            }
        }


        public function getAllStudentsWithCourseForms() {

            $hod = $this->getAllHods();

            $query = "SELECT * FROM course_forms WHERE department = ?";
            $stmt = $this->connect()->prepare($query);

            $department = $_SESSION['department'];
            
            $stmt->execute(array($department));
            $rows = $stmt->rowCount();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if($rows > 0) 
            {
                foreach ($data as $key => $student) {

                    $id = $student['student_id'];

                    echo "<li class='head'>";
                    echo "<h4>" . "<a href='?param=$id&req=view'>" . $student["student_id"] . "</a>" ."</h4>";
                    echo "<h4>". ucwords($student["student_name"]) ."</h4>";
                    echo "<h4>". $student["department"] ."</h4>";
                    echo "<h4>" . $student["course"] ."</h4>";
                    echo "</li>";
                }
            }
            else
            {
                echo "<div class='warning'>No Student Have Uploaded Their Course Forms Yet!</div>";
            }
        }


        public function ResidenceGetAllStudentsPreapredForClearance()
        {
            $query = "SELECT * FROM residence_prepared WHERE residence = ?";
            $stmt = $this->connect()->prepare($query);

            $stmt->execute(array('On Campus'));
            $rows = $stmt->rowCount();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $stmt = null;
            
            if($rows > 0)
            {
                foreach ($data as $student) {
                    $id = $student["student_id"];
                    $status = $student['status'];
                    echo "<li class='head'>";
                    echo "<h4>" . $student["student_id"] ."</h4>";
                    echo "<h4>". ucwords($student["student_name"]) ."</h4>";
                    echo "<h4>". $student["residence"] ."</h4>";
                    echo "<h4>
                            <span class='warning-info'>$status</span>
                            <a href='http://localhost/clearancems/hod/dashboard/residence/?id=$id&req=clear' class='clear'>Clear</a>
                         </h4>";
                    echo "</li>";
                }
            }
            else
            {
                echo "<div class='warning'>There are no Student Available to be Cleared!</div>";
            }
        }

        public function ResidenceGetAllStudentsCleared()
        {
            $query = "SELECT * FROM residence_cleared_students";
            $stmt = $this->connect()->prepare($query);
            $residence = "Off Campus";
            $cleared = "Cleared";
            $stmt->execute();
            $rows = $stmt->rowCount();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if($rows > 0) 
            {
                foreach ($data as $student) {
                    echo "<li class='head'>";
                    echo "<h4>" . $student["student_id"] ."</h4>";
                    echo "<h4>". ucwords($student["student_name"]) ."</h4>";
                    echo "<h4>". $student["residence"] ."</h4>";
                    echo "<h4 class='cleared'>" . $student["status"] ."</h4>";
                    echo "</li>";
                }
            }
            else
            {
                echo "<div class='warning'>No Student Have been Cleared Yet !</div>";
            }
        }











    }