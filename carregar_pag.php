<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title></title>
</head>
<body>

	<div id="conteudo">
	</div>

	<button id="carregar_mais" pagina=1 class="btn btn-info">Ver Mais</button>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<script>
		$(document).ready(() => {
			$('#carregar_mais').click(() => {
				var nextPag = $('#carregar_mais').attr('pagina')
				console.log(nextPag)

				$.ajax({
					url: 'conteudo.php',
					data: {indice:nextPag},
					type: 'GET',

					success: (response) => {
						$('#conteudo').append(response)
					},

					complete: () => {
						$('#carregar_mais').attr('pagina', parseInt(nextPag) + 1);
					},

					error: (reject) => {
						console.log(reject)
					}
				})
			});

			$.ajax({
				url: 'conteudo.php',
				data: {indice:0},
				type: 'GET',

				success: function(response) {
					$('#conteudo').html(response);
				},
				error: function(reject) {
					console.log(reject);
				}
			});
		});
	</script>
</body>
</html>