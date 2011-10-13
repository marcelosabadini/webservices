<?php
/*
 * PHP-MG - Grupo de desenvolvedores de PHP de Minas Gerais (http://phpmg.org)
 * 
 */

use Respect\Config\Container;
use Webservice\Server\Cep;

/*
 * Full path to the library directory. Should be something like:
 * define('LIBS', '/usr/lib/php/');
 * But we need the libs at GitHub.
 *
 */
define('LIBS', __DIR__ . '/../library');
set_include_path(get_include_path() . PATH_SEPARATOR . LIBS);
spl_autoload_register(require 'Respect/Loader.php');

$app = new Container('../config.ini');

#TODO Descobrir como usar os filtros "when" e o tipo de request "accept" em classes "Routable"
$app->router->get('/cep/*/*', new Cep);

$app->router->get('/**', function()
{
    header("HTTP/1.1 404 Not Found");
    return null;
});