<?php

namespace App\Controllers;

use App\Models\MembrosModel;
use Core\Controller;
use Exception;

class MembrosController extends Controller
{

    private $_situacao = array(
        array("id" => 1, "name" => "Apoio"),
        array("id" => 2, "name" => "Aspirante"),
        array("id" => 3, "name" => "Confrade"),
        array("id" => 4, "name" => "Consórcia"),
    );


    public function index()
    {
        $model = new MembrosModel();

        // Parâmetros de paginação
        $itensPorPagina = 5;
        $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

        // Calcula o offset
        $offset = ($paginaAtual - 1) * $itensPorPagina;

        // Obtem a lista de membros com paginação
        $membros = $model->getAll($itensPorPagina, $offset);

        // Obtem o total de membros para calcular o número total de páginas
        $totalMembros = $model->getTotal();
        $totalPaginas = ceil($totalMembros / $itensPorPagina);

        $this->view(
            'membros/index',
            [
                "membros" => $membros,
                "situacao" => $this->_situacao,
                "totalPaginas" => $totalPaginas
            ],
            'admin'
        );
    }

    public function cadastrar()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Captura os dados do formulário
                $nome = $_POST['nome'];
                $dataNascimento = $_POST['dataNascimento'];
                $situacao = $_POST['situacao'];

                // Instancia o modelo e insere os dados do membro
                $model = new MembrosModel();
                if ($model->insert($nome, $dataNascimento, $situacao)) {
                    $_SESSION["mensagem"] = "<div class='alert alert-success'>Membro cadastrado com sucesso!</div>";
                } else {
                    $_SESSION["mensagem"] = "<div class='alert alert-danger'>Erro ao cadastrar o membro.</div>";
                }

                header("Location: /membros");
            }

            $this->view(
                'membros/cadastrar',
                ["situacao" => $this->_situacao],
                'admin'
            );
        } catch (Exception $e) {
            error_log("Erro ao cadastrar o membro: " . $e->getMessage());
        }
    }

    public function editar()
    {
        try {
            $model = new MembrosModel();
            $id = $_GET['id'];
            $pagina = $_GET["pagina"] ?? 1;

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Captura os dados do formulário
                $nome = $_POST['nome'];
                $dataNascimento = $_POST['dataNascimento'];
                $situacao = $_POST['situacao'];

                // Atualiza os dados do membro
                if ($model->update($id, $nome, $dataNascimento, $situacao)) {
                    $_SESSION["mensagem"] = "<div class='alert alert-success'>Membro atualizado com sucesso!</div>";
                } else {
                    $_SESSION["mensagem"] = "<div class='alert alert-danger'>Erro ao atualizar o membro.</div>";
                }

                header("Location: /admin/membros?pagina=$pagina");
            }

            $membro = $model->getById($id);

            $this->view(
                'membros/editar',
                [
                    "membro" => $membro
                ],
                'admin'
            );
        } catch (Exception $e) {
            error_log("Erro ao editar o membro: " . $e->getMessage());
        }
    }

    public function excluir()
    {
        try {
            $id = $_GET["id"];
            $pagina = $_GET["pagina"];
            if ($id) {
                $model = new MembrosModel();
                $model->delete($id);
            }

            header("Location: /membros?pagina=$pagina");
        } catch (Exception $e) {
            throw new Exception("Erro ao excluir o membro: " . $e->getMessage());
        }
    }
}
