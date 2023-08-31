<?php
require_once("../conexao.php");
require_once("verificar.php");
@session_start();
$id_usu = $_SESSION['id_usuario'];
$id_cargo = $_SESSION['id_cargo_usuario'];
@$funcao = $_GET['funcao'];

// VERIFICAR ID DO USUÁRIO LOGADO
$query1 = $pdo->query("SELECT * FROM funcionarios WHERE id = '$id_usu' ");
$res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
$nome_usu = $res1[0]['nome'];

// VERIFICAR CARGO DO USUÁRIO LOGADO
$query = $pdo->query("SELECT * FROM cargos WHERE id = '$id_cargo'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_cargo = $res[0]['nome'];

if ($nome_cargo != 'Administrador') {
    echo "<script language='javascript'> window.location='../index.php' </script>";
}

?>

<!DOCTYPE html>
<html lang="pt-br,
">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAINEL ADMINISTRATIVO - <?php echo $nome_sistema ?></title>
    <link rel="shortcut icon" href="../assets/imagens/logo.ico" type="image/x-icon">

    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/fontesEtitulos.css">

    <script src="../assets/js/buscaCep.js" type="module" defer></script>

    <link rel="stylesheet" href="../assets/DataTables/datatables.min.css">
    <script src="../assets/DataTables/datatables.min.js"></script>

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
                    <a class="nav-link" href="index.php"><i class="fa-solid fa-house-chimney"></i> Home <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa-solid fa-users"></i> Usuários</a>
                </li>

            </ul>
            <form method="get" class="form-inline my-2 my-lg-0">
                
                <ul>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            <i class="fa-solid fa-address-card"></i> <?php echo $nome_usu ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">


                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../logout.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a>
                        </div>
                    </li>   
                </ul>

                <img class="img-profile rounded-circle mt-1 mr-2" src="../assets/imagens/funcionarios/eu-II jpeg.jpg" width="40px" height="40px">

            </form>
        </div>

    </nav>

    <h5>HOME</h5>

    <h6 style="text-align:center; color:gray">Funcionários</h6>

    <div class="container">
        <a href="index.php?funcao=novo"><button class="btn btn-primary mb-2" type="button">Novo</button></a>

        <?php
        @$txtPesquisar = '%' . $_GET['txtPesquisar'] . '%';

        $query = $pdo->prepare("SELECT * FROM funcionarios WHERE nome LIKE :nome OR email LIKE :email OR cpf LIKE :cpf OR telefone LIKE :telefone OR datacad LIKE :datacad ORDER BY id ASC");
        $query->bindValue(":nome", $txtPesquisar);
        $query->bindValue(":email", $txtPesquisar);
        $query->bindValue(":cpf", $txtPesquisar);
        $query->bindValue(":telefone", $txtPesquisar);
        $query->bindValue(":datacad", $txtPesquisar);
        $query->execute();
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        $total_func = @count($res);

        if ($total_func > 0) {

        ?>

            <small namespace="funcionarios">
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
                                    <a href="index.php?funcao=editar&id=<?php echo $id_func ?>" title="Editar Registro">
                                        <i class="fa-solid fa-pencil text-primary"></i></a>

                                    <a href="index.php?funcao=excluir&id=<?php echo $id_func ?>" title="Excluir Registro">
                                        <i class="fa-solid fa-trash-can text-danger"></i></a>

                                    <a href="" onclick="dados('<?php echo $res[$i]["nome"] ?>', '<?php echo $res[$i]["cep"] ?>', '<?php echo $res[$i]["rua"] ?>', '<?php echo $res[$i]["numero"] ?>', '<?php echo $res[$i]["bairro"] ?>', '<?php echo $res[$i]["cidade"] ?>', '<?php echo $res[$i]["estado"] ?>', '<?php echo $res[$i]["senha"] ?>', '<?php echo $res[$i]["imagem"] ?>', '<?php echo $datanasc ?>')" title="Ver Dados">
                                        <i class="fa-solid fa-circle-info text-secondary"></i></a>

                                </td>
                            </tr>

                    <?php
                        }
                    } else {
                        echo '<p style="text-align:center">Não existem dados para serem exibidos!</p>';
                    }

                    ?>

                    </tbody>
                </table>
            </small>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <!-- Mascaras JS -->
    <script type="text/javascript" src="../assets/js/mascaras.js"></script>

    <!-- Ajax para funcionar Mascaras JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

</body>

</html>

<!-- MODAL CADASTRO/EDIÇÃO DE FUNCIONÁRIOS -->
<div class="modal fade bd-example-modal-lg" id="novoFuncionario" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <?php
                if (@$_GET['funcao'] == 'editar') {
                    $titulo_modal = "Editar Registro";
                    $botao_modal = "btn-editar";
                    $queryEd = $pdo->query("SELECT * FROM funcionarios WHERE id = '$_GET[id]'");
                    $resEd = $queryEd->fetchAll(PDO::FETCH_ASSOC);
                } else {
                    $titulo_modal = "Inserir Registro";
                    $botao_modal = "btn-cadastrar";
                }
                ?>
                <h5 class="modal-title"><?php echo $titulo_modal ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="form" name="frmFunc">
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="exampleFormControlName" class="form-label">Nome </label>
                                    <input type="text" class="form-control" id="nome" value="<?php echo @$resEd[0]['nome'] ?>" name="nome" placeholder="Nome" autofocus required tabindex="1">
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="exampleFormControlCpf" class="form-label">CPF </label>
                                    <input type="text" class="form-control" id="cpf" value="<?php echo @$resEd[0]['cpf'] ?>" name="cpf" placeholder="CPF" required tabindex="2">
                                </div>
                            </div>

                            <div class="col-5">
                                <div class="mb-3">
                                    <label for="exampleFormControlEmail" class="form-label">Email </label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="nome@exemplo.com" value="<?php echo @$resEd[0]['email'] ?>" required tabindex="3">
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="exampleFormControlTelefone" class="form-label">Telefone </label>
                                    <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(xx)xxxx-xxxx" value="<?php echo @$resEd[0]['telefone'] ?>" required tabindex="4">
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="exampleFormControlCep" class="form-label">CEP </label>
                                    <input type="text" class="form-control" id="cep" name="cep" placeholder="CEP" value="<?php echo @$resEd[0]['cep'] ?>" tabindex="5">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlRua" class="form-label">Rua </label>
                                    <input type="text" class="form-control" id="rua" name="rua" placeholder="Rua" value="<?php echo @$resEd[0]['rua'] ?>" readonly>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="exampleFormControlNumero" class="form-label">Número </label>
                                    <input type="text" class="form-control" id="numero" name="numero" value="<?php echo @$resEd[0]['numero'] ?>" placeholder="Número" tabindex="6">
                                </div>
                            </div>

                            <div class="col-5">
                                <div class="mb-3">
                                    <label for="exampleFormControlBairro" class="form-label">Bairro </label>
                                    <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro" value="<?php echo @$resEd[0]['bairro'] ?>" readonly>
                                </div>
                            </div>

                            <div class="col-5">
                                <div class="mb-3">
                                    <label for="exampleFormControlCidade" class="form-label">Cidade </label>
                                    <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade" value="<?php echo @$resEd[0]['cidade'] ?>" readonly>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="exampleFormControlEstado" class="form-label">Estado </label>
                                    <input type="text" class="form-control" id="estado" name="estado" value="<?php echo @$resEd[0]['estado'] ?>" placeholder="UF" readonly>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="exampleFormControlSenha" class="form-label">Senha </label>
                                    <input type="text" class="form-control" id="senha" name="senha" placeholder="Senha" value="<?php echo @$resEd[0]['senha'] ?>" required tabindex="7">
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="exampleFormControlNascimento" class="form-label">Data Nascimento </label>
                                    <input type="date" class="form-control" id="datanasc" name="datanasc" placeholder="Nascimento" value="<?php echo @$resEd[0]['datanasc'] ?>" required tabindex="8">
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Cargo </label>
                                    <select class="form-select" aria-label="Default select example" name="cargo" tabindex="9">
                                        <?php
                                        $query = $pdo->query("SELECT * FROM cargos ORDER BY nome ASC");
                                        $res = $query->fetchAll(PDO::FETCH_ASSOC);
                                        for ($i = 0; $i < @count($res); $i++) {
                                            foreach ($res[$i] as $key => $value) {
                                            }
                                            $id_cargo = $res[$i]['id'];
                                            $nome_cargo = $res[$i]['nome'];
                                        ?>
                                            <option <?php if (@$id_cargo == @$resEd[0]['cargo']) { ?> selected <?php } ?> value="<?php echo $id_cargo ?>"><?php echo $nome_cargo ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                            </div>

                        </div>

                        <div class="form-group">
                            <label>Imagem</label>
                            <input type="file" value="<?php echo @$resEd[0]['imagem'] ?>" class="form-control-file" id="imagem" name="imagem" onChange="carregarImg();">
                        </div>

                        <div id="divImgConta" class="mt-4">
                            <?php if (@$resEd[0]['imagem'] != "") { ?>
                                <img src="../assets/imagens/fucionarios/<?php echo @$resEd[0]['imagem'] ?>" width="170px" id="target">
                            <?php  } else { ?>
                                <img src="../assets/imagens/funcionarios/sem-foto.jpg" width="170px" id="target" alt="Foto Funcionario">

                            <?php } ?>
                        </div>

                        <input type="text" name="id" value="<?php echo @$id ?>">

                        <small>
                            <div align="center" id="mensagem">
                            </div>
                        </small>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

                        <button type="submit" class="btn btn-primary" name="<?php echo $botao_modal ?>">Salvar</button>

                        <input type="hidden" value="<?php echo @$_GET['id'] ?>">

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- FIM MODAL CADASTRO/EDIÇÃO DE FUNCIONÁRIOS -->

<!-- Modal Excluir Cliente -->
<div class="modal fade" id="excluir" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <?php
                $queryEd = $pdo->query("SELECT * FROM funcionarios WHERE id = '$_GET[id]'");
                $resEd = $queryEd->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <h5 class="modal-title"> Excluir</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body">

                    Tem certeza que quer excluir <?php echo $resEd[0]['nome'] ?>?

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

                    <button type="submit" class="btn btn-danger" name="btn-excluir">Excluir</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Fim Modal Excluir Cliente -->

<!-- Modal Dados -->
<div class="modal fade" id="modal-dados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nome_registro"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <div class="mb-2">
                    <img src="" id="imagem_registro" width="50%">
                </div>

                <div class="mb-2">
                    <span><b>CEP : </b></span><span id="cep_registro"></span>
                </div>

                <div class="mb-2">
                    <span><b>Rua : </b></span><span id="rua_registro"></span>
                </div>

                <div class="mb-2">
                    <span><b>Nº : </b></span><span id="numero_registro"></span>
                </div>

                <div class="mb-2">
                    <span><b>Bairro : </b></span><span id="bairro_registro"></span>
                </div>

                <div class="mb-2">
                    <span><b>Cidade : </b></span><span id="cidade_registro"></span>
                </div>

                <div class="mb-2">
                    <span><b>Estado : </b></span><span id="estado_registro"></span>
                </div>

                <div class="mb-2">
                    <span><b>Senha : </b></span><span id="senha_registro"></span>
                </div>

                <div class="mb-2">
                    <span><b>Data Nascimento : </b></span><span id="data_nasc_registro"></span>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<!--Fim Modal Dados -->

<!-- CHAMA MODAL NOVO -->
<?php
if ($funcao == 'novo') { ?>
    <script>
        var myModal = new bootstrap.Modal(document.getElementById('novoFuncionario'));{
            backdrop: 'static'
        }
        myModal.show();
    </script>
<?php }
?>
<!-- FIM CHAMA MODAL NOVO -->

<!-- Script Cadastro Cliente -->
<?php
if (isset($_POST['btn-cadastrar'])) {

    $email_novo = $_POST['email'];
    $cpf_novo = $_POST['cpf'];

    //BUSCAR O REGISTRO JÁ CADASTRADO NO BANCO
    $queryC = $pdo->query("SELECT * FROM funcionarios WHERE email = '$email_novo' OR cpf = '$cpf_novo'");
    $res = $queryC->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);
    if ($total_reg > 0) {
        echo "<script language='javascript'>window.alert('Esse registro já está existe!')</script>";
        echo "<script language='javascript'>window.location='index.php'</script>";
        exit();
    }

    $hoje = date('Y-m-d');
    $query = $pdo->prepare("INSERT INTO funcionarios (nome, cpf, email, telefone, cep, rua, numero, bairro, cidade, estado, senha, cargo, datanasc, datacad, imagem) VALUES (:nome, :cpf, :email, :telefone, :cep, :rua, :numero, :bairro, :cidade, :estado, :senha, :cargo, :datanasc, :datacad, :imagem)");
    $query->bindValue(":nome", $_POST['nome']);
    $query->bindValue(":cpf", $_POST['cpf']);
    $query->bindValue(":email", $_POST['email']);
    $query->bindValue(":telefone", $_POST['telefone']);
    $query->bindValue(":cep", $_POST['cep']);
    $query->bindValue(":rua", $_POST['rua']);
    $query->bindValue(":numero", $_POST['numero']);
    $query->bindValue(":bairro", $_POST['bairro']);
    $query->bindValue(":cidade", $_POST['cidade']);
    $query->bindValue(":estado", $_POST['estado']);
    $query->bindValue(":senha", $_POST['senha']);
    $query->bindValue(":cargo", $_POST['cargo']);
    $query->bindValue(":datanasc", $_POST['datanasc']);
    $query->bindValue(":datacad", $hoje);
    $query->bindValue(":imagem", $_POST['imagem']);
    $query->execute();

    echo "<script language='javascript'>window.alert('Cadastrado com Sucess!!')</script>";
    echo "<script language='javascript'>window.location='index.php'</script>";
    exit();
}
?>
<!-- Fim Script Cadastro Cliente -->

