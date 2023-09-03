<?php 
@session_start();
echo @$_SESSION['nome_usuario'];   
$nome = @$_SESSION['nome_usuario'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h6>HOME</h6>
    <p><?php echo 'Nome -' .$nome ?></p>
</body>
</html>