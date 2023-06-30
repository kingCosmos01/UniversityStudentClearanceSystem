<?php

class StudentClearance extends Database {

    private $studentMatricNo;
    private $studentDepartment;


    public function __construct($studentMatricNo, $studentDepartment)
    {
        $this->studentMatricNo = $studentMatricNo;
        $this->studentDepartment = $studentDepartment;
    }


    public function GetDepartmentalClearanceStatus()
    {
        $query = "SELECT clearance_status FROM cleared_students  WHERE student_id = ? AND department = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(array(
            $this->studentMatricNo,
            $this->studentDepartment
        ));

        $status = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $status;
    }

    public function GetResidenceClearanceStatus()
    {
        $query = "SELECT status FROM residence_cleared_students  WHERE student_id = ? AND department = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(array(
            $this->studentMatricNo,
            $this->studentDepartment
        ));
        
        $status = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $status;
    }


















}