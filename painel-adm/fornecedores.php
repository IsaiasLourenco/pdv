<?php
$pag = 'fornecedores';
@session_start();

require_once('../conexao.php');

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/fontesEtitulos.css">
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
</head>

<body>

    <h6><i class="bi bi-person-fill-add"></i> FORNECEDORES</h6>
    <a href="index.php?pagina=<?php echo $pag ?>&funcao=novo" type="button" class="btn btn-primary   mt-2">Novo Fornecedor</a>

    <div class="mt-4" style="margin-right:25px">
        <?php
        $query = $pdo->query("SELECT * from fornecedores order by id desc");
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        $total_reg = @count($res);

        if ($total_reg > 0) {


        ?>
            <small>
                <table id="fornecedores" class="table table-hover" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nome</th>
                            <th>CNPJ</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Categoria</th>
                            <th style="text-align: center;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        for ($i = 0; $i < $total_reg; $i++) {
                            foreach ($res[$i] as $key => $value) {
                            }

                            @$id_cat = $res[$i]['categoria'];

                            $query1 = $pdo->query("SELECT * FROM categorias WHERE id = '$id_cat'");
                            $res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
                            @$nome_cat = $res1[0]['nome'];


                        ?>

                            <tr>
                                <td><?php echo $res[$i]['nome'] ?></td>
                                <td><?php echo $res[$i]['cnpj'] ?></td>
                                <td><?php echo $res[$i]['email'] ?></td>
                                <td><?php echo $res[$i]['telefone'] ?></td>
                                <td><?php echo $nome_cat ?></td>
                                <td style="text-align: center;">
                                    <a href="index.php?pagina=<?php echo $pag ?>&funcao=editar&id=<?php echo $res[$i]['id'] ?>" title="Editar Registro">
                                        <i class="bi bi-pencil-square text-success"></i>
                                    </a>

                                    <a href="index.php?pagina=<?php echo $pag ?>&funcao=deletar&id=<?php echo $res[$i]['id'] ?>" title="Excluir Registro">
                                        <i class="bi bi-trash3 text-danger mx-1"></i>
                                        
                                    </a>
                                </td>
                            </tr>

                        <?php } ?>

                    </tbody>

                </table>
            </small>
        <?php } else {
            echo '<p>Não existem dados para serem exibidos!!';
        } ?>
    </div>
</body>

<?php
if (@$_GET['funcao'] == "editar") {
    $titulo_modal = 'Editar Registro';
    $query = $pdo->query("SELECT * from fornecedores where id = '$_GET[id]'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);
    if ($total_reg > 0) {
        $nome = $res[0]['nome'];
        $email = $res[0]['email'];
        $cnpj = $res[0]['cnpj'];
        $telefone = $res[0]['telefone'];
        $cep = $res[0]['cep'];
        $rua = $res[0]['rua'];
        $numero = $res[0]['numero'];
        $bairro = $res[0]['bairro'];
        $cidade = $res[0]['cidade'];
        $estado = $res[0]['estado'];
        $id_categoria = $res[0]['categoria'];
        
    }
} else {
    $titulo_modal = 'Inserir Registro';
}
?>

<!-- MODAL INSERÇÃO EDIÇÃO -->
<div class="modal fade" tabindex="-1" id="modalCadastrar" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo $titulo_modal ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="frmCad" name="frmCad">
                <div class="modal-body">


                    <div class="row">
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome </label>
                                <input type="text" class="form-control" id="nome" value="<?php echo @$nome ?>" name="nome" placeholder="Nome" autofocus required tabindex="1">
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="mb-3">
                                <label for="cpf" class="form-label">CPF </label>
                                <input type="text" class="form-control" id="cnpj" value="<?php echo @$cnpj ?>" name="cnpj" placeholder="CNPJ" required tabindex="2">
                            </div>
                        </div>

                        <div class="col-5">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email </label>
                                <input type="email" autocomplete="off" class="form-control" id="email" name="email" placeholder="nome@exemplo.com" value="<?php echo @$email ?>" required tabindex="3">
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-3">
                            <div class="mb-3">
                                <label for="telefone" class="form-label">Telefone </label>
                                <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(xx)xxxx-xxxx" value="<?php echo @$telefone ?>" required tabindex="4">
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="mb-3">
                                <label for="cep" class="form-label">CEP </label>
                                <input type="text" class="form-control" id="cep" name="cep" placeholder="CEP" value="<?php echo @$cep ?>" tabindex="5">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="rua" class="form-label">Rua </label>
                                <input type="text" class="form-control" id="rua" name="rua" placeholder="Rua" value="<?php echo @$rua ?>" readonly>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-2">
                            <div class="mb-3">
                                <label for="numero" class="form-label">Número </label>
                                <input type="text" class="form-control" id="numero" name="numero" value="<?php echo @$numero ?>" placeholder="Número" tabindex="6">
                            </div>
                        </div>

                        <div class="col-5">
                            <div class="mb-3">
                                <label for="bairro" class="form-label">Bairro </label>
                                <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro" value="<?php echo @$bairro ?>" readonly>
                            </div>
                        </div>

                        <div class="col-5">
                            <div class="mb-3">
                                <label for="cidade" class="form-label">Cidade </label>
                                <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade" value="<?php echo @$cidade ?>" readonly>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-2">
                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado </label>
                                <input type="text" class="form-control" id="estado" name="estado" value="<?php echo @$estado ?>" placeholder="UF" readonly>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="mb-3">
                                <label for="categoria" class="form-label">Categoria </label>
                                <select class="form-select" aria-label="Default select example" id="categoria" name="categoria" tabindex="9">
                                    <?php
                                    $query_cat = $pdo->query("SELECT * FROM categorias ORDER BY nome ASC");
                                    $res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);
                                    for ($i = 0; $i < @count($res_cat); $i++) {
                                        foreach ($res_cat[$i] as $key => $value) {
                                        }
                                        $id_cat = $res_cat[$i]['id'];
                                        $nome_cat = $res_cat[$i]['nome'];
                                    ?>
                                        <option <?php if (@$id_cat == @$id_categoria) { ?> selected <?php } ?> value="<?php echo $id_cat ?>"><?php echo $nome_cat ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                        </div>

                    </div>

                    <input name="id" type="hidden" value="<?php echo @$_GET['id'] ?>">

                    <div style="text-align: center;" id="mensagem">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-fechar" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button name="btn-salvar" id="btn-salvar" type="submit" class="btn btn-primary">Salvar mudanças</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- FIM MODAL INSERÇÃO EDIÇÃO -->

<!-- MODAL EXCLUSÃO -->
<div class="modal fade" tabindex="-1" id="modalDeletar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo $titulo_modal ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="form-excluir">
                <div class="modal-body">

                    <p>Deseja Realmente Excluir o Registro?</p>

                    <div style="text-align: center;" class="mt-1" id="mensagem-excluir"></div>

                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-fechar" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button name="btn-excluir" id="btn-excluir" type="submit" class="btn btn-danger">Excluir</button>
                </div>
                <input name="id" type="text" value="<?php echo @$_GET['id'] ?>">
            </form>
        </div>
    </div>
</div>
<!-- FIM MODAL EXCLUSÃO -->

<!-- SCRIPT ADICIONAR ARQUIVO -->
<?php
if (@$_GET['funcao'] == "novo") { ?>
    <script type="text/javascript">
        var myModal = new bootstrap.Modal(document.getElementById('modalCadastrar'), {
            backdrop: 'static'
        })

        myModal.show();
    </script>
<?php } ?>
<!-- FIM SCRIPT ADICIONAR ARQUIVO -->

<!-- SCRIPT EDITAR ARQUIVO -->
<?php
if (@$_GET['funcao'] == "editar") { ?>
    <script type="text/javascript">
        var myModal = new bootstrap.Modal(document.getElementById('modalCadastrar'), {
            backdrop: 'static'
        })

        myModal.show();
    </script>
<?php } ?>
<!-- FIM SCRIPT EDITAR ARQUIVO -->

<!-- SCRIPT APAGAR ARQUIVO -->
<?php
if (@$_GET['funcao'] == "deletar") { ?>
    <script type="text/javascript">
        var myModal = new bootstrap.Modal(document.getElementById('modalDeletar'), {

        })

        myModal.show();
    </script>
<?php } ?>
<!-- FIM SCRIPT APAGAR ARQUIVO -->

<!--AJAX PARA INSERÇÃO E EDIÇÃO DOS DADOS COM IMAGEM -->
<script type="text/javascript">
    $("#frmCad").submit(function() {
        var pag = "<?= $pag ?>";
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: pag + "/inserir.php",
            type: 'POST',
            data: formData,

            success: function(mensagem) {

                $('#mensagem').removeClass()

                if (mensagem.trim() == "Salvo com Sucesso!") {

                    $('#btn-fechar').click();
                    window.location = "index.php?pagina=" + pag;

                } else {

                    $('#mensagem').addClass('text-danger')
                }

                $('#mensagem').text(mensagem)

            },

            cache: false,
            contentType: false,
            processData: false,
            xhr: function() { // Custom XMLHttpRequest
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                    myXhr.upload.addEventListener('progress', function() {
                        /* faz alguma coisa durante o progresso do upload */
                    }, false);
                }
                return myXhr;
            }
        });
    });
</script>
<!-- FIM AJAX PARA INSERÇÃO E EDIÇÃO DOS DADOS COM IMAGEM -->

<!--AJAX PARA EXCLUIR DADOS -->
<script type="text/javascript">
    $("#form-excluir").submit(function() {
        var pag = "<?= $pag ?>";
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: pag + "/excluir.php",
            type: 'POST',
            data: formData,

            success: function(mensagem) {

                $('#mensagem').removeClass()

                if (mensagem.trim() == "Excluído com Sucesso!") {

                    $('#mensagem-excluir').addClass('text-success')

                    $('#btn-fechar').click();
                    window.location = "index.php?pagina=" + pag;

                } else {

                    $('#mensagem-excluir').addClass('text-danger')
                }

                $('#mensagem-excluir').text(mensagem)

            },

            cache: false,
            contentType: false,
            processData: false,

        });
    });
</script>
<!--FIM AJAX PARA EXCLUIR DADOS -->

<!-- SCRIPT PARA DATABLES USUARIOS -->
<script>
    $(document).ready(function() {
        var table = $('#fornecedores').DataTable({
            ordering: false
        });


    });
</script>
<!-- FIM DO SCRIPT PARA DATABLES USUARIOS -->