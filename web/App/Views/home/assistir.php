<div class="d-flex justify-content-end mt-3">
    <a href="/?pagina=<?= $_GET["pagina"] ?? null ?>" class="btn btn-secondary">Voltar</a>
</div>

<div class="row mx-5">

    <div class="col-9">

        <div class="row border border-5 border-black">
            <?= $filme["embedVideo"] ?>
        </div>

        <div class="row mt-3">
            <div class="row d-flex justify-content-evenly">
                <div class="col-3">
                    <img class="img-capa" alt="<?= $filme["titulo"] ?>-capa" width="100%" src="<?= $this->UrlFile("capas/" . $filme["imagemCapa"]) ?>" />
                    <div class="card-body">
                        <h5 class="card-title text-center"></h5>
                    </div>
                </div>
                <div class="col-9 text-justify">
                    <h3><strong><?= $filme["titulo"] ?></strong></h3>
                    <?= $filme["sinopse"] ?>
                    </p>
                    <strong>Ano de lançamento: </strong> <?= $filme["ano"] ?>
                    <br />
                    <strong>Categoria: </strong> <?= $filme["categoria"] ?>
                    <br />
                    <strong>País: </strong> <?= $filme["pais"] ?>
                </div>
            </div>
            <?php if ($filme["imagemDemo"]) { ?>
                <div class="row py-3 text-justify">
                    <img style="width: 100%;" src="<?= $this->UrlFile("demo/" . $filme["imagemDemo"]) ?>" alt="<?= $filme["titulo"] ?>-preview">
                </div>
            <?php  } ?>
        </div>
    </div>

    <div class="col-3 ">
        <div class="row mt-5 d-flex align-items-center justify-content-center">
            <?php foreach ($data["sugestao"] as $sugestao) { ?>
                <div class="card p-2 m-2" id="home-capa" style="width: 15rem;">
                    <a href="/assitir?id=<?= $sugestao["id"] ?>">
                        <img alt="<?= $sugestao["titulo"] ?>" width="100%" src="<?= $this->UrlFile("capas/" . $sugestao["imagemCapa"]) ?>" />
                    </a>
                    <div class="card-body">
                        <h5 class="card-title text-center"><?= $sugestao["titulo"] ?></h5>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 d-flex justify-content-center">
        <?php foreach ($data["categoriAnos"] as $anos) { ?>
            <h4 style="float: left;" class="m-3">
                <a href="<?= $this->linkSlug($filme["ano"], "/ano/")  ?>">
                    <span class="badge text-bg-light">
                        <?= $anos["ano"] ?>
                    </span>
                </a>
            </h4>
        <?php } ?>
    </div>
    <div class="col-12 d-flex justify-content-center">
        <?php foreach ($data["categoriPais"] as $pais) { ?>
            <h4 style="float: left;" class="m-3">
                <a href="<?= $this->linkSlug($filme["pais"], "/pais/")  ?>">
                    <span class="badge text-bg-default">
                        <?= $pais["pais"] ?>
                    </span>
                </a>
            </h4>
        <?php } ?>
    </div>
</div>