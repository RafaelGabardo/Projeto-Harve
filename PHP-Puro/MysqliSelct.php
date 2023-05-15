<?php
    // Declarando variáveis
    $host = 'localhost';
    $password = '';
    $user = 'root';
    $dbname = 'projetoharve';

    // Fazendo o if para caso apertem no botão "submit"
    if(isset($_POST['submit'])) {
        // Fazendo a conexão com o banco de dados
        $connect = new mysqli($host, $user, $password, $dbname);

        // Colocando os valores do form em variáveis
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        // Fazendo o query para verificar se as informações passadas são corretas
        $sql = "
            SELECT
                `id`
            FROM
                users
            WHERE
                `email` = '$email' AND `password` = '$pass'
        ";

        // Executando o query e armazenando numa variável
        $e = $connect->query($sql);

        // Fazendo o if para caso o query retorne verdadeiro, vá para a página do fórum, se não exibe uma mensagem
        if($e) {
            require('Forum.php');
        } else {
            echo 'Usuário ou senha incorretos! <br>';
        }
    }
?>