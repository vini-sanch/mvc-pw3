<?php
//incluindo o modelo de Usuário com funções CRUD
include_once('../model/Noticia_model.php');

$noticia = new Noticia_model();

if (isset($_REQUEST['acao'])) {
	switch ($_REQUEST['acao']) {
		case 'cadastrar_noticia':
			//passando os dados para o objeto
			$noticia->__set('titulo', $_POST['titulo']);
			$noticia->__set('conteudo', $_POST['conteudo']);
			$noticia->__set('imagem', $_POST['imagem']);
			$noticia->__set('autor', $_POST['autor']);
			$noticia->__set('cod_categoria', $_POST['categoria']);
			$noticia->__set('data', $_POST['data']);
			//executando o método cadastrar
			$noticia->cadastrar();
			//mensagem de confirmação
			echo "<script>
                    alert('Dados gravados com sucesso!');
                    window.location.href = 'cad_noticia.php';
                </script>";
			break;
	}
}
?>
