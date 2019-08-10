<?php
    class Usuario_model
    {   
        // atributos da classe
        private $codusuario;
        private $nome;
        private $email;
        private $senha;
        private $nivel_acesso;

        //conexão
        private $conn;

        // métodos get e set (encapsulamento)
        public function __get($attr)
        {
            return $this->$attr;
        }

        public function __set($attr, $new_value)
        {
            $this->$attr = $new_value;
        }

        // acessando a conexão
        function __construct()
        {
            include_once("Conexao.php");
            $class_conn = new Conexao();
            $this->conn = $class_conn->conectar();
        }
        
        // método cadastrar
        public function cadastrar()
        {
            // string com o comando sql de inserção
            $sql_cmd = "INSERT INTO USUARIO (NOME, EMAIL, SENHA, NIVEL_ACESSO)
                        VALUES (?,?,?,?)";
            // valores a serem inseridos
            $valores = [
                $this->nome,
                $this->email,
                $this->senha,
                $this->nivel_acesso
            ];
            // função prepare substitui os parâmetros '?' pelos valores do array
            //   escapando possíveis injeções de código
            $exec = $this->conn->prepare($sql_cmd);
            // executa o código
            $exec->execute($valores);
        }

        // método consultar

        // método excluir

        // método atualizar
    }
?>
    