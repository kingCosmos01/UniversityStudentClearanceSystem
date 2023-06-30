<?php

    class Department extends Database {

        public function getAllDepartments()
        {
            $query = "SELECT * FROM departments";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    }