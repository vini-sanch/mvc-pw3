<?php
    class Conexao
    {
        function conectar() {
            // Instanciando a conexão com o objeto PDO
            // driver: mysql
            // nome do banco: bdnoticia
            // usuário: root (padrão)
            // senha: "" (vazia)
            $conn = new PDO("mysql:host=localhost;dbname=bdnoticia", "root", "");
            // Configurando a exibição de erros com o banco de dados
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
    }
?>
