<?php
namespace Ulisesrendon\Melifakeendpoint\Category\Controller;

use Neuralpin\HTTPRouter\Response;
use Neuralpin\HTTPRouter\Helper\TemplateRender;
use Neuralpin\HTTPRouter\RequestData as Request;
use Neuralpin\HTTPRouter\Interface\ResponseState;

class CategoryController
{
    public function getCategoryAttributes(string $id, Request $Request): ResponseState
    {
        return Response::json(json_decode((string) new TemplateRender(__DIR__ . '/../Data/getCategoryAttributes.json')));
    }
}