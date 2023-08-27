<?php
require_once("../../conexao.php");
require_once("verificar.php");
@session_start();
$id_cargo = $_SESSION['id_cargo_usuario'];
// VERIFICAR USUÁRIO LOGADO
$query = $pdo->query("SELECT * FROM cargos WHERE id = '$id_cargo'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_cargo = $res[0]['nome'];

if ($nome_cargo != 'Administrador') {
    echo "<script language='javascript'> window.location='../index.php' </script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAINEL ADMINISTRATIVO - <?php echo $nome_sistema ?></title>
    <link rel="shortcut icon" href="../../assets/imagens/logo.ico" type="image/x-icon">

    <link rel="stylesheet" href="../../assets/css/fontawesome.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/fontesEtitulos.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php"><i class="fa-solid fa-people-roof"></i> Administrador</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php"><i class="fa-solid fa-house-chimney"></i> Home <span class="sr-only">(página atual)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa-solid fa-money-bill-transfer"></i> Movimentações</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa-solid fa-user-check"></i> <?php echo $_SESSION['nome_usuario'] ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#"><i class="fa-solid fa-user-pen"></i> Editar Perfil</a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../logout.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a>
                    </div>
                </li>
            </ul>
            <form method="get" class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar" name="txtPesquisar">
                <button class="btn btn-primary my-2 my-sm-0" type="submit">Pesquisar <i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
    </nav>

    <h5>HOME</h5>
    <h6 style="text-align:center; color:gray">Funcionários</h6>

    <div class="container">
        <button class="btn btn-primary mb-2" type="button">Novo Funcionário</button>
        <small>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Cargo</th>
                        <th scope="col">Data Cadastro</thstyle=>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = $pdo->query("SELECT * FROM funcionarios ORDER BY id ASC");
                    $res = $query->fetchAll(PDO::FETCH_ASSOC);
                    $total_func = @count($res);

                    if ($total_func > 0) {
                        for ($i = 0; $i < @count($res); $i++) {
                            foreach ($res[$i] as $key => $value) {
                            }
                            $id_func = $res[$i]['id'];
                            $id_cargo = $res[$i]['cargo'];

                            //BUSCAR O NOME DO CARGO RELACIONADO AO ID NA TABELA CARGOS
                            $query2 = $pdo->query("SELECT * FROM cargos where id = '$id_cargo'");
                            $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                            $nome_cargo = $res2[0]['nome'];

                            $datacad = implode('/', array_reverse(explode('-', $res[$i]['datacad'])));
                            $datanasc = implode('/', array_reverse(explode('-', $res[$i]['datanasc'])));

                    ?>

                            <tr>
                                <td><?php echo $res[$i]['nome'] ?></td>
                                <td><?php echo $res[$i]['email'] ?></td>
                                <td><?php echo $res[$i]['cpf'] ?></td>
                                <td><?php echo $res[$i]['telefone'] ?></td>
                                <td><?php echo $nome_cargo ?></td>
                                <td><?php echo $datacad ?></td>

                                <td>
                                    <a href="" title="Editar Registro">
                                        <i class="fa-solid fa-pencil text-primary"></i></a>

                                    <a href="" title="Excluir Registro">
                                        <i class="fa-solid fa-trash-can text-danger"></i></a>

                                    <a href="" onclick="dados('<?php echo $res[$i]["nome"] ?>', '<?php echo $res[$i]["cep"] ?>', '<?php echo $res[$i]["rua"] ?>', '<?php echo $res[$i]["numero"] ?>', '<?php echo $res[$i]["bairro"] ?>', '<?php echo $res[$i]["cidade"] ?>', '<?php echo $res[$i]["estado"] ?>', '<?php echo $res[$i]["senha"] ?>', '<?php echo $res[$i]["imagem"] ?>', '<?php echo $datanasc ?>')" title="Ver Dados">
                                        <i class="fa-solid fa-circle-info text-secondary"></i></a>

                                </td>
                            </tr>

                    <?php
                        }
                    } else {
                        echo '<p>Não existem dados para serem exibidos!</p>';
                    }

                    ?>

                </tbody>
            </table>
        </small>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>