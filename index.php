<?php
require_once("conexao.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="assets/imagens/logo.ico" type="image/x-icon">
	<title><?php echo $nome_sistema ?></title>
	<link rel="stylesheet" href="assets/css/nav.css">
</head>

<body>
	<div class="imagem">
		<p><?php echo $nome_sistema ?></p>
		<a href="login/index.php" title="Clique para ir para Login"><img src="assets/imagens/logo.png" alt="Home"></a>
	</div>
</body>

</html>