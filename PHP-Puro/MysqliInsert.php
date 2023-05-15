<?php
    // Declarando as variáveis
    $host = 'localhost';
    $password = '';
    $user = 'root';
    $dbname = 'projetoharve';

    // Fazendo o if para caso apertem no botão "submit"
    if(isset($_POST['submit'])) {
        // Fazendo a conexão com o banco de dados
        $connect = new mysqli($host, $user, $password, $dbname);

        // Armazenando os valores do form em variáveis
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];
        $address = $_POST['address'];
        $birthdate = $_POST['birthdate'];

        // Fazendo o if para caso as senhas não correspondam aos parâmetros
        if(!preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,36}$/', $pass1) && !preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,36}$/', $pass2)) {
            die('As senhas devem seguir os parâmetros: <br>
            -Conter no mínimo 8 caracteres e no máximo 36; <br>
            -Conter pelo menos 1 letra maiúscula, 1 letra minúscula e pelo menos 1 número; <br>
            -Conter pelo menos 1 símbolo. <br>
        ');
        }

        // Fazendo o if para caso ambas as senhas sejam iguais
        if($pass1 === $pass2) {
            // Fazendo o query para inserir os valores no banco de dados
            $sql = "
                INSERT INTO
                    users (`name`,`username`,`email`,`password`,`address`,`birthdate`,`created_at`)
                VALUES
                    ('$fullname','$username','$email','$pass1','$address','$birthdate',NOW())
            ";

            // Fazendo o query para garantir que o email já foi cadastrado ou não
            $search = "
                SELECT
                    `id`
                FROM
                    users
                WHERE
                    `email` = '$email'
            ";

            $e = $connect->query($search);

            if($e) {
                die('Esse email já está cadastrado! <br>');
            }

            // Fazendo o if para caso o query seja executado com sucesso
            if($connect->query($sql)) {
                echo 'Dados salvos com sucesso! <br>';
            } else {
                echo 'Erro!';
            }
        } else {
            echo 'Ambas as senhas devem ser iguais <br>';
        }
    }
?>