<?php
    //incluindo o modelo de Usuário com funções CRUD
    include_once('model/Usuario_model.php');
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

            case 'logar_usu':
                valida_tentativa();
                $usuario->__set('email', $_POST['email']);
                $usuario->__set('senha', $_POST['senha']);
                $usuario = $usuario->logar();

                if(empty($usuario->__get('codusuario'))) {
                    echo "<script>
                        alert('Usuário Não Encontrado!');
                    </script>";
                }
                else {
                    session_start();
                    $_SESSION['cod_logado'] = $usuario->__get('codusuario');
                    $_SESSION['nome_logado'] = $usuario->__get('nome');
                    $_SESSION['nivel_logado'] = $usuario->__get('nivel_acesso');
                    echo "<script>
                        window.location.href = 'index.php';
                    </script>";
                }
            break;

            case 'sair':
                session_start();
                session_destroy();
                echo "<script>
                    window.location.href = 'login.php';
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

            case 'confirmar_captcha':
                $tentativa = $_POST['tentativa'];
                $resultado = $_POST['resultado'];

                if($tentativa == $resultado) {
                    session_start();
                    session_unset('captcha');
                    echo "<script>
                                window.location.href = 'login.php';
                            </script>";
                }
                else{
                    echo "<script>
                        alert('Por favor, tente novamente!');
                    </script>";
                }
            break;
        }
    }

    function valida_tentativa() {
        session_start();
        $numero_tentativas = $_SESSION['num_try'];
        $numero_tentativas++;

        if($numero_tentativas >= 3) {
            $_SESSION['num_try'] = 0;
            $_SESSION['captcha'] = true;
            echo "<script>
                    window.location.href = 'captcha.php';
                </script>";
        }

        $_SESSION['num_try'] = $numero_tentativas;
    }
    
?>
