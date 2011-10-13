<?php
/*
 * PHP-MG - Grupo de desenvolvedores de PHP de Minas Gerais (http://phpmg.org)
 * 
 */

defined('CONFIG_FILE') or
    define('CONFIG_FILE', __DIR__ . '/../config.ini');

require_once __DIR__ . '/../autoloader.php';

use Respect\Config\Container;

// Obtem o container de dependências
$app = new Container(CONFIG_FILE);

/**
 * Registra a rota que responderá pela
 * consulta de CEP ao banco de dados
 * 
 * @TODO Descobrir como usar os filtros "when" e o tipo de request "accept" em classes "Routable"
 */
$app->router->get('/cep/*/formato/*', $app->webserviceCEP);

/**
 * para qualquer outra rota lança um erro 404
 */
$app->router->get('/**', function()
{
    header("HTTP/1.1 404 Not Found");
    return null;
});