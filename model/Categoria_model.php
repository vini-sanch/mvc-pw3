<?php
    class Categoria_model
    {
        private $cod_categoria;
        private $nome_categoria;
        private $conn;

        //métodos de acesso
        public function __set($attr, $new_value)
        {
            $this->$attr = $new_value;
        }

        public function __get($attr)
        {
            return $this->$attr;
        }

        // acessando a conexão
        function __construct()
        {
            include_once('Conexao.php');
            $classe_conn = new Conexao();
            $this->conn = $classe_conn->conectar();
        }

        //cadastrar categoria
        public function cadastrar()
        {
            $sql_cmd = "INSERT INTO CATEGORIA (NOMECATEGORIA) VALUES(?)";
            $values = [
                $this->nome_categoria
            ];
            $exec = $this->conn->prepare($sql_cmd);
            $exec->execute($values);
        }
    }
    
?>
