<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Filmes</h1>
</div>

<p>Incluir novos filmes, ou importar via link do site: </p>

<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <a class="btn btn-primary me-md-2" href="/admin/filmes/cadastrar">Cadastrar</a>
    <a class="btn btn-outline-secondary" type="button">Importar</a>
</div>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Título</th>
            <th scope="col">Categoria</th>
            <th scope="col">Capa</th>
            <th scope="col">Data Publicação</th>
            <th style="width: 12rem;" scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data["filmes"] as $filme) { ?>
            <tr>
                <th scope="row"><?= $filme["id"] ?></th>
                <td><?= $filme["titulo"] ?></td>
                <td><?= $filme["categoria"] ?></td>
                <td><img width="50" src="../public/uploads/capas/<?= $filme["imagemCapa"] ?>" /></td>
                <td><?= date("d/m/Y", strtotime($filme["dataPublicacao"]) ) ?></td>
                <td>
                    <a href="/admin/filmes/legenda?id=<?= $filme["id"] ?>&pagina=<?= $_GET["pagina"] ?>" class="btn btn-outline-secondary"><i class="bi bi-chat-left-dots"></i></a>
                    <a href="/admin/filmes/editar?id=<?= $filme["id"] ?>&pagina=<?= $_GET["pagina"] ?>" class="btn btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                    <a href="/admin/filmes/excluir?id=<?= $filme["id"] ?>&pagina=<?= $_GET["pagina"] ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>



<?php

$pagina = isset($_GET["pagina"]) ? $_GET["pagina"] : 1;

?>

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-end">
        <li class="page-item <?= $pagina == 1 ? "disabled" : "" ?>">
            <a class='page-link' href='?pagina=1'>Primeiro</a>
        </li>
        <?php

        for ($i = 1; $i <= $totalPaginas; $i++) {
            echo "<li class='page-item " . ($pagina == $i ? "active" : "")  . "'><a class='page-link' href='?pagina=$i'>$i</a></li> ";
        }
        ?>
        <li class="page-item">
            <a class="page-link <?= $totalPaginas ==  $pagina ? "disabled" : "" ?>" href="?pagina=<?= $totalPaginas ?>">Último</a>
        </li>
    </ul>
</nav>