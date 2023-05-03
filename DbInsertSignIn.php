<?php
    require('SignIn.php');

    class Insert extends Connection
    {
        public $fullname = $_POST['fullname'];
        public $username = $_POST['username'];
        public $email = $_POST['email'];
        public $pass1 = $_POST['pass1'];
        public $pass2 = $_POST['pass2'];
        public $address = $_POST['address'];
        public $birthdate = $_POST['birthdate'];

        protected function sqlInsert()
        {
            if(isset($_POST['submit'])) {
                $this->pass1 = preg_match('#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#', $this->pass1);

                if($this->pass1 === $this->pass2) {
                    $sql = "
                        INSERT INTO
                            users (`name`,`username`,`email`,`address`,`password`,`birthdate`)
                        VALUES
                            (:name,:username,:email,:address,:password,:birthdate)
                    ";

                    $query = $this->pdoConnect->prepare($sql);

                    $ensure = [
                        $this->fullname => ':name',
                        $this->username => ':username',
                        $this->email => ':email',
                        $this->address => ':address',
                        $this->pass1 => ':password',
                        $this->birthdate => ':birthdate',
                    ];

                    $query->execute($ensure);

                    $search = "
                        SELECT
                            '$this->email'
                        FROM
                            users
                    ";

                    if($search === $this->email) {
                        echo 'Esse email já está cadastrado.';
                    }

                    if($query) {
                        echo 'Dados salvos!';
                    } else {
                        echo 'Erro!';
                    }
                } else {
                    echo 'Ambas as senhas devem ser iguais.';
                }
            }

            return $query;
        }
    }
?>