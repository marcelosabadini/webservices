<?php
/**
 * Configura o autoloader das bibliotecas usadas no projeto
 * 
 */

require_once __DIR__.'/vendor/symfony-loader/UniversalClassLoader.php';

$loader = new Symfony\Component\ClassLoader\UniversalClassLoader;
$loader->registerNamespace(array(
    'Phpmg'             => __DIR__ . '/src',
    'Respect\\Rest'     => __DIR__ . '/vendor/respect-rest/library',
    'Respect\\Config'   => __DIR__ . '/vendor/respect-config/library'
));