<?php
//incluindo o modelo de Usuário com funções CRUD
include_once('model/Noticia_model.php');

define('QTD_PAG', 3);

$noticia = new Noticia_model();
$noticias = [];

$inicio = isset($_GET['indice']) ? $_GET['indice'] * QTD_PAG : 0;

if (isset($_REQUEST['acao'])) {
	switch ($_REQUEST['acao']) {
		case 'cadastrar_noticia':
			//passando os dados para o objeto
			$noticia->__set('titulo', $_POST['titulo']);
			$noticia->__set('conteudo', $_POST['conteudo']);

			// código para upload de arquivo
			$nome_arquivo = $_FILES['imagem']['name'];
			$destino = "imagens/$nome_arquivo";
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
			$imagem_old = $_POST['imagem_old'];
			$imagem_new = isset($_FILES['imagem']) ? $_FILES['imagem']['name'] : "";

			if(empty($imagem_new)) $noticia->__set('imagem', $imagem_old);
			else {
				$destino = 'imagens/' . $imagem_new;
				$nome_tmp = $_FILES['imagem']['tmp_name'];

				move_uploaded_file($nome_tmp, $destino);
				unlink('imagens/' . $imagem_old);

				$noticia->__set('imagem', $imagem_new);
			}
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

		case 'filtrar':
			$total_paginas = ceil(count($noticia->consultar($_GET['codcategoria'])) / QTD_PAG);
			$noticias = $noticia->consultarLimit($inicio, QTD_PAG, $_GET['codcategoria']);
		break;
	}
}
else {
	$total_paginas = ceil(count($noticia->consultar()) / QTD_PAG);
	$noticias = $noticia->consultarLimit($inicio, QTD_PAG);
}
?>
