<?php

    class Register extends Database {

        private $fullname;
        private $department;
        private $matricNo;
        private $course_of_study;
        private $student_residence;
        private $password;
        private $c_pass;

        private $default_clearance_status;



        public function __construct($matricNo, $fullname, $department, $course_of_study, $student_residence, $password, $c_pass, $default_clearance_status) {

            $this->matricNo = $matricNo;
            $this->fullname = $fullname;
            $this->department = $department;
            $this->course_of_study = $course_of_study;
            $this->student_residence = $student_residence;
            $this->password = $password;
            $this->c_pass = $c_pass;

            $this->default_clearance_status = $default_clearance_status;

            if(!empty($this->fullname) && !empty($this->matricNo) && !empty($this->department) && !empty($this->course_of_study) && !empty($this->student_residence) && !empty($this->password) && !empty($this->c_pass)) {

                if($this->checkPasswordMatch($this->password, $this->c_pass) == true) {
                        
                    if($this->checkPasswordLength($this->password) == true) {

                        $query = "INSERT INTO students (id, fullname, department, course, residence, password, cleared) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)";

                        $stmt = $this->connect()->prepare($query);

                        $stmt = $stmt->execute(array(
                            $this->matricNo, 
                            $this->fullname,
                            $this->department, 
                            $this->course_of_study,
                            $this->student_residence,
                            $this->password,
                            $this->default_clearance_status
                        ));
                        

                        // create Record
                        if($stmt) {

                            session_start();

                            $_SESSION['id'] = $this->matricNo;
                            $_SESSION['student'] = $this->fullname;
                            $_SESSION['department'] = $this->department;
                            $_SESSION['clearance'] = $this->default_clearance_status;

                            header("location: http://localhost/clearancems/student/");							
                        }
                        else {
                            $error = "Unable to Create Record, Please Try Again!";
                            header("location: http://localhost/clearancems/");                                
                        }
                    }
                    else {
                        $error = "Password Must be 5 Characters and Above!";
                        header("location: http://localhost/clearancems/");
                    }
            
                }
                else {
                    $error = "The two Passwords do not Match!";
                    header("location: http://localhost/clearancems/");            
                }
    
            } else {
                $error = "Please fill all empty Fields!";
                header("location: http://localhost/clearancems/");                
            }

        } 


        private function checkPasswordMatch($pass, $c_pass) {
            if($pass !== $c_pass) {
                $res = false;
            }
            else {
                $res = true;
            }
    
            return $res;
        }
    
        private function getMatricNumber($matric_no) {
            return explode('/', $matric_no);
        }
    
        private function validateMatricNumber($matric_no) {
    
            $matric_no = $this->getMatricNumber($matric_no);
    
            $school = $matric_no[0];
            $faculty = $matric_no[1];
            $course_of_study = $matric_no[2];
            $year_of_admission = $matric_no[3];
            $number = $matric_no[4];
    
            $current_year = date('Y');
            $canBeCleared = ($current_year - ((2000) + $year_of_admission));
    
    
            if($canBeCleared >= 4) {
    
                $res = true;
    
                if($school == "bsu") {
    
                    $res = true;
                    
                } else {
                    $res = false;
                }
            }
            else {
                $res = false;
            }
    
            return $res;	
        }
    
        // checking the password Length if it is less 5
        private function checkPasswordLength($pass) {
    
            $res;
    
            if(strlen($pass) < 5) {
    
                $res = false;
            }
            else {
                $res = true;
            }
            return $res;
        }
    
    

        















    }