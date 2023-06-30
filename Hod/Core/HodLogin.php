<?php


    class HodLogin extends Database {

        private $fullname;
        private $department;
        private $password;

        protected $message;

        public $error;



        public function __construct($fullname, $department, $password) {

            $this->fullname = $fullname;
            $this->department = $department;
            $this->password = $password;

            $hodData = $this->getHod($this->fullname, $this->department, $this->password);
            print_r($hodData);
            
            if($hodData != null )
            {
                $HodFullname = $hodData[0]['fullname'];
                $HodDepartment = $hodData[0]['department'];

                if($this->isHodFound($hodData[0]['fullname'], $hodData[0]['department'], $hodData[0]['password']) == true)
                {
                    $this->sessionParams($hodData[0]['fullname'], $hodData[0]['department']);
                    $this->RedirectUserToDepartment($hodData[0]['department'], $hodData[0]['fullname']);
                }
                else
                {
                    $message = "User not Found! Check Details and try again.";
                    header("Location: http://localhost/clearancems/hod/?error=" .urlencode($message));
                    exit();
                }
            }
            else
            {
                $message = "User not Found! Check Details and try again.";
                header("Location: http://localhost/clearancems/hod/?error=" .urlencode($message));
                exit();
            }

        }


        private function isHodFound($fullname, $department, $password)
        {
            $result;

            if($this->checkEmptyFields($fullname, $department, $password) == true)
            {
                $result = true;

                if($this->isFullnameFound($fullname) == true 
                && $this->isDepartmentFound($department) == true 
                && $this->isPasswordFound($password) == true 
                )
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

        private function isFullnameFound($fullname)
        {
            if($this->fullname === $fullname)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        private function isDepartmentFound($department)
        {
            if($this->department === $department)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        private function isPasswordFound($password)
        {
            if($this->password === $password)
            {
                return true;
            }
            else
            {
                return false;
            }
        }





        private function getHod($fullname, $department, $password)
        {
            $query = "SELECT * FROM head_of_department WHERE fullname = ? AND department = ? AND password = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute(array(
                $fullname,
                $department,
                $password
            ));

            $hodData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $hodData; 
        }





        private function RedirectUserToDepartment($department, $fullname)
        {
            switch ($department) {
                case 'Mathematics and Computer Science':
                    $_SESSION['hod_cmp'] = $fullname;
                    header('Location: http://localhost/clearancems/hod/dashboard/cmp/');
                    break;
                case 'Physics':
                    $_SESSION['hod_physics'] = $fullname;
                    header('Location: http://localhost/clearancems/hod/dashboard/physics/');
                    break;
                case 'Biology':
                    $_SESSION['hod_biology'] = $fullname;
                    header('Location: http://localhost/clearancems/hod/dashboard/biology/');
                    break;
                case 'Chemistry':
                    $_SESSION['hod_chemistry'] = $fullname;
                    header('Location: http://localhost/clearancems/hod/dashboard/chemistry/');                     
                    break;
                case 'Ict':
                     header('Location: http://localhost/clearancems/hod/dashboard/ict/');
                     $_SESSION['hod_ict'] = $this->fullname;
                    break;
                case 'Bursary':
                     header('Location: http://localhost/clearancems/hod/dashboard/bursary/');
                     $_SESSION['hod_bursary'] = $this->fullname;
                    break;
                case 'Library':
                     header('Location: http://localhost/clearancems/hod/dashboard/library/');
                     $_SESSION['hod_library'] = $this->fullname;
                    break;
                case 'Security':
                     header('Location: http://localhost/clearancems/hod/dashboard/security/');
                     $_SESSION['hod_security'] = $this->fullname;
                    break;
                case 'Residence':
                     header('Location: http://localhost/clearancems/hod/dashboard/residence/');
                     $_SESSION['hod_residence'] = $this->fullname;
                    break;
                
            }
        }

       

        private function checkEmptyFields($fullname, $department, $password)
        {
            $result;

            if(!empty($fullname) && !empty($department) && !empty($password) )
            {
                $result = true;
            }
            else
            {
                $result = false;
            }

            return $result;
        }



        private function sessionParams($fullname, $department)
        {
            $_SESSION['hod'] = $fullname;
            $_SESSION['department'] = $department;
        }


    }