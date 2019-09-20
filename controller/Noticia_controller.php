<?php
//incluindo o modelo de Usuário com funções CRUD
include_once('model/Noticia_model.php');

$noticia = new Noticia_model();

if (isset($_REQUEST['acao'])) {
	switch ($_REQUEST['acao']) {
		case 'cadastrar_noticia':
			//passando os dados para o objeto
			$noticia->__set('titulo', $_POST['titulo']);
			$noticia->__set('conteudo', $_POST['conteudo']);

			// código para upload de arquivo
			$nome_arquivo = $_FILES['imagem']['name'];
			$destino = "../imagens/$nome_arquivo";
			$nome_tmp = $_FILES['imagem']['tmp_name'];

			move_uploaded_file($nome_tmp, $destino);

			$noticia->__set('imagem', $nome_arquivo);
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

		case 'excluir_not':
			$noticia->__set('cod_noticia', $_GET['codnoticia']);
			$noticia->excluir();
			echo "<script>window.location.href='cons_noticia.php';</script>";
		break;

		case 'atualizar_not':
			// passando os dados para o objeto
			$noticia->__set('titulo', $_POST['titulo']);
			$noticia->__set('autor', $_POST['autor']);
			$noticia->__set('data', $_POST['data']);
			$noticia->__set('conteudo', $_POST['conteudo']);
			$noticia->__set('cod_categoria', $_POST['categoria']);
			$noticia->__set('cod_noticia', $_POST['codnoticia']);
			// executando o método cadastrar
			$noticia->atualizar();
			// mensagem de confirmação
			echo "<script>
				alert('Dados atualizados com sucesso!');
				window.location.href = 'cons_noticia.php';
			</script>";
		break;

		case 'dados_not':
		$noticia->__set('cod_noticia', $_GET['codnoticia']);
		// preenche o objeto com dados de retorno
		$noticia = $noticia->retornarDados();
		break;
	}
}
?>
