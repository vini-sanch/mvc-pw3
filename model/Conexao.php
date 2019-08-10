<?php 
    class Conexao
    {
        function conectar() {
            // Instanciando a conexão com o objeto PDO
            // driver: mysql
            // nome do banco: bdnoticia
            // usuário: root (padrão)
            // senha: "" (vazia)
            $conn = new PDO("mysql:host=localhost;dbname=bdnoticia",
                            "root",
                            "");
            return $conn;
        }
    }
    
?>