<!-- CHAMA MODAL EDITAR -->
<?php
if ($funcao == 'editar') { ?>
    <script>
        var myModal = new bootstrap.Modal(document.getElementById('novoFuncionario'));
        myModal.show();
    </script>
<?php }
?>
<!-- FIM CHAMA MODAL EDITAR -->

<!-- Script Edição Cliente -->
<?php
if (isset($_POST['btn-editar'])) {

    $email_antigo = $resEd[0]['email'];
    $cpf_antigo = $resEd[0]['cpf'];
    $email_novo = $_POST['email'];
    $cpf_novo = $_POST['cpf'];

    if ($email_antigo != $email_novo or $cpf_antigo != $cpf_novo) {

        //BUSCAR O REGISTRO JÁ CADASTRADO NO BANCO
        $queryC = $pdo->query("SELECT * FROM funcionarios WHERE email = '$email_novo' OR cpf = '$cpf_novo'");
        $res = $queryC->fetchAll(PDO::FETCH_ASSOC);
        $total_reg = @count($res);
        if ($total_reg > 0) {
            echo "<script language='javascript'>window.alert('CPF ou e-mail de usuário existente. Tem certeza que quer editar esse registro?')</script>";
            echo "<script language='javascript'>window.location='index.php'</script>";
            exit();
        }
    }

    $query = $pdo->prepare("UPDATE funcionarios SET nome = :nome, cpf = :cpf, email = :email, telefone = :telefone, cep = :cep, rua = :rua, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, senha = :senha, cargo = :cargo, datanasc = :datanasc, imagem = :imagem WHERE id = :id");
    $query->bindValue(":nome", $_POST['nome']);
    $query->bindValue(":cpf", $_POST['cpf']);
    $query->bindValue(":email", $_POST['email']);
    $query->bindValue(":telefone", $_POST['telefone']);
    $query->bindValue(":cep", $_POST['cep']);
    $query->bindValue(":rua", $_POST['rua']);
    $query->bindValue(":numero", $_POST['numero']);
    $query->bindValue(":bairro", $_POST['bairro']);
    $query->bindValue(":cidade", $_POST['cidade']);
    $query->bindValue(":estado", $_POST['estado']);
    $query->bindValue(":senha", $_POST['senha']);
    $query->bindValue(":cargo", $_POST['cargo']);
    $query->bindValue(":datanasc", $_POST['datanasc']);
    $query->bindValue(":imagem", $_POST['imagem']);
    $query->bindValue(":id", $_GET['id']);
    $query->execute();

    echo "<script language='javascript'>window.alert('Editado com Sucess!!')</script>";
    echo "<script language='javascript'>window.location='index.php'</script>";
    exit();
}

?>
<!-- Fim Script Edição Cliente -->

<!-- CHAMA MODAL ECLUIR -->
<?php
if ($funcao == 'excluir') { ?>
    <script>
        var myModal = new bootstrap.Modal(document.getElementById('excluir'));
        myModal.show();
    </script>
<?php }
?>
<!-- FIM CHAMA MODAL ECLUIR -->

<!-- Script Excluir Cliente -->
<?php
if (isset($_POST['btn-excluir'])) {

    $query = $pdo->query("DELETE FROM funcionarios WHERE id = '$_GET[id]'");
    echo "<script language='javascript'>window.location='index.php'</script>";
    exit();
}

?>
<!-- Fim Script Excluir Cliente -->

<!-- Script Dados Adicionais -->
<script type="text/javascript">
    function dados(nome, cep, rua, numero, bairro, cidade, estado, senha, imagem, datanasc) {
        event.preventDefault();
        var myModal = new bootstrap.Modal(document.getElementById('modal-dados'), {

        });

        myModal.show();
        $('#nome_registro').text(nome);
        $('#cep_registro').text(cep);
        $('#rua_registro').text(rua);
        $('#numero_registro').text(numero);
        $('#bairro_registro').text(bairro);
        $('#cidade_registro').text(cidade);
        $('#estado_registro').text(estado);
        $('#senha_registro').text(senha);
        $('#imagem_registro').attr('src', '../assets/imagens/funcionarios/' + imagem);
        $('#data_nasc_registro').text(datanasc);

    }
</script>
<!-- Fim Script Dados Adicionais -->

<!-- FOCO NO NOME ABRINDO A MODAL CADASTRO -->
<script>
    $('#novoFuncionario').on('shown.bs.modal', function(event) {
        $("#nome").focus();
    })
</script>
<!-- FIM FOCO NO NOME ABRINDO A MODAL CADASTRO -->

<!--SCRIPT PARA CARREGAR IMAGEM -->
<script type="text/javascript">
    function carregarImg() {

        var target = document.getElementById('target');
        var file = document.querySelector("input[type=file]").files[0];

        var arquivo = file['name'];
        resultado = arquivo.split(".", 2);
        //console.log(resultado[1]);

        if (resultado[1] === 'pdf') {
            $('#target').attr('src', "../../assets/imagens/funcionarios/pdf.png");
            return;
        }

        var reader = new FileReader();

        reader.onloadend = function() {
            target.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);


        } else {
            target.src = "";
        }
    }
</script>
<!-- FIM DO SCRIPT PARA CARREGAR IMAGEM -->