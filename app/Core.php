<?php 

    class Core extends Database {

        public function getAllDepartments()
        {
            $query = "SELECT * FROM departments";
            $stmt = $this->connect()->prepare($query);

            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $data;
        }
    }
  