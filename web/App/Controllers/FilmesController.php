<?php



namespace App\Controllers;

use App\Helpers\UploadHelper;
use App\Models\CategoriaModel;
use Core\Controller;
use App\Models\FilmeModel;
use Exception;

class FilmesController extends Controller
{
    public function index()
    {
        $model = new FilmeModel();

        // Defina os parâmetros de paginação
        $itensPorPagina = 5; // Quantos filmes por página
        $paginaAtual = isset($_GET['pagina']) && $_GET['pagina'] != null ? (int)$_GET['pagina'] : 1; // Página atual (vinda de um GET, por exemplo)

        // Calcula o offset
        $offset = ($paginaAtual - 1) * $itensPorPagina;

        // Obtenha a lista de filmes com paginação
        $filmes = $model->getAllFilmes($itensPorPagina, $offset);

        // Obtenha o total de filmes para calcular o número total de páginas
        $totalFilmes = $model->getTotalFilmes();
        $totalPaginas = ceil($totalFilmes / $itensPorPagina);

        $this->view(
            'admin/filmes/index',
            array(
                "filmes" => $filmes,
                "totalPaginas" => $totalPaginas
            ),
            'admin'
        );
    }

    public function cadastrar()
    {
        try {

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Captura os dados do formulário
                $titulo = $_POST['titulo'];
                $categoria = $_POST['categoria'];
                $embedVideo = $_POST['embedVideo'];
                $imagemCapa = $_FILES['imagemCapa'];
                $imagemDemo = $_FILES['imagemDemo'];
                $ano = $_POST['ano'];
                $pais = $_POST['pais'];
                $dataPublicacao = $_POST['dataPublicacao'];
                $sinopse = $_POST['sinopse'];

                $uploadHelper = new UploadHelper();

                if ($imagemDemo)
                    $uploadimagemCapa = $uploadHelper->UploadImagem($imagemCapa, "/capas");

                if ($imagemDemo)
                    $uploadimagemDemo = $uploadHelper->UploadImagem($imagemDemo, "/demo");

                // Cria uma instância da classe Filme e insere os dados 
                $model = new FilmeModel();
                if ($model->createFilme(
                    $titulo,
                    $categoria,
                    $embedVideo,
                    $uploadimagemCapa["name"],
                    $dataPublicacao,
                    $uploadimagemDemo["name"],
                    $ano,
                    $pais,
                    $sinopse
                )) {
                    $_SESSION["mensagem"] = "<div class='alert alert-success'>Filme cadastrado com sucesso!</div>";
                } else {
                    $_SESSION["mensagem"] = "<div class='alert alert-danger'>Erro ao cadastrar o filme.</div>";
                }

                header("Location: /admin/filmes");
            }

            $categoriasModel = new CategoriaModel();
            $categorias = $categoriasModel->getAll();

            $this->view(
                'admin/filmes/cadastrar',
                [
                    "categorias" => $categorias
                ],
                'admin'
            );
        } catch (\Exception $e) {
            // Em caso de erro, registre no log e exiba uma mensagem de erro
            error_log("Erro ao cadastrar o filme: " . $e->getMessage());
        }
    }

    public function editar()
    {
        try {

            $model = new FilmeModel();
            $id = $_GET['id'];
            $pagina = isset($_GET["pagina"]) ?? $_GET["pagina"];

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Captura os dados do formulário
                $titulo = $_POST['titulo'];
                $categoria = $_POST['categoria'];
                $embedVideo = $_POST['embedVideo'];
                $imagemCapa = $_FILES['imagemCapa'];
                $imagemDemo = $_FILES['imagemDemo'];
                $ano = $_POST['ano'];
                $pais = $_POST['pais'];
                $dataPublicacao = $_POST['dataPublicacao'];
                $sinopse = $_POST['sinopse'];

                $uploadHelper = new UploadHelper();
                $filmeOld = $model->getFilmeById($id);
                if ($imagemCapa["name"])
                    $imagemCapa = $uploadHelper->UploadEditImagem($imagemCapa, "/capas", $filmeOld["imagemCapa"]);
                else
                    $imagemCapa["name"] = $filmeOld["imagemCapa"];

                if ($imagemDemo["name"])
                    $imagemDemo = $uploadHelper->UploadEditImagem($imagemDemo, "/demo", $filmeOld["imagemDemo"]);
                else
                    $imagemDemo["name"] = $filmeOld["imagemDemo"];

                // Cria uma instância da classe Filme e insere os dados 
                if ($model->updateFilme(
                    $id,
                    $titulo,
                    $categoria,
                    $embedVideo,
                    $imagemCapa["name"],
                    $dataPublicacao,
                    $imagemDemo["name"],
                    $ano,
                    $pais,
                    $sinopse
                )) {
                    $_SESSION["mensagem"] = "<div class='alert alert-success'>Filme atualizado com sucesso!</div>";
                } else {
                    $_SESSION["mensagem"] = "<div class='alert alert-danger'>Erro ao atualizar o filme.</div>";
                }

                header("Location: /admin/filmes?pagina=$pagina");
            }

            $filme = $model->getFilmeById($id);

            $categoriasModel = new CategoriaModel();
            $categorias = $categoriasModel->getAll();

            $this->view(
                'admin/filmes/editar',
                array(
                    "filme" => $filme,
                    "categorias" => $categorias
                ),
                'admin'
            );
        } catch (\Exception $e) {
            // Em caso de erro, registre no log e exiba uma mensagem de erro
            error_log("Erro ao excluir o filme: " . $e->getMessage());
        }
    }

    public function excluir()
    {
        try {
            $id = $_GET["id"];
            $pagina = $_GET["pagina"];
            if ($id) {
                $model = new FilmeModel();
                $registro = $model->getFilmeById($id);

                if ($registro) {
                    $uploadHelper = new UploadHelper();

                    if ($registro["imagemCapa"])
                        $uploadHelper->DeleteFile($registro["imagemCapa"], "capas");

                    if ($registro["imagemDemo"])
                        $uploadHelper->DeleteFile($registro["imagemDemo"], "demo");

                    $model->deleteFilme($id);
                }
            }

            header("Location: /admin/filmes?pagina=$pagina");
        } catch (\Exception $e) {
            throw new Exception("Erro ao excluir o filme: " . $e->getMessage());
        }
    }
}
