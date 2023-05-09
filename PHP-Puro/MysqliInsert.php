<?php
    // Declarando variáveis
    $host = 'localhost';
    $password = '';
    $user = 'root';
    $dbname = 'projetoharve';

    // Fazendo o if para caso apertem no botão nomeado "submit"
    if(isset($_POST['submit'])) {
        // Fazendo a conexão com o banco de dados
        $connect = new mysqli($host, $user, $password, $dbname);

        // Colocando os valores informados em variáveis
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];
        $address = $_POST['address'];
        $birthdate = $_POST['birthdate'];

        // Fazendo o if para caso as senhas não correspondam aos requisitos
        if(!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[a-zA-Z\d].\S{8,36}$/', $pass1) && !preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[a-zA-Z\d].\S{8,36}$/', $pass2)) {
            die('As senhas devem seguir os parâmetros: <br>
            -Conter no mínimo 8 caracteres e no máximo 36; <br>
            -Conter pelo menos 1 letra maiúscula e pelo menos 1 número; <br>
            -Conter apenas letras e números, sem símbolos. <br>
        ');
        }

        // Fazendo o if para caso as senhas sejam idênticas, se não exibe uma mensagem na tela
        if($pass1 === $pass2) {
            // Fazendo o query de inserção no banco de dados
            $sql = "
                INSERT INTO
                    users (`name`,`username`,`email`,`password`,`address`,`birthdate`,`created_at`)
                VALUES
                    ('$fullname','$username','$email','$pass1','$address','$birthdate',NOW())
            ";

            // Procurando se já existe um email cadastrado no banco de dados (estou com dúvida)
            $search = "
                SELECT
                    {$email}
                FROM
                    users
            ";

            // Fazendo o if para caso o email seja idêntico ao encontrado no banco de dados e, se for, encerra o código e exibe uma mensagem
            if($email === $search) {
                die('Esse email já está cadastrado! <br>');
            }

            // Fazendo o if para executar o query e retornando mensagens em caso de sucesso ou falha
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