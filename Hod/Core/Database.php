<?php

    class Database {

        private $dbHost = "localhost";
        private $dbName = "clearance";
        private $dbUser = "root";
        private $dbPass = "";

        public $error;
        protected $dsn; 

        public function connect() {

            $this->dsn = "mysql:host=" . $this->dbHost . ";dbname=" . $this->dbName;

            try {
                $conn = new PDO($this->dsn, $this->dbUser, $this->dbPass);
            } catch (PDOException $e) {
                echo "Error!" . $e->getMessage();
            }

            return $conn;
        }

    }