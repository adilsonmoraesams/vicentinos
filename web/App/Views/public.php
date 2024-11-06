<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_SESSION["SEO"]["TITLE"] ?></title>


    <meta name="description" content="<?= $_SESSION["SEO"]["DESCRIPTION_PAGE"] == null ? $_SESSION["SEO"]["DESCRIPTION"] : $_SESSION["SEO"]["DESCRIPTION_PAGE"]  ?>" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #000;
        }

        .card {
            border: 0;
            background: none;
        }

        .nav-item {
            text-align: center;
            width: 5rem;
            border-radius: 5px;
        }

        .nav-item:hover {
            background-color: #E8017E;
            font-weight: bold;
        }

        .img-capa {
            border: 8px #ccc1 solid;
        }

        #home-capa a {
            border: 8px #ccc1 solid;
        }

        #home-capa a:hover {
            border: 8px #ccc3 solid;
        }

        small {
            font-size: 14px;
        }

        .active>.page-link,
        .page-link.active {
            background-color: #ccc;
            border-color: #ccc;
        }


        .page-link,
        .page-link a {
            color: #ccc
        }
    </style>
</head>

<body>

    <div class="container-fluid" style="height: 8rem;">
        <a href="/">
            <img src="<?= $this->UrlFile("../images/logo.fw.png") ?>" height="100%" alt="logo-erotika-prive">
        </a>
    </div>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Página Inicial</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Hard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Soft</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Conteúdo da página será inserido aqui -->
    <main class="container-fluid">

        <div class="row mt-3">
            <?php
            if (isset($_SESSION["mensagem"]) && $_SESSION["mensagem"] != "")
                echo $_SESSION["mensagem"];
            ?>
        </div>
        <?= $content ?>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">

        <div class="col-12 py-5 text-center" style="font-size: x-small;">
            Somos contra a pirataria e respeitamos os direitos autorais. Todos os filmes aqui exibidos já estão disponíveis na internet, ou foram enviados por nossos colaboradores.
            <br />
            Se você encontrar algum conteúdo que não deveria estar aqui, entre em <a href="/contato">contato</a> conosco.
        </div>

        <div class="col-md-4 d-flex align-items-center">
            <span class="mb-3 mb-md-0 text-body-secondary">© <?= date("Y") ?> Todos os direitos reservados</span>
        </div>

        <!-- <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            <li class="ms-3"><a class="text-body-secondary" href="#">
                xxx
            </use>
                    </svg></a></li>
            <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24">
                        <use xlink:href="#instagram"></use>
                    </svg></a></li>
            <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24">
                        <use xlink:href="#facebook"></use>
                    </svg></a></li>
        </ul> -->
    </footer>
</body>

</html>
<?php
$_SESSION["mensagem"] = "";
?>