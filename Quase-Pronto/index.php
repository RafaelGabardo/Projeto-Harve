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
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Log in</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <form class="form" method="POST" action="index.php">
        <label class="label" for="email">Insira seu email:</label> <br>
        <input class="text" id="email" type="text" name="email"> <br><br>
        <label class="label" for="password">Insira sua senha:</label> <br>
        <input class="text" id="password" type="password" name="pass"> <br><br>
        <input class="submit" id="submit" type="submit" name="submit" value="Log in">
    </form>
</body>
</html>