<?php

use Clover\Nano\Bootstrap;
use Clover\Nano\Startup;

require __DIR__ . '/../../vendor/autoload.php';

try {
    $startup = new Startup('nano', 'staging', true);
    $boot = new Bootstrap();
    $boot->__invoke();
} catch (Throwable $e) {
    header('Content-type: text/html; charset=UTF-8', true, 500);
    die($e->getMessage());
} catch (Exception $e) {
    header('Content-type: text/html; charset=UTF-8', true, 500);
    die($e->getMessage());
}