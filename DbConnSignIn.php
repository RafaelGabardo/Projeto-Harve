<?php
    require('SignIn.php');

    class Connection
    {
        private $host = 'localhost';
        private $password = 'root';
        private $user = 'root';
        private $dbname = 'projeto-harve';
        protected $pdoConnect;
    
        public function __construct()
        {
            $pdoOptions = [
                PDO::ATTR_PERSISTENT => TRUE,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ];
            
            if(isset($_POST['submit'])) {
                try {
                    $this->pdoConnect = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname, $this->user, $this->password, $pdoOptions);
                } catch(PDOException $exc) {
                    echo $exc->getMessage();
                    exit;
                }
            }
        }
    }
?>