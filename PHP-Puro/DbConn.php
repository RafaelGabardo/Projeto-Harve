<?php
    $host = 'localhost';
    $password = '';
    $user = 'root';
    $dbname = 'projeto-harve';

    function dbConnect($host, $password, $user, $dbname,)
    {
        $pdoOptions = [
            PDO::ATTR_PERSISTENT => TRUE,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];
        
        if(isset($_POST['submit'])) {
            try {
                $pdoConnect = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $user, $password, $pdoOptions);
            } catch(PDOException $exc) {
                echo $exc->getMessage();
                exit;
            }
        }
        
        return $pdoConnect;
    }
    
    function dbInsert($pdoConnect)
    {
        if(isset($_POST['submit'])) {
            $fullname = $_POST['fullname'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $pass1 = $_POST['pass1'];
            $pass2 = $_POST['pass2'];
            $address = $_POST['address'];
            $birthdate = $_POST['birthdate'];

            if(!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[a-zA-Z\d].\S{8,36}$/', $pass1) && !preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[a-zA-Z\d].\S{8,36}$/', $pass2)) {
                echo 'As senhas devem seguir os parâmetros: <br>
                    -Conter no mínimo 8 caracteres e no máximo 36; <br>
                    -Conter pelo menos 1 letra maiúscula e pelo menos 1 número; <br>
                    -Conter apenas letras e números, sem símbolos. <br>
                ';
                die;
            }

            if($pass1 === $pass2) {
                $sql = "
                    INSERT INTO
                        users (`name`,`username`,`email`,`password`,`address`,`birthdate`)
                    VALUES
                        (`:name`,`:username`,`:email`,`:password`,`:address`,`:birthdate`)
                ";

                $query = $pdoConnect->prepare($sql);

                $ensure = [
                    $fullname => ':name',
                    $username => ':username',
                    $email => ':email',
                    $pass1 => ':password',
                    $address => ':address',
                    $birthdate => ':birthdate',
                ];

                $search = "
                    SELECT
                        {$email}
                    FROM
                        users
                ";

                if($email == $search) {
                    echo 'Esse email já está cadastrado! <br>';
                    die;
                }

                $result = $query->execute($ensure);

                if($result) {
                    echo 'Dados Salvos! <br>';
                } else {
                    echo 'Erro ao salvar! <br>';
                }
            } else {
                echo 'Ambas as senhas devem ser iguais <br>';
            }
        }

        return $result;
    }
?>