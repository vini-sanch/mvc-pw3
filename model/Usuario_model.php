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
                // função nativa do php para encriptação (gera 40 caracteres criptografados)
                // há também a função md5 (gera 32 caracteres)
                sha1($this->senha),
                $this->nivel_acesso
            ];
            // função prepare substitui os parâmetros '?' pelos valores do array
            // escapando possíveis injeções de código
            $exec = $this->conn->prepare($sql_cmd);
            // executa o código
            $exec->execute($valores);
        }

        // método consultar
        public function consultar()
        {
            // comando de consulta da tabela usuario
            $sql_cmd = 'SELECT * FROM usuario';
            $exec = $this->conn->prepare($sql_cmd);
            $exec->execute();

            // vetor que receberá os dados
            $result = [];
            // laço de repetição para armazenar os dados no vetor
            // fetchAll transforma o retorno da query em uma matriz
            foreach ($exec->fetchAll() as  $row) {
                // instanciando um objeto desta classe
                $user = new Usuario_model();
                // atribuindo valores aos atributos o objeto de acordo com o retorno do banco
                $user->codusuario = $row['CODUSUARIO'];
                $user->nome = $row['NOME'];
                $user->email = $row['EMAIL'];
                $user->senha = $row['SENHA'];
                $user->nivel_acesso = $row['NIVEL_ACESSO'];
                // preenchendo o vetor dos resultados
                $result[] = $user;
            }
            // retornando o vetor com os objetos
            return $result;
        }

        // método excluir
        public function excluir()
        {
            // comando de exclusão de registro da tabela usuário
            $sql_cmd = 'DELETE FROM usuario WHERE CODUSUARIO = ?';
            $exec = $this->conn->prepare($sql_cmd);
            $valores = [
                $this->codusuario
            ];
            // passando o 'codusuario' como parâmetro (ele é a chave primária do registro)
            $exec->execute($valores);
        }

        // método atualizar
        public function atualizar()
        {
            // comando de atualização da tabela usuário
            $sql_cmd = 'UPDATE usuario SET NOME = ?, EMAIL = ?, SENHA = ?, NIVEL_ACESSO = ? WHERE CODUSUARIO = ?';
            $exec = $this->conn->prepare($sql_cmd);

            // passando os atributos como parâmetros
            $valores = [
                $this->nome,
                $this->email,
                sha1($this->senha),
                $this->nivel_acesso,
                $this->codusuario
            ];
            //executando
            $exec->execute($valores);
        }
    }
?>
