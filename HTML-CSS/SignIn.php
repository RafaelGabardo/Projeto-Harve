<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sign in</title>
    <link rel="stylesheet" href="SignIn.css">
</head>
<body>
    <form class="form" action="SignIn.php" method="POST">
        <label class="label" for="fullname">Insira seu nome completo:</label> <br>
        <input class="text" type="text" name="fullname" placeholder="Aderbal Silva"> <br><br>
        <label class="label" for="username">Insira seu nome de usuário:</label> <br>
        <input class="text" type="text" name="username" placeholder="NomeDeUsuário"> <br><br>
        <label class="label" for="email">Insira seu email:</label> <br>
        <input class="text" type="email" name="email" placeholder="aderbalsilva@yahoo.com"> <br><br>
        <label class="label" for="password">Crie sua senha:</label> <br>
        <input class="text" type="password" name="pass1"> <br><br>
        <label class="label" for="password confirmation">Confirme sua senha:</label> <br>
        <input class="text" type="password" name="pass2"> <br><br>
        <label class="label" for="address">Insira seu endereço:</label> <br>
        <input class="text" type="text" name="address" placeholder="Rua Joãozinho da Silva, 357"> <br><br>
        <label class="label" for="birthdate">Insira sua data de nascimento:</label> <br>
        <input class="date" type="date" name="birthdate"> <br><br>
        <input class="submit" type="submit" name="submit" value="Enviar">
    </form>
</body>
</html>