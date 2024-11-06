<div class="col-12">
    <div class="row d-flex justify-content-evenly">
        <?php foreach ($data["filmes"] as $filme) { ?>
            <div class="card p-2 m-2" id="home-capa" style="width: 15rem;">
                <a href="<?= $this->linkSlug($filme["titulo"], "/assistir/", $filme["id"])  ?>">
                    <img alt="<?= $filme["titulo"] ?>" width="100%" src="<?= $this->UrlFile("capas/" . $filme["imagemCapa"]) ?>" />
                </a>
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <strong><?= $filme["titulo"] ?></strong>
                        <br />
                        <small>(<?= $filme["ano"] ?>)</small>
                    </h5>
                </div>
            </div>
        <?php } ?>
    </div>
</div>


<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-end">
        <li class="page-item <?= $this->paginaAtual == 1 ? "disabled" : "" ?>">
            <a class='page-link' href='?pagina=1'>Primeiro</a>
        </li>
        <?php

        for ($i = 1; $i <= $this->totalPaginas; $i++) {
            echo "<li class='page-item " . ($this->paginaAtual == $i ? "active" : "")  . "'><a class='page-link' href='?pagina=$i'>$i</a></li> ";
        }
        ?>
        <li class="page-item">
            <a class="page-link <?= $this->totalPaginas ==  $this->paginaAtual ? "disabled" : "" ?>" href="?pagina=<?= $this->totalPaginas ?>">Último</a>
        </li>
    </ul>
</nav>