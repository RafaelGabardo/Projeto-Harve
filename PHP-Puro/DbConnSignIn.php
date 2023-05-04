<?php
    // Alguma coisa está dando errado, não sei se na conexão com o banco de dados ou se no arquivo de inserção, preciso de ajuda

    // Fazendo o requerimento do arquivo
    require('HTML-CSS/SignIn.php');

    // Declarando o nome da classe
    class Connection
    {
        // Declarando as variáveis
        private $host = 'localhost';
        private $password = 'root';
        private $user = 'root';
        private $dbname = 'projeto-harve';
        protected $pdoConnect;
    
        // Declarando a função para construir a conexão com o banco de dados
        public function __construct()
        {
            // Declaranco as opções da conexão PDO
            $pdoOptions = [
                PDO::ATTR_PERSISTENT => TRUE,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ];
            
            // Fazendo o if para caso o botão seja apertado, faça a conexão com o banco de dados
            if(isset($_POST['submit'])) {
                // Fazendo a função try para tentar a conexão com o banco de dados via método PDO e retornando erro caso dê errado
                try {
                    $this->pdoConnect = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname, $this->user, $this->password, $pdoOptions);
                } catch(PDOException $exc) {
                    echo $exc->getMessage();
                    exit;
                }
            }
        }
    }
?>