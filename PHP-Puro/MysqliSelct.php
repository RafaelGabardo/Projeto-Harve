<?php
    // Declarando variáveis para conexão com o banco de dados
    $host = 'localhost';
    $password = '';
    $user = 'root';
    $dbname = 'projetoharve';

    // fazendo o if para caso apertem no botão "submit"
    if(isset($_POST['submit'])) {
        // Fazendo a conexão com o banco de dados
        $connect = new mysqli($host, $user, $password, $dbname);

        // Armazenando os valores do formulário nas variáveis
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        // Fazendo o primeiro query para selecionar o email
        $sql = "
            SELECT
                {$email}
            FROM
                users
        ";

        // Fazendo o segundo query para selecionar a senha
        $select = "
            SELECT
                {$pass}
            FROM
                users
        ";

        // Fazendo o if para caso a execução de ambos os querys dê erro
        if(!$connect->query($sql) && !$connect->query($select)) {
            echo 'Usuário ou senha não correspondem';
        } else {
            require('Forum.php');
        }
    }
?>