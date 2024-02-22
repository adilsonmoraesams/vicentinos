<?php


namespace Controller;

use App\Data\ClienteRepository;
use App\Models\Cliente;
use System\BaseApi\EnumRequestTipo;
use System\BaseApi\EnumRequestValidacao;
use System\BaseApi\Request;
use System\BaseApi\Response;
use System\Logs;


class ClientesController extends Request
{    
    protected $ClienteRepository;
    protected $request;

    public function __construct()
    {
        $this->ClienteRepository = new ClienteRepository();
        $this->request = new Request();
    }


    /*
     * Listar todos os clientes 
    */
    public function Listar()
    {
        $result = $this->ClienteRepository->getClientes();

        return Response::HttpResponseOK($result);
    }


    /*
     * Cadastrar novo cliente 
    */
    public function Cadastrar()
    {
        $cliente = new Cliente();
        $cliente->Nome = parent::post("nome", EnumRequestValidacao::Obrigatorio);
        $cliente->DataNascimento = parent::post("datanascimento", EnumRequestValidacao::Obrigatorio);

        $result = $this->ClienteRepository->InsertCliente($cliente);

        return Response::HttpResponseOK($result);
    }


    /*
     * Consultar cliente pela chave
    */
    public function Consultar($id)
    {        

        $aaa = parent::get("a", EnumRequestTipo::int); 
       
        if (!$id)
            return Response::HttpResponseErrorMissing("Informe o parametro para prosseguir.");

        $result = $this->ClienteRepository->getByIdClientes($id);
        if ($result == null)
            return Response::HttpResponseErrorBadRequest("Cliente não existe.");
 
        return Response::HttpResponseOK($result);
    }


    /*
     * Editar cliente 
    */
    public function Editar($id)
    {
        if (!$id)
            return Response::HttpResponseErrorMissing("Informe o parametro para prosseguir.");

        $cliente = $this->ClienteRepository->getByIdClientes($id);
        if ($cliente == null)
            return Response::HttpResponseErrorBadRequest("Cliente não existe.");
            
        $cliente->Nome = parent::post("Nome", EnumRequestValidacao::Obrigatorio);
        $cliente->DataNascimento = parent::post("DataNascimento", EnumRequestValidacao::Obrigatorio);
        $editado = $this->ClienteRepository->EditarCliente($cliente, $id);

        return Response::HttpResponseOK($editado);
    }


    /*
     * Excluir cliente
    */
    public function Excluir($id)
    {
        if (!$id)
            return Response::HttpResponseErrorMissing("Informe o parametro para prosseguir.");

        $cliente = $this->ClienteRepository->getByIdClientes($id);
        if ($cliente == null)
            return Response::HttpResponseErrorBadRequest("Cliente não existe.");

        $this->ClienteRepository->ExcluirCliente($cliente);

        Response::HttpResponseOK(
            array(
                "status" => true,
                "message" => "Cliente excluido com sucesso"
            )
        );
    }

    
}