<?php

namespace Ulisesrendon\Melifakeendpoint\Product\Controller;

use Neuralpin\HTTPRouter\Response;
use Neuralpin\HTTPRouter\Helper\TemplateRender;
use Neuralpin\HTTPRouter\RequestData as Request;
use Neuralpin\HTTPRouter\Interface\ResponseState;

class ItemController
{
    public function getItem(string $id, Request $Request): ResponseState
    {
        return Response::json(json_decode((string) new TemplateRender(__DIR__.'/../Data/getItem.json')));
    }

    public function postItem()
    {
        return Response::json(json_decode('
        {
            "id": "MLB1374737433",
            "site_id": "MLB",
            "title": "Item De Teste - Não Comprar",
            "base_price": 10,
            "initial_quantity": 0,
            "available_quantity": 0,
            "sold_quantity": 0,
            "status": "paused",
            "sub_status": [
                "out_of_stock"
            ]
        }
        '));
    }
}