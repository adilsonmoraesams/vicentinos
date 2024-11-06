<?php



namespace App\Controllers;

use App\Helpers\UploadHelper;
use App\Models\CategoriaModel;
use App\Models\ContatoModel;
use Core\Controller;
use App\Models\FilmeModel;
use Exception;

class ContatoController extends Controller
{

    public $itensPorPagina = 5;
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
        $contatoModel = new ContatoModel();
        $contatos = $contatoModel->getAll($this->itensPorPagina, $this->offset);
        $totalFilmes = $contatoModel->getTotal();
        $totalPaginas = ceil($totalFilmes / $this->itensPorPagina);

        $this->view(
            'admin/contato/index',
            array(
                "contatos" => $contatos,
                "totalPaginas" => $totalPaginas
            ),
            'admin'
        );
    }

    public function visualizar()
    {
        try {

            $model = new ContatoModel();
            $id = $_GET['id'];

            $contato = $model->getById($id);

            $this->view(
                'admin/contato/visualizar',
                array(
                    "contato" => $contato
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
                $model = new ContatoModel();
                $registro = $model->getById($id);

                if ($registro) {
                    $model->delete($id);
                }
            }

            header("Location: /admin/contato?pagina=$pagina");
        } catch (\Exception $e) {
            throw new Exception("Erro ao contato realizado pelo site: " . $e->getMessage());
        }
    }
}
