<?php

namespace App\Controllers;

use App\Models\ContatoModel;
use App\Models\FilmeModel;
use Core\Controller;

class HomeController extends Controller
{

    public $itensPorPagina = 10;
    public $paginaAtual = 1;
    public $offset = null;
    public $totalPaginas = 1;

    public function __construct()
    {
        // Defina os parâmetros de paginação
        $this->paginaAtual = isset($_GET['pagina']) && $_GET['pagina'] != null ? (int)$_GET['pagina'] : 1; // Página atual (vinda de um GET, por exemplo)

        // Calcula o offset
        $this->offset = ($this->paginaAtual - 1) * $this->itensPorPagina;
    }

    public function index()
    {
        $model = new FilmeModel();

        // Obtenha a lista de filmes com paginação
        $filmes = $model->getAllFilmes($this->itensPorPagina, $this->offset);

        // Obtenha o total de filmes para calcular o número total de páginas
        $totalFilmes = $model->getTotalFilmes();
        $this->totalPaginas = ceil($totalFilmes / $this->itensPorPagina);

        $this->view(
            'home/index',
            array(
                "filmes" => $filmes,
                "totalPaginas" => $this->totalPaginas
            ),
            'public'
        );
    }

    public function contato()
    {
        $this->view(
            'home/contato',
            null,
            'public'
        );
    }

    
    public function contatoEnviar()
    {
        try {

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Captura os dados do formulário
                $email = $_POST['email'];
                $assunto = $_POST['assunto'];
                $comentario = $_POST['comentario'];

                // Cria uma instância da classe Filme e insere os dados 
                $model = new ContatoModel();
                if ($model->insert($email, $assunto, $comentario)) {
                    $_SESSION["mensagem"] = "<div class='alert alert-success'>Contato enviado com sucesso! Se necessário, retornaremos o contato.</div>";
                } else {
                    $_SESSION["mensagem"] = "<div class='alert alert-danger'>Erro ao cadastrar o filme.</div>";
                }

                header("Location: /contato");
            }

            $this->view(
                'home/contato',
                null,
                'public'
            );
        } catch (\Exception $e) {
            // Em caso de erro, registre no log e exiba uma mensagem de erro
            error_log("Erro ao cadastrar o filme: " . $e->getMessage());
        }
    }

    public function ano($ano)
    {
        $model = new FilmeModel();

        $filmes = $model->getFilmeByAno($ano, $this->itensPorPagina, $this->offset);

        $totalFilmes = $model->getTotalFilmes($ano);
        $this->totalPaginas = ceil($totalFilmes / $this->itensPorPagina);

        $this->view(
            'home/index',
            array(
                "filmes" => $filmes,
                "totalPaginas" => $this->totalPaginas
            ),
            'public'
        );
    }

    public function pais($pais)
    {
        $model = new FilmeModel();

        $filmes = $model->getFilmeByPais($pais, $this->itensPorPagina, $this->offset);

        $totalFilmes = $model->getTotalFilmes(null, $pais);
        $this->totalPaginas = ceil($totalFilmes / $this->itensPorPagina);

        $this->view(
            'home/index',
            array(
                "filmes" => $filmes,
                "totalPaginas" => $this->totalPaginas
            ),
            'public'
        );
    }

    public function assistir($slug, $id)
    {
        $slug = htmlspecialchars($slug);
        $id = $this->decode($id);

        if ($id == null)
            $this->Error("Código do filme não informado.");

        $model = new FilmeModel();
        $filme = $model->getFilmeById($id);

        if ($filme == null)
            $this->Error("Código informado é inválido, ou o filme não existe.", "public");

        $sugestao = $model->getSugestaoRandom(3);
        $categoriAnos = $model->getCategoriasAno();
        $categoriPais = $model->getCategoriasPais();


        $this->view(
            'home/assistir',
            array(
                "filme" => $filme,
                "sugestao" => $sugestao,
                "categoriAnos" => $categoriAnos,
                "categoriPais" => $categoriPais,
                "pagina" => $this->paginaAtual
            ),
            'public'
        );
    }
}
