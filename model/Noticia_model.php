<?php
	class Noticia_model
	{
		private $cod_noticia;
		private $titulo;
		private $conteudo;
		private $data;
		private $autor;
		private $imagem;
		private $cod_categoria;
		private $conn;

		public function __construct()
		{
			include_once('./Conexao.php');
			$conn = new Conexao();
			$this->conn = $conn->conectar();
		}

		public function __set($field, $value)
		{
			$this->$field = $value;
		}

		public function __get($field)
		{
			return $this->$field;
		}

		// cadastra notícia
		public function cadastrar()
		{
			$sql_cmd = "INSERT INTO NOTICIA(TITULO, CONTEUDO, DATA, AUTOR, IMAGEM, CODCATEGORIA) VALUES(?, ?, ?, ?, ?, ?)";
			$exec = $this->conn->prepare($sql_cmd);
			$valores = [
				$this->titulo,
				$this->conteudo,
				$this->data,
				$this->autor,
				$this->imagem,
				$this->cod_categoria
			];
			$exec->execute($valores);
		}

		// exclui notícia
		public function excluir()
		{
			$sql_cmd = "DELETE FROM NOTICIA WHERE CODNOTICIA = ?";
			$exec = $this->conn->prepare($sql_cmd);
			$exec->execute($this->cod_noticia);
		}

		// atualiza notícia
		public function atualizar()
		{
			$sql_cmd = "UPDATE NOTICIA SET TITULO = ?, CONTEUDO = ?, DATA = ?, AUTOR = ?, IMAGEM = ?, CODCATEGORIA = ? WHERE CODNOTICIA = ?";
			$exec = $this->conn->prepare($sql_cmd);
			$valores = [
				$this->titulo,
				$this->conteudo,
				$this->data,
				$this->autor,
				$this->imagem,
				$this->cod_categoria,
				$this->cod_noticia
			];
			$exec->execute($valores);
		}

		// consulta de notícia
		public function consultar()
		{
			$sql_cmd = "SELECT * FROM NOTICIA";
			$exec = $this->conn->prepare($sql_cmd);
			$exec->execute();
			$dados = [];
			foreach ($exec->fetchAll() as $row) {
				$noticia = new Noticia_model();
				$noticia->__set('cod_noticia', $row['CODNOTICIA']);
				$noticia->__set('titulo', $row['TITULO']);
				$noticia->__set('conteudo', $row['CONTEUDO']);
				$noticia->__set('data', $row['DATA']);
				$noticia->__set('autor', $row['AUTOR']);
				$noticia->__set('imagem', $row['IMAGEM']);
				$noticia->__set('cod_categoria', $row['CODCATEGORIA']);
				$dados[] = $noticia;
			}
			return $dados;
		}
	}
?>
