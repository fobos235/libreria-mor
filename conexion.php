<?php
    define('BASE_URL','http://alpha-lib.test/');
    
    define('MERCADO_PAGO_PKEY','TEST-ef2935ec-4d29-4afc-9d7d-0dbbc828b358');
    define('MERCADO_PAGO_TOKEN','TEST-2027324426363868-060815-b72ac65e2e4ba5a92b816c7eb3fa5235-261246800');



    class Conecta{
        private $server = "mysql:host=localhost;dbname=libreria";
        private $username = "root";
        private $password = '';
        private $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
        public $conn;

        public function open(){
            try{
                $this->conn = new PDO($this->server, $this->username, $this->password, $this->options);
                return $this->conn;
            }catch(PDOException $e){
                echo "Ocurrió un error PDO en la conexión". $e->getMessage();
            }
        }

        public function close(){
            $this->conn = null;
        }
    }

?>