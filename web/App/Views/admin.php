<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_SESSION["SEO"]["TITLE"] ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        html,
        body {
            height: 100%;
        }

        .navbar {
            border-bottom: 1px #fff;
        }

        #sidebar {
            min-height: 100vh;
        }

        #sidebar .nav-item {
            border-bottom: #495057 1px solid;
        }

        #sidebar .nav-link {
            color: white;
            /* Links em branco */
        }

        #sidebar .nav-link:hover {
            color: #495057;
            /* Cor de fundo ao passar o mouse */
        }

        .nav-link.active {
            background-color: #007bff;
            /* Cor de fundo do item ativo */
            color: white !important;
            /* Cor do texto do item ativo */
            font-weight: bold;
            /* Deixar o texto mais destacado */
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <?php

    function menuAtivo($item)
    {
        if ($_SERVER["REQUEST_URI"] != "") {
            $urls = explode("?", $_SERVER["REQUEST_URI"]);

            if (sizeof($urls) == 0) return;
            $urls = explode("/", $urls[0]);
            if (sizeof($urls) == 0) return;

            return in_array($item, $urls) ? "active" : "";
        }
    }


    ?>

    <!-- Navbar (Barra Superior) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Minha Aplicação</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Layout Principal -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar (Barra Lateral) -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block text-light bg-dark sidebar collapse">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link " href="/">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= menuAtivo("membros") ?>" href="/membros">Membros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= menuAtivo("familias") ?>" href="/familias">Famílias</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= menuAtivo("contas") ?>" href="/contas">Contas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= menuAtivo("mapas") ?>" href="/mapas">Mapas</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Conteúdo Principal -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <!-- Conteúdo da página será inserido aqui -->

                <div class="row mt-3">
                    <?php
                    if (isset($_SESSION["mensagem"]) && $_SESSION["mensagem"] != "")
                        echo $_SESSION["mensagem"];
                    ?>
                </div>

                <?= $content ?>
            </main>
        </div>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

<?php
$_SESSION["mensagem"] = "";
?>