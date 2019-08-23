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

        // deletar categoria
        public function excluir()
        {
            $sql_cmd = "DELETE FROM CATEGORIA WHERE CODCATEGORIA = ?";
            $exec = $this->conn->prepare($sql_cmd);
            $exec->execute($this->cod_categoria);
        }

        // consulta de categoria
        public function consultar()
        {
            // executando o comando
            $sql_cmd = "SELECT * FROM CATEGORIA";
            $exec = $this->conn->prepare($sql_cmd);
            $exec->execute();

            // declarando o array de retorno
            $dados = [];

            //executando o comando
            foreach($exec->fetchAll() as $row) {
               // instância para armazenar os objetos na array
                $categoria = new Categoria_model();
                $categoria->__set('cod_categoria', $row['CODCATEGORIA']);
                $categoria->__set('nome_categoria', $row['NOMECATEGORIA']);
                $dados[] = $categoria;
            }

            return $dados;
        }

        // atualização de categoria
        public function atualizar()
        {
            $sql_cmd = "UPDATE CATEGORIA SET NOMECATEGORIA = ? WHERE CODCATEGORIA = ?";
            $exec = $this->conn->prepare($sql_cmd);
            $valores = [
                $this->nome_categoria,
                $this->cod_categoria
            ];
            $exec->execute($valores);
        }
    }
?>
