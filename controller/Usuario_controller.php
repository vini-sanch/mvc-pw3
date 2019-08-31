<?php
    //incluindo o modelo de Usuário com funções CRUD 
    include_once('../model/Usuario_model.php');

    $usuario = new Usuario_model();

    if(isset($_REQUEST['acao'])) {
        switch ($_REQUEST['acao']) {
            case 'cadastrar_usu':
                //passando os dados para o objeto
                $usuario->__set('nome', $_POST['nome']);
                $usuario->__set('email', $_POST['email']);
                $usuario->__set('senha', $_POST['senha']);
                $usuario->__set('nivel_acesso', $_POST['nivel_acesso']);
                //executando o método cadastrar
                $usuario->cadastrar();
                //mensagem de confirmação
                echo "<script>
                    alert('Dados gravados com sucesso!');
                    window.location.href = 'cad_usuario.php';
                </script>";
            break;
            case 'excluir_usu':
                $usuario->__set('codusuario', $_GET['codusuario']);
                $usuario->excluir();
                echo "<script>window.location.href='cons_usuario.php';</script>";
            break;
            case 'atualizar_usu':
                // passando os dados para o objeto
                $usuario->__set('nome', $_POST['nome']);
                $usuario->__set('email', $_POST['email']);
                $usuario->__set('senha', $_POST['senha']);
                $usuario->__set('nivel_acesso', $_POST['nivel_acesso']);
                $usuario->__set('codusuario', $_POST['codusuario']);
                // executando o método cadastrar
                $usuario->atualizar();
                // mensagem de confirmação
                echo "<script>
                    alert('Dados atualizados com sucesso!');
                    window.location.href = 'cons_usuario.php';
                </script>";
            break;
            case 'dados_usu':
            $usuario->__set('codusuario', $_GET['codusuario']);
            // preenche o objeto com dados de retorno
            $usuario = $usuario->retornarDados();
            break;
        }
    }
    
?>
