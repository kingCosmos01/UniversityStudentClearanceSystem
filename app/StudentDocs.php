<?php

    class StudentDocs extends Database {

        private $maxCourseForms = 8;
        private $maxReceipts = 4;
        private $documentType;
        private $user_id;

        protected $fileName;
        protected $fileType;
        protected $tempName;
        protected $allowedExtensions = ['jpg', 'jpeg', 'png'];

        protected $totalFiles;
        protected $remainingFiles;

        protected $student;

        public $file;
        public $error;
        public $message;


        public function __construct($file, $type, $user_id) {

            $this->file = $file;
            $this->documentType = $type;
            $this->user_id = $user_id;

            $this->file;

            $this->student = $this->getStudentById($this->user_id);


            if(!empty($this->file) && !empty($this->documentType) && !empty($this->user_id))
            {
                $total = $this->getTotalFilesSubmitted($this->file);

               for ($i = 0; $i < $total; $i++) 
               { 
                    $this->fileName = $this->file['name'][$i];

                    $ext = pathinfo($this->fileName, PATHINFO_EXTENSION);                 

                    $newFileName = md5(uniqid());

                    $fileDest = '../uploads/'.$newFileName.'.'.$ext;

                    $justFileName = $newFileName.'.'.$ext;

                    if(!in_array($ext, $this->allowedExtensions))
                    {
                        $this->error = "Upload PNG, JPG, JPEG only! ";
                        echo $this->error;
                        header("Location: http://localhost/clearancems/student/documents.php?param=err&message=" . urlencode($this->error));
                        exit();
                    }
                    else
                    {
                        if(move_uploaded_file($this->file['tmp_name'][$i], $fileDest))
                        {
                            $this->isUploaded = true;
                        }
                        else
                        {                            
                            $this->error = "Error Uploading Documents!";
                            header("Location: http://localhost/clearancems/student/documents.php?param=err&message=".urlencode($this->message));
                            exit();
                        }
                    }  
               }

               if($this->isUploaded  === true)
               {
                    $form_id = uniqid();

                    if($this->saveCourseForms(
                        $this->student[0]['id'], $form_id, $this->student[0]['fullname'], 
                        $this->student[0]['department'], $this->student[0]['course'], 
                        $fileDest))
                    {
                        $this->message = "Documents Submitted!";
                        header("Location: http://localhost/clearancems/student/documents.php?param=success&message=" . urlencode($this->message));
                    }
               }
               

            }
            

        }
        


        // getting remaining files
        public function getRemainingFiles($from)
        {
            switch ($from) {
                case 'course_form':
                    $this->remainingFiles = ($this->maxCourseForms - $this->totalFiles);
                    break;
                
                case 'receipts':
                    $this->remainingFiles = ($this->maxReceipts - $this->totalFiles);
                    break;
            }
        }

        public function getTotalFilesSubmitted($doc)
        {
            return $this->totalFiles = count($doc['name']);
        }


        private function saveDocuments($type)
        {
            switch ($type) {
                case 'course_form':
                    $this->saveCourseForms();
                    break;
                
                case 'receipts':
                    # code...
                    break;
            }
        }


        private function saveCourseForms($student_id, $form_id, $fullname, 
            $department, $course, $form)
        {
            $query = "INSERT INTO course_forms (
                student_id,
                form_id,
                student_name,
                department,
                course,
                form
            ) 
            VALUES ( ?, ?, ?, ?, ?, ? ) ";   

            $stmt = $this->connect()->prepare($query);
            $stmt->execute(array(
                $student_id, 
                $form_id,
                $fullname, 
                $department, 
                $course, 
                $form
            ));
            
        }

        private function saveReceipts($student_id, $fullname, $department, $course, $form, $status)
        {
            $query = "";   
        }


        // get Student By their ID
        private function getStudentById($id)
        {
            $query = "SELECT * FROM students WHERE id = ?";
            $stmt = $this->connect()->prepare($query);

            $stmt->execute(array($id));
            $student = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $student;
        }


    }