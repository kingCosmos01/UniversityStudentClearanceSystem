<?php

    class AdminLogin extends Database {

        private $fullname;
        private $password;
        
        public $error;

        public function __construct($fullname, $password) {

            $this->fullname = $fullname;
            $this->password = $password;

            if($this->validate($this->fullname, $this->password) == true)
            {
                if($this->adminExists($this->fullname, $this->password) == true)
                {
                    $_SESSION["admin"] = $this->fullname;
                    header("Location: http://localhost/clearancems/admin/?param=err&message=");
                }
                else
                {
                    $this->error = "User not Found!";
                    header("Location: http://localhost/clearancems/admin/?param=err&message=" . urlencode($this->error));
                    exit();
                }
            }
            else
            {
                $this->error = "Invalid Entries!";
                header("Location: http://localhost/clearancems/admin/?param=err&message=" . urlencode($this->error));
                exit();
            }

        }

        private function validate($fullname, $password) {

            $result;

            if($this->checkEmptyInputs($fullname, $password) == true)
            {
                $result = true;
            }
            else 

            {
                $result = false;
            }

            return $result;
        }



        private function checkEmptyInputs($fullname, $password) {

            $res;
    
            if(!empty($fullname) && !empty($password))
            {
                $res = true;
            }   
            else 
            {
                $res = false;
            }
    
            return $res;
        }



        private function adminExists($fullname, $password) {

            $result;

            if($this->checkIfFullnameExists($fullname) === 1 && $this->checkIfPasswordExists($password) === 1)
            {
                $result = true;
            } 
            else 
            {
                $result = false;
            }
            return $result;
        }

    
        private function checkIfFullnameExists($fullname) {
    
            $query = "SELECT * FROM admin WHERE fullname = ?";
    
            $stmt = $this->connect()->prepare($query);

            $stmt->execute(array($fullname));
            return $stmt->rowCount();
        }


        private function checkIfPasswordExists($password) {
    
            $query = "SELECT * FROM admin WHERE password = ?";
    
            $stmt = $this->connect()->prepare($query);

            $stmt->execute(array($password));
            return $stmt->rowCount();
        }

     
    }

   