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
            $exec->execute([$this->cod_categoria]);
        }

        public function num_noticias()
		{
            // declarando o array de retorno
            $dados = [];
            $sql_cmd = "SELECT COUNT(CODNOTICIA) AS TOTAL FROM noticia WHERE CODCATEGORIA = ?";
            $exec = $this->conn->prepare($sql_cmd);
            $exec->execute([$this->cod_categoria]);

            $numero = $exec->fetch();

            return $numero['TOTAL'];
        }

        // consulta de categoria
        public function retornarDados()
        {
            // executando o comando
            $sql_cmd = "SELECT * FROM categoria WHERE CODCATEGORIA = ?";
            $exec = $this->conn->prepare($sql_cmd);
            $exec->execute([$this->cod_categoria]);

            $row = $exec->fetch();
            
            $categoria = new Categoria_model();
            $categoria->__set('cod_categoria', $row['CODCATEGORIA']);
            $categoria->__set('nome_categoria', $row['NOMECATEGORIA']);

            return $categoria;
        }

        // consulta de categoria
        public function consultar(array $condicao = null)
        {
            // declarando o array de retorno
            $dados = [];

            if(isset($condicao)) {
                // executando o comando
                $sql_cmd = "SELECT * FROM categoria WHERE CODCATEGORIA = ?";
                $exec = $this->conn->prepare($sql_cmd);
                $exec->execute($condicao);
            }
            else {
                $sql_cmd = "SELECT * FROM categoria";
                $exec = $this->conn->prepare($sql_cmd);
                $exec->execute();
            }

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
