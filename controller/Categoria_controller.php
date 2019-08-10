<?php
    //incluindo o modelo de Usuário com funções CRUD 
    include_once('../model/Categoria_model.php');

    $categoria = new Categoria_model();

    if(isset($_REQUEST['acao'])) {
        switch ($_REQUEST['acao']) {
            case 'cadastrar_categoria':
                //passando os dados para o objeto
                $categoria->__set('nome_categoria', $_POST['categoria']);
                //executando o método cadastrar
                $categoria->cadastrar();
                //mensagem de confirmação
                echo "<script>
                    alert('Dados gravados com sucesso!');
                    window.location.href = 'cad_categoria.php';
                </script>";
            break;
        }
    }
    
?>
