<?php

require __DIR__ . '/../vendor/autoload.php';

use Neuralpin\HTTPRouter\Router;
use Neuralpin\HTTPRouter\Response;
use Neuralpin\HTTPRouter\Helper\TemplateRender;

$Router = new Router;

$Router->any('/', fn() => 'Hello world!');

$Router->get('/item/:id', fn() => Response::json(
    json_decode((string) new TemplateRender(__DIR__ . '/../data/ItemGet.json'))
));
$Router->post('/item/:id', fn() => Response::json(
    json_decode((string) new TemplateRender(__DIR__ . '/../data/ItemPost.json'))
));

$Router->get('/categories/:id/attributes', fn() => Response::json(
    json_decode((string) new TemplateRender(__DIR__ . '/../data/CategoryAttributesGet.json'))
));

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