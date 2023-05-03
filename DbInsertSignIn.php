<?php
    // Estou meio confuso porque tudo o que tento não está dando certo, alguém me ajuda por favor

    // Fazendo o requerimento do arquivo
    require('SignIn.php');

    // Dando nome à classe e extendendo da classe Connection
    class Insert extends Connection
    {
        // Declarando as variáveis
        public $fullname = $_POST['fullname'];
        public $username = $_POST['username'];
        public $email = $_POST['email'];
        public $pass1 = $_POST['pass1'];
        public $pass2 = $_POST['pass2'];
        public $address = $_POST['address'];
        public $birthdate = $_POST['birthdate'];

        // Declarando a função para fazer o insert no banco de dados
        protected function sqlInsert($pdoConnect)
        {
            // Fazendo o if para caso apertem o botão submit do arquivo requerido
            if(isset($_POST['submit'])) {
                // Obrigando as senhas a terem um parâmetro a ser exercido
                $this->pass1 = preg_match('#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#', $this->pass1);
                $this->pass2 = preg_match('#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#', $this->pass2);

                // Fazendo o if para caso as senhas não cumpram os parâmetros e retorna os parâmetros necessários
                if (!preg_match('#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#', $this->pass1)) {
                    echo 'A senha deve seguir esses parâmetros: 
                    -Deve conter de 8 a 20 caracteres.
                    -Não deve conter símbolos, apenas letras e números.
                    -Deve conter pelo menos uma letra maiúscula e pelo menos um número.';
                }

                // Fazendo o if para caso as senhas sejam iguais, se não retorna uma mensagem
                if($this->pass1 === $this->pass2) {
                    // Passando os valores para o banco de dados
                    $sql = "
                        INSERT INTO
                            users (`name`,`username`,`email`,`address`,`password`,`birthdate`)
                        VALUES
                            (`:name`,`:username`,`:email`,`:address`,`:password`,`:birthdate`)
                    ";

                    // Preparando o query
                    $query = $pdoConnect->prepare($sql);

                    // Garantindo que os valores adicinados ao banco de dados sejam aqueles depositados nas variáveis
                    $ensure = [
                        $this->fullname => '`:name`',
                        $this->username => '`:username`',
                        $this->email => '`:email`',
                        $this->address => '`:address`',
                        $this->pass1 => '`:password`',
                        $this->birthdate => '`:birthdate`',
                    ];

                    // Executando o query
                    $query->execute($ensure);

                    // Fazendo a busca no banco de dados e fazendo o if para caso o email já esteja cadastrado
                    $search = "
                        SELECT
                            '$this->email'
                        FROM
                            users
                    ";

                    if($search === $this->email) {
                        echo 'Esse email já está cadastrado.';
                    }

                    // Fazendo o if para caso o query tenha dado certo, se não exibe uma mensagem de erro
                    if($query) {
                        echo 'Dados salvos!';
                    } else {
                        echo 'Erro!';
                    }
                } else {
                    echo 'Ambas as senhas devem ser iguais.';
                }
            }

            return $query;
        }
    }
?>