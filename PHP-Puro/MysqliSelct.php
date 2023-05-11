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

        // Inserindo os valores informados em variáveis
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        // Fazendo os querys para selecionar o email e a senha
        $sql = "
            SELECT
                `email`
            FROM
                users
        ";

        $select = "
            SELECT
                `password`
            FROM
                users
        ";

        // Executando os querys e armazenando em variáveis
        $e = $connect->query($sql);
        $p = $connect->query($select);

        // Fazendo o if para caso os valores existam no banco de dados ou não
        if($email === $e && $pass === $p) {
            require('Forum.php');
        } else {
            echo 'Usuário ou senha incorretos! <br>';
        }
    }
?>