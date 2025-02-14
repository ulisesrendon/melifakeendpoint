<?php

require __DIR__ . '/../vendor/autoload.php';

use Neuralpin\HTTPRouter\Router;
use Ulisesrendon\Melifakeendpoint\Category\Controller\CategoryController;
use Ulisesrendon\Melifakeendpoint\Product\Controller\ItemController;

$Router = new Router;
$Router->any('/', fn() => 'Hello world!');

$Router->get('/item/:id', [ItemController::class, 'getItem']);
$Router->post('/item/:id', [ItemController::class, 'postItem']);
$Router->get('/categories/:id/attributes', [CategoryController::class, 'getCategoryAttributes']);

try {

    $Controller = $Router->getController();

} catch (\Exception $Exception) {
    if ($Router->isNotFoundException($Exception)) {
        $Controller = $Router->wrapController(
            fn() => 'Error 404 Page not found!'
        );
    } elseif ($Router->isMethodNotAllowedException($Exception)) {
        $Controller = $Router->wrapController(
            fn() => 'Error 405 Method not supported!'
        );
    } else {
        $Controller = $Router->wrapController(
            fn() => 'Server error 500'
        );
    }
}

echo $Controller->getResponse();