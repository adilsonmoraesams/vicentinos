<?php

use App\Helpers\TextSelectedHelper;

$textSelected = new TextSelectedHelper();

?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Membros</h1>
</div>

<p>Incluir novos membros:</p>

<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <a class="btn btn-primary me-md-2" href="/membros/cadastrar">Cadastrar</a>
</div>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Data de Nascimento</th>
            <th scope="col">Situação</th>
            <th style="width: 12rem;" scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data["membros"] as $membro) { ?>
            <tr>
                <th scope="row"><?= $membro["id"] ?></th>
                <td><?= $membro["nome"] ?></td>
                <td><?= date("d/m/Y", strtotime($membro["dataNascimento"])) ?></td>
                <td><?php echo $textSelected->view(array("id" => "id", "name" => "name"), $situacao, $membro["situacao"]); ?></td>
                <td>
                    <a href="/membros/editar?id=<?= $membro["id"] ?>&pagina=<?= $_GET["pagina"] ?>" class="btn btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                    <a href="/membros/excluir?id=<?= $membro["id"] ?>&pagina=<?= $_GET["pagina"] ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>
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