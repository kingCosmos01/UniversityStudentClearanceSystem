<?php


    class StudentLogin extends Database {

        private $matric_no;
        private $department;
        private $password;

        public function __construct($matric_no, $department, $password) {

            $this->matric_no = $matric_no;
            $this->department = $department;
            $this->password = $password;

            if($this->validate($this->matric_no, $this->department, $this->password) == true)
            {
                header("Location: http://localhost/clearancems/student/");
            }
    

        }

        private function validate($matric_no, $department, $password)
        {
            $result;
            if($this->checkEmptyInputs($matric_no, $department, $password) == true)
            {
                if($this->getMatricNumber($matric_no) == true && $this->getDepartment($department) == true && $this->getPassword($password))
                {
                    if($this->prepareUser($matric_no) == true)
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
                    $error = "User Not Found!";
                    header("Location: http://localhost/clearancems/student/login.php?err=" .urlencode($error));
                    exit();
                }
            }
            else
            {
                $error = "";
                header("Location: http://localhost/clearancems/student/login.php?err=" .urlencode($error));
                exit();
            }
            return $result;
        }


        private function checkEmptyInputs($matric_no, $department, $password)
        {
            $result;

            if(!empty($matric_no) && !empty($department) && !empty($password))
            {
                $result = true;
            }
            else 
            {
                $result = false;
            }

            return $result;
        }

        private function getMatricNumber($matric_no)
        {
            $query = "SELECT id FROM students WHERE id = ?";
            $stmt = $this->connect()->prepare($query);

            $stmt->execute(array($matric_no));
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $result;
            if($matric_no == $data[0]['id'])
            {   
                print_r($data);
                $result = true;
            }
            else
            {
                $result = false;
            }

            return $result;
        }

        private function getDepartment($department)
        {
            $query = "SELECT department FROM students WHERE department = ?";
            $stmt = $this->connect()->prepare($query);

            $stmt->execute(array($department));
            
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $result;
            if($data[0]['department'] === $department)
            {
                print_r($data);
                $result = true;
            }
            else
            {
                $result = false;
            }

            return $result;

        }

        private function getPassword($password)
        {
            $query = "SELECT password FROM students WHERE password = ?";
            $stmt = $this->connect()->prepare($query);

            $stmt->execute(array($password));

            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $result;
            if($data[0]['password'] === $password)
            {
                print_r($data);
                $result = true;
            }
            else
            {
                $result = false;
            }

            return $result;

        }

        private function prepareUser($matric_no)
        {
            $student = $this->getUser($matric_no);

            $studentName = $student[0]['fullname'];
            $studentMatricNo = $student[0]['id'];
            $studentDepartment = $student[0]['department'];
            $studentCourse = $student[0]['course'];
            $studentClearanceStatus = $student[0]['cleared'];

            $_SESSION['id'] = $studentMatricNo; 
            $_SESSION['student'] = [$studentName, $studentDepartment, $studentCourse]; 
            $_SESSION['fullname'] = $studentName;
            $_SESSION['department'] = $studentDepartment;
            $_SESSION['course'] = $studentCourse;
            $_SESSION['clearance'] = $studentClearanceStatus;

            return true;

        }

        private function getUser($matric_no)
        {
            $query = "SELECT * FROM students WHERE id = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute(array($matric_no));

            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        

    }