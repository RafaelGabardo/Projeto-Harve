<?php
    // Incluindo o arquivo para "emprestar" uma variável de dentro dele
    include_once('indexPHP.php');

    // Declarando variáveis para a conexão com o banco de dados
    $host = 'localhost';
    $password = '';
    $user = 'root';
    $dbname = 'projetoharve';

    // Fazendo a conexão com o banco de dados
    $connect = new mysqli($host, $user, $password, $dbname);

    // Fazendo o query para selecionar o nome de usuário, onde o id é o mesmo selecionado em outro arquivo
    $username = "
        SELECT
            `username`
        FROM
            users
        WHERE
            `id` = '$e'
    ";

    // Executando o query
    $query = $connect->query($username);

    // Fazendo o if e o while para exibir na tela o usuário cadastrado
    if($query->num_rows > 0) {
        while($row = $query->fetch_assoc()) {
            ?>
            <ul class="posts-list">
                <li class="posts"><?php $row['username'] ?></li>
            </ul>
            <?php
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Forum.css">
    <title>Fórum</title>
</head>
<body>
    <nav class="nav">
        <div class="block">

        </div>
        <ul class="nav-list">
        <a class="login" href="index.php"><div class="div-nav">
                <li class="cadastro">Log in</li>
            </div></a>
            <a class="signin" href="SignIn.php"><div class="div-nav">
                <li class="cadastro">Sign up</li>
            </div></a>
        </ul>
    </nav>
    <main class="main">
        <section class="section-menu">
            <div class="div-menu">
                <ul class="menu-list">
                    <li class="menu"><h1>Páginas</h1></li>
                    <li class="menu"><a class="pages" href="Forum.php">Fórum Geral</a></li>
                    <li class="menu"><a class="pages" href="">Amigos</a></li>
                </ul>
            </div>
        </section>
        <section class="section-posts">
            <div class="div-posts">
                <ul class="posts-list">
                    <li class="posts"><h1 class="h1-posts">Postagens</h1></li>
                    <li class="posts"><p class="paragraph-posts">Lorem Ipsum is simply dummy text of the printing and typesetting industry. <br>
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, <br>
                    when an unknown printer took a galley of type and scrambled it to make a type specimen book. <br>
                    It has survived not only five centuries, but also the leap into electronic typesetting, <br>
                    remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, <br>
                    and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p></li>
                </ul>
            </div>
        </section>
    </main>
</body>
</html>