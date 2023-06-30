<?php

    // require 'Database.php';

    class HodModel extends Database {

        private $id;
        private $fullname;
        private $department;
        private $assigned_password;

        public $error;
        public $message;

        public function __construct($id, $fullname, $department, $assigned_password) {


            $this->id = $id;
            $this->fullname = $fullname;
            $this->department = $department;
            $this->assigned_password = $assigned_password;

            if($this->checkForEmptyInputs($this->fullname, $this->department, $this->assigned_password) == true)
            {
                if($this->checkPasswordLength($this->assigned_password) == true)
                {
                    if($this->AddHod($this->id, $this->fullname, $this->department, $this->assigned_password))
                    {                    
                        header("Location: http://localhost/clearancems/admin/dashboard/hods.php");
                        $this->message = "HOD Added Successfully!";
                    }
                    else 
                    {                    
                        header("Location: http://localhost/clearancems/admin/dashboard/hods.php");
                        $this->error = "Error Adding HOD!";
                        exit();
                    }
                }
                else
                {                    
                    header("Location: http://localhost/clearancems/admin/dashboard/hods.php");
                    $this->error = "Assign Passwords that are 5 Characters and Above Only!";
                    exit();
                }
            }
            else 
            {
                header("Location: http://localhost/clearancems/admin/dashboard/hods.php");
                $this->error = "Please do not Leave any Field Blank!";
                exit();
            }

        }

        private function checkForEmptyInputs($fullname, $department, $assigned_password) {

            $result;

            if(!empty($fullname) && !empty($department) && !empty($assigned_password))
            {
                $result = true;
            }
            else 
            {
                $result = false;
            }

            return $result;

        } 

        private function checkPasswordLength($pass)
        {
            $result;

            if(strlen($pass) >= 5)
            {
                $result = true;
            }
            else
            {
                $result = false;
            }

            return $result;
        }

        private function AddHod($id, $fullname, $department, $assigned_password )
        {
            $query = "INSERT INTO head_of_department (id, fullname, department, password) VALUES (?, ?, ?, ?) ";
            $stmt = $this->connect()->prepare($query);

            return $stmt->execute(array(
                $id, 
                $fullname,
                $department,
                $assigned_password
            ));
        }




    }