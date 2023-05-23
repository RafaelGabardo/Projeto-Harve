<?php
    // To pensando em como fazer para adicionar apenas uma variável de um arquivo em outro, sem incluir o html junto

    // Declarando variáveis
    $host = 'localhost';
    $password = '';
    $user = 'root';
    $dbname = 'projetoharve';

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
?>