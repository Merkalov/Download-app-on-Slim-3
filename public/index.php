<?php
/**
 * Created by PhpStorm.
 * User: makar
 * Date: 16.07.2017
 * Time: 12:50
 */
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\UploadedFile;

require '../vendor/autoload.php';

$app = new \Slim\App();

// Get container
$container = $app->getContainer();

// Register component on container
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig('templates', [
        'cache' => false
    ]);
    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};

$app->get('/', function ($request, $response, $args) {
    return $this->view->render($response, 'main.html', [
    ]);
});

$app->run();