<?php

use App\Helpers\ComboboxHelper;

$combobox = new ComboboxHelper();

?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Cadastro de Membro</h1>
</div>

<div class="row mb-5">
    <form action="/membros/cadastrar" method="post">
        <div class="form-group m-3">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>

        <div class="form-group m-3">
            <label for="dataNascimento">Data de Nascimento</label>
            <input type="date" class="form-control" id="dataNascimento" name="dataNascimento">
        </div>

        <div class="form-group m-3">
            <label for="situacao">Situação</label>
            <?php echo $combobox->view("situacao", true, array("id" => "id", "name" => "name"), $situacao, array()); ?>
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end m-3">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="/membros" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
</div>