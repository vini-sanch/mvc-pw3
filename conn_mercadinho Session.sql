-- -- CONSULTA MERCADINHO:
-- -- devolver os possíveis kits da promoção (p. limpeza bem avaliado + alimento p/ validade)
-- -- p. limpeza bem avaliado == média de avaliações > 70%;
-- -- alimento proximo do vencimento == now() - data_validade
-- -- selecionar os campos: nome do p. limpeza, nome do alimento
-- -- 		preço do kit, lucro do kit e data de validade do kit
-- -- preço do kit: 15% de desconto da soma do (preco do alimento + preco do p. limpeza)
-- -- lucro do kit: preço do kit - (soma dos custos do alimento e p. limpeza)
-- -- data de validade do kit: menor data de validade dos dois produtos;
-- -- ESTRUTURA DA CONSULTA:
-- -- primeiro consultamos os dados necessários de cada tabela separadamente
-- -- depois juntamos esses dados nos itens requeridos com o CROSS JOIN (comando que permuta/cruza dados entre duas ou mais tabelas)
-- select principal pega os dados das duas subconsultas realizadas no FROM, uma chamada 'ali' e a outra chamada 'produto'
SELECT
  ali.nome, -- nome do alimento
  produto.nome, -- nome do produto de limpeza
  0.85 * (ali.preco + produto.preco) as 'preco_kit', -- soma dos preços dos itens
  ((0.85 * (ali.preco + produto.preco)) - (ali.custo + produto.custo)) as 'lucro_kit', -- preço dos itens - a soma dos custos dos itens
  LEAST(produto.data_validade, ali.data_validade) as 'data_validade_kit' -- função que retorna a menor das duas datas
FROM
  -- primera subconsulta (ou subquery) ela produz uma tabela com as colunas da select abaixo, chamada 'ali', que são referentes a tabela alimentos e elemento_estoque
  (
    SELECT
      a.nome, -- nome do alimento
      a.data_validade, -- data de validade do alimento
      el.custo, -- custo do alimento (pego na tabela elemento_estoque)
      el.preco -- preço do alimento (pego na tabela elemento_estoque)
    FROM
	-- junção da tabela elemento_estoque com a tabela alimento e com a tabela estoque, a primeira junção para captar os dados necessários e a segunda para não selecionar os registros que tem quantidade 0 em estoque
      elemento_estoque as el
      INNER JOIN alimento as a ON el.id = a.id_elemento_estoque
      INNER JOIN estoque ON el.id = estoque.id_elemento_estoque
	-- Datediff calcula, em dias, a diferença entre duas datas
	-- seleciona apenas os registros cuja validade está entre 1 e 5 dias de vencimento
	--a segunda condição selciona os registros cuja quantidade em estoque está maior que 0
    WHERE (DATEDIFF(a.data_validade, NOW()) BETWEEN 1 AND 5)
      	  AND estoque.quantidade > 0
  ) as ali -- apelido para esta subquery (obrigatório para conseguirmos captar os atributos retornados por ela)
  -- CROSS JOIN - comando que faz a permutação entre os elementos da subconsulta acima com os elementos da subconsulta abaixo
  CROSS JOIN (
	-- segunda subconsulta (ou subquery) ela produz uma tabela com as colunas da select abaixo, chamada 'produto', que são referentes a tabela produto_limpeza e elemento_estoque
    SELECT
      p.nome, -- nome do produto de limpeza
      p.data_validade, -- data de validade do produto de limpeza
      elemento.custo, -- custo do produto de limpeza
      elemento.preco -- preço do produto de limpeza
    FROM
	  -- Aqui há dois inner joins principais, o primeiro relaciona a tabela produtos de limpeza com a tabela de pesquisas de mercado, para que seja feita a seleção apenas dos produtos bem avaliados. 
	  -- o segundo será feito com o resultado de uma outra subconsulta que chama uma tabela com os dados da quantidade do produto em estoque, mais os valores de custo e preço da tabela elemento_estoque
      produto_limpeza as p -- apelido da tabela produto_limpeza, 'p'
      INNER JOIN pesquisa_mercado ON pesquisa_mercado.id_produto_limpeza = p.id
      INNER JOIN (
		-- terceira subquery (ou subquery de uma subquery), esta subconsulta só existe pq é necessário juntar a tabela estoque e elemento_estoque antes de juntar com a tabela produto_limpeza, isso porque a tabela produto_limpeza precisa ser unida a pesquisa_mercado, a estoque e a elemento_estoque, porém ela não tem relação com estoque, por isso, primeiro se faz uma select capturando as colunas da tabela elemento_estoque e estoque
        SELECT
          estoque.quantidade, -- quantidade em estoque
          elemento_estoque.preco, -- preço em estoque
          elemento_estoque.id, -- id do elemento_estoque (necessário para fazer o inner join acima)
          elemento_estoque.custo -- custo do produto em estoque
        FROM
          elemento_estoque
          INNER JOIN estoque ON estoque.id_elemento_estoque = elemento_estoque.id -- inner join da tabela estoque com elemento_estoque
      ) as elemento ON elemento.id = p.id_elemento_estoque -- inner join da tabela retornada pela subquery com a tabela produto_limpeza, através do id da tabela elemento_estoque que foi referenciada pelo alias/apelido 'elemento'
    WHERE
	-- a partir do retorno acima são filtrados apenas os produtos dentro da validade e com quantidade em estoque
      DATEDIFF(p.data_validade, NOW()) > 0
      AND elemento.quantidade > 0
	  -- o group by serve para agrupar a média de satisfação dos produtos de limpeza pelo id do produto de limpeza, caso contrária a média é feita com todos os registros de pesquisa de todos os produtos
    GROUP BY id_produto_limpeza
	-- Having está aqui, pois temos de filtrar os registros pelo resultado de uma função de agrupamento (AVG - média aritmética). Ele seleciona apenas os que tem média de satisfação > 70% 
    HAVING AVG(pesquisa_mercado.satisfacao) > 70) as produto
-- Por fim, após o retorno de tudo, os registros são ordenados decrescentemente pelo lucro do kit, que já foi calculado acima e tem o apelido/alias 'lucro_kit'
ORDER BY lucro_kit DESC;
