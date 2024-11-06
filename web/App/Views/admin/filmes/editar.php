<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Filmes</h1>
</div>


<div class="row">
    <form action="/admin/filmes/editar?id=<?= $_GET["id"] ?>" method="post" enctype="multipart/form-data">
        <div class="form-group m-3">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="<?= $filme["titulo"] ?>" required>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group m-3">
                    <label for="categoria">Categoria</label>
                    <select class="form-select" id="categoria" name="categoria" required>
                        <?php foreach ($data["categorias"] as $categoria) { ?>
                            <option <?= $filme["idcategoria"] == $categoria["id"] ? "selected" : "" ?> value="<?= $categoria["id"] ?>"><?= $categoria["descricao"] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group m-3">
                    <label for="embedVideo">Data Publicação</label>
                    <input type="date" class="form-control" id="dataPublicacao" name="dataPublicacao" value="<?= $filme["dataPublicacao"] ?>" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group m-3">
                    <label for="imagemCapa">Capa</label>
                    <input type="file" class="form-control" id="imagemCapa" name="imagemCapa">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group m-3">
                    <label for="imagemDemo">Imagem de demonstração</label>
                    <input type="file" class="form-control" id="imagemDemo" name="imagemDemo">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group m-3">
                    <label for="ano">ano</label>
                    <input type="text" class="form-control" id="ano" name="ano" value="<?= $filme["ano"] ?>">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group m-3">
                    <label for="pais">País</label>
                    <input type="text" class="form-control" id="pais" name="pais" value="<?= $filme["pais"] ?>">
                </div>
            </div>
        </div>

        <div class="form-group m-3">
            <label for="sinopse">Sinopse</label>
            <textarea class="form-control" id="sinopse" name="sinopse" rows="5" required><?= $filme["sinopse"] ?></textarea>
        </div>

        <div class="form-group m-3">
            <label for="embedVideo">Embed do Vídeo</label>
            <textarea class="form-control" id="embedVideo" name="embedVideo" rows="5" required><?= $filme["embedVideo"] ?></textarea>
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="/admin/filmes" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
</div>