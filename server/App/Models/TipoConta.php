<?php


class TipoConta
{
    public $id;
    public $descricao;
    public $pagar;
    public $receber;
}

/*

Id | Descrição | Pagar | Receber 
1 | Coleta | N | S
2 | Doação | N | S
3 | Evento | N | S
4 | Compra Remédio | N | S
5 | Compra Alimento | N | N
2 | Décima | S | N

*/