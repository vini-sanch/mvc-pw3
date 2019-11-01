<?php
    //incluindo o modelo de Usuário com funções CRUD
    include_once('model/Usuario_model.php');
    include_once('model/Email_model.php');

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
                echo "<script>
                        window.location.href = 'login.php';
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

            case 'enviar_email': 
                $email = $_POST['email'];
                $mailer = new Email_model();

                if(!empty($usuario->retornarDados($email))) {
                    // gerando a chave para autenticação
                    $token = md5(date('d-m-y H:m:s'));

                    // atualizando a chave no banco para a verificação

                    $usuario->__set('token', $token);
                    $usuario->__set('email', $email);
                    $usuario->atualizarToken();

                    $raiz = 'http://localhost/pw3-mvc';
                    $msg = "Olá, você esqueceu a sua senha? Por favor, siga o link a seguir: $raiz/login.php?acao=form_pass&token=$token&user=$email";
                    $msgHtml = "<p>Olá, você esqueceu a sua senha? Por favor, <a href='$raiz/login.php?acao=form_pass&token=$token&user=$email'>clique aqui</a><p>";

                    /* Informações do E-mail */
                    $mailer->__set('destinatario', $email);
                    $mailer->__set('mensagem', $msg);
                    $mailer->__set('mensagemHTML', $msgHtml);
                    $mailer->__set('assunto', 'Requisição de Mudança de Senha');

                    // enviando o e-mail
                    $failed = $mailer->sendMail();
                    if (!empty($failed)) {
                        echo "<script>alert('Ocorreu algum erro: \n " . $failed . " ');</script>";
                    } else {
                        echo "<script>alert('E-mail enviado com sucesso!');</script>";
                    }

                    echo "<script>window.location.href = 'login.php'</script>";
                }
                else {
                    echo "<script>alert('E-mail não encontrado!');</script>";
                }
            break;

            case 'reset_senha':
                $senha = $_POST['senha'];
                $confirmar = $_POST['confirmar'];
                $email = $_POST['user'];
                $token = $_POST['token'];

                $user = $usuario->retornarDados($email);
                if(!empty($user)) {
                    
                    if($token == $user->__get('token')) {
                        
                        if($senha == $confirmar) {
                            // passando os dados para o objeto
                            $usuario->__set('nome', $user->__get('nome'));
                            $usuario->__set('senha', $senha);
                            $usuario->__set('email', $email);
                            $usuario->__set('nivel_acesso', $user->__get('nivel_acesso'));
                            $usuario->__set('codusuario', $user->__get('codusuario'));
                            // executando o método cadastrar
                            $usuario->atualizar();

                            echo "<script>alert('Senha Atualizada!');</script>";
                        }
                        else {
                            echo "<script>alert('Senhas Distintas!');</script>";
                        }
                    }
                    else {
                        echo "<script>alert('Token Inválido!');</script>";
                    }

                    /* Atualizar o token para null */
                    $usuario->__set('token', null);
                    $usuario->__set('email', $email);
                    $usuario->atualizarToken();
                }
                else {
                    echo "<script>alert('Usuário não encontrado!');</script>";
                }
                
                echo "<script>window.location.href = 'login.php'</script>";
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

    function autenticar($tipo = true)
    {
        $usuario = $_SESSION['cod_logado'];

        if(!isset($usuario)) {
            echo "<script>
                window.location.href = 'login.php';
            </script>";
        }

        if($tipo) {
            if($_SESSION['nivel_logado'] == 2) {
                return false;
            }
            else {
                return true;
            }
        }
    }

    function valida_tentativa() {
        session_start();
        $numero_tentativas = isset($_SESSION['num_try']) ? $_SESSION['num_try'] : 0;
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
