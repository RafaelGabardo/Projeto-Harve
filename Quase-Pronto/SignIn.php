<?php
    // Declarando variáveis para a conexão
    $host = 'localhost';
    $password = '';
    $user = 'root';
    $dbname = 'projetoharve';
    
    // Fazendo o if para caso clickem no botão "submit"
    if(isset($_POST['submit'])) {
        // fazendo a conexão com o banco de dados
        $connect = new mysqli($host, $user, $password, $dbname);

        // Armazenando os valores em variáveis
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];
        $address = $_POST['address'];
        $birthdate = $_POST['birthdate'];

        // Fazendo o if para caso as senhas não sigam os parâmetros
        if(!preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,36}$/', $pass1) && !preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,36}$/', $pass2)) {
            die('As senhas devem seguir os parâmetros: <br>
            -Conter no mínimo 8 caracteres e no máximo 36; <br>
            -Conter pelo menos 1 letra maiúscula, 1 letra minúscula e pelo menos 1 número; <br>
            -Conter pelo menos 1 símbolo. <br>
            ');
        }
       
        // Fazendo o if para caso as senhas forem idênticas
        if($pass1 === $pass2) {
            // Fazendo o query para armazenar os valores no banco de dados
            $sql = "
                INSERT INTO
                    users (`name`,`username`,`email`,`password`,`address`,`birthdate`,`created_at`)
                VALUES
                    ('$fullname','$username','$email','$pass1','$address','$birthdate',NOW())
            ";
            
            // Fazendo o query para caso o email já esteja cadastrado
            $search = "
                SELECT
                    `id`
                FROM
                    users
                WHERE
                    `email` = '$email'
            ";
            
            // Executando o query da busca e armazenando em uma variável
            $e = $connect->query($search);

            // Fazendo o if para caso o query da busca retorne verdadeiro
            if($e) {
                die('Esse email já está cadastrado! <br>');
            }

            // Fazendo o if para caso a execução da inserção dos valores dê certo ou não
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
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sign in</title>
    <link rel="stylesheet" href="SignIn.css">
</head>
<body>
    <form class="form" method="POST" action="SignIn.php">
        <label class="label" for="fullname">Insira seu nome completo:</label> <br>
        <input id="fullname" class="text" type="text" name="fullname" placeholder="Aderbal Silva"> <br><br>
        <label class="label" for="username">Insira seu nome de usuário:</label> <br>
        <input id="username" class="text" type="text" name="username" placeholder="NomeDeUsuário"> <br><br>
        <label class="label" for="email">Insira seu email:</label> <br>
        <input id="email" class="text" type="email" name="email" placeholder="aderbalsilva@yahoo.com"> <br><br>
        <label class="label" for="password">Crie sua senha:</label> <br>
        <input id="pass1" class="text" type="password" name="pass1"> <br><br>
        <label class="label" for="password confirmation">Confirme sua senha:</label> <br>
        <input id="pass2" class="text" type="password" name="pass2"> <br><br>
        <label class="label" for="address">Insira seu endereço:</label> <br>
        <input id="address" class="text" type="text" name="address" placeholder="Rua Joãozinho da Silva, 357"> <br><br>
        <label class="label" for="birthdate">Insira sua data de nascimento:</label> <br>
        <input id="birthdate" class="date" type="date" name="birthdate"> <br><br>
        <input id="submit" class="submit" type="submit" name="submit" value="Enviar" onclick="passwordValidation()">
    </form>
    <script>
        // Fazendo a função de validação de senha, sendo passada pela funçao nativa "onclick"
        function passwordValidation() {
            let pass1 = document.getElementById('pass1').value;
            let pass2 = document.getElementById('pass2').value;
            let passValidate = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,36}$/;
            let password = passValidate.test(pass1);

            if (pass1 !== pass2) alert('Senha não confere.')

            if(!password) {
                alert(`A senha deve seguir os parâmetros:
                -Conter no mínimo 8 caracteres e no máximo 36; 
                -Conter pelo menos 1 letra maiúscula; 
                -Conter pelo menos 1 letra minúscula;
                -Conter pelo menos 1 número; 
                -Conter pelo menos 1 símbolo. 
                `);
            }
        }
    </script>
</body>
</html>