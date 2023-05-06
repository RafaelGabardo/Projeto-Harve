<?php
    // Declarando variáveis para a conexão com o banco de dados
    $host = 'localhost';
    $password = '';
    $user = 'root';
    $dbname = 'projeto-harve';

    // Função para conectar com o banco de dados
    function dbConnect($host, $password, $user, $dbname,)
    {
        // Declarando as opções da conexão
        $pdoOptions = [
            PDO::ATTR_PERSISTENT => TRUE,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];
        
        // Fazebdo o if para caso apertem no botão submit, aplique a conexão com o banco de dados
        if(isset($_POST['submit'])) {
            try {
                $pdoConnect = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $user, $password, $pdoOptions);
            } catch(PDOException $exc) {
                echo $exc->getMessage();
                exit;
            }
        }
        
        // Retornando a variável da conexão com o banco de dados
        return $pdoConnect;
    }
    
    // Função para inserir para o banco de dados as informações enviadas
    function dbInsert($pdoConnect)
    {
        // Fazendo o if para caso apertem no botão submit, aplique a função abaixo
        if(isset($_POST['submit'])) {
            // Declarando as variáveis e pegando suas informações preenchidas no formulário
            $fullname = $_POST['fullname'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $pass1 = $_POST['pass1'];
            $pass2 = $_POST['pass2'];
            $address = $_POST['address'];
            $birthdate = $_POST['birthdate'];

            // Fazendo o if para caso as senhas inseridas não correspondam às exigências
            if(!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[a-zA-Z\d].\S{8,36}$/', $pass1) && !preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[a-zA-Z\d].\S{8,36}$/', $pass2)) {
                echo 'As senhas devem seguir os parâmetros: <br>
                    -Conter no mínimo 8 caracteres e no máximo 36; <br>
                    -Conter pelo menos 1 letra maiúscula e pelo menos 1 número; <br>
                    -Conter apenas letras e números, sem símbolos. <br>
                ';
                die;
            }

            // Fazendo o if para caso ambas as senhas sejam idênticas
            if($pass2 === $pass1) {
                // Fazendo o query para inserir as informações no banco de dados
                $sql = "
                    INSERT INTO
                        users (`name`,`username`,`email`,`password`,`address`,`birthdate`)
                    VALUES
                        (`:name`,`:username`,`:email`,`:password`,`:address`,`:birthdate`)
                ";

                // Preparando o query
                $query = $pdoConnect->prepare($sql);

                // Assegurando que os dados certos serão inseridos
                $ensure = [
                    $fullname => ':name',
                    $username => ':username',
                    $email => ':email',
                    $pass1 => ':password',
                    $address => ':address',
                    $birthdate => ':birthdate',
                ];

                // Procurando no banco de dados se algum email já foi cadastrado
                $search = "
                    SELECT
                        {$email}
                    FROM
                        users
                ";

                // Garantindo que o email foi ou não cadastrado
                if($email == $search) {
                    echo 'Esse email já está cadastrado! <br>';
                    die;
                }

                // Executando o query e armazenando isso numa variável
                $result = $query->execute($ensure);

                //Fazendo o if para caso a variável seja verdadeira, exibe uma mensagem, se não exibe outra
                if($result) {
                    echo 'Dados Salvos! <br>';
                } else {
                    echo 'Erro ao salvar! <br>';
                }
            } else {
                echo 'Ambas as senhas devem ser iguais <br>';
            }
        }

        // Retorna a variável
        return $result;
    }
?>