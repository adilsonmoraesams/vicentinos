<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Membro</h1>
</div>


<div class="row">
    <form action="/membros/editar?id=<?= $_GET["id"] ?>" method="post">
        <div class="form-group m-3">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" value="<?= $membro["nome"] ?>" id="nome" name="nome" required>
        </div>

        <div class="form-group m-3">
            <label for="dataNascimento">Data de Nascimento</label>
            <input type="date" class="form-control" value="<?= date('Y-m-d', strtotime($membro["dataNascimento"])) ?>" id="dataNascimento" name="dataNascimento">
        </div>

        <div class="form-group m-3">
            <label for="situacao">Situação</label>
            <select class="form-select" id="situacao" name="situacao" required>
                <option <?= $membro["situacao"] == 1 ?? 'selected' ?> value="1">Apoio</option>
                <option <?= $membro["situacao"] == 2 ?? 'selected' ?> value="2">Aspirante</option>
                <option <?= $membro["situacao"] == 3 ?? 'selected' ?> value="3">Confrade/Consórcia</option>
            </select>
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end m-3">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="/membros" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
</div>