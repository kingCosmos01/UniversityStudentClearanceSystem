<?php

    require 'Database.php';


    class Admin extends Database {

        public function getAllHods() {

            $query = "SELECT * FROM head_of_department";
            $stmt = $this->connect()->prepare($query);

            $stmt->execute();
            $rows = $stmt->rowCount();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if($rows > 0)
            {
                foreach ($data as $hod) {
                    echo "<li class='head'>";
                    echo "<h4>" . $hod["id"] ."</h4>";
                    echo "<h4>". ucwords($hod["fullname"]) ."</h4>";
                    echo "<h4>". $hod["department"] ."</h4>";
                    echo "<h4>CTA</h4>";
                    echo "</li>";
                }
            }
            else
            {
                echo "<div class='warning'>There are no HODs Assigned for Clearance Yet!</div>";
            }   
        }

        public function getAllDepartments() {

            $query = "SELECT * FROM departments";
            $stmt = $this->connect()->prepare($query);

            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($data as $department) {
                echo "<li class='head'>";
                    echo "<h4>" . $department["id"] ."</h4>";
                    echo "<h4>". $department["name"] ."</h4>";
                    echo "<h4>CTA</h4>";
                echo "</li>";
            }
        }


        public function getAllStudents() {

            $query = "SELECT * FROM ready_for_clearance";
            $stmt = $this->connect()->prepare($query);

            $stmt->execute();
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
                            <a href='http://localhost/clearancems/admin/dashboard/?id=$id&req=clear' class='clear'>Clear</a>
                        </h4>";
                    echo "</li>";
                }
            }
            else
            {
                echo "<div class='warning'>There are no Students Available for Clearance Yet!</div>";
            }    
        }


        public function getAllClearedStudents() {

            $query = "SELECT * FROM cleared_students";
            $stmt = $this->connect()->prepare($query);

            $stmt->execute();
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


       
        public function addDepartment($id, $department)
        {
            if(!empty($id) && !empty($department) )
            {
                $data = $this->AvailableDepartments();
                if($department == $data['name'])
                {
                    $error = "Department Already Exists!";
                    header("http://localhost/clearancems/admin/dashboard/?error=" . urlencode($error));
                    exit;
                }
                else
                {
                    $isDepartmentRegistered = $this->registerDepartment($id, $department);
                    if($isDepartmentRegistered)
                    {
                        $message = "Department Added!";
                        header("http://localhost/clearancems/admin/dashboard/?success=" . urlencode($message));
                    }
                }
            }
        }

        public function AvailableDepartments()
        {
            $query = "SELECT * FROM departments";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();

            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }


        private function registerDepartment($id, $department)
        {
            $query = "INSERT INTO departments (id, name) VALUES (?, ?)";
            $stmt = $this->connect()->prepare($query);
            
            return $stmt->execute(array($id, $department));
        }





    }