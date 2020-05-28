<?php

use Clover\Nano\Startup;
use Clover\Nano\Bootstrap;

require __DIR__ . '/../../utils/autoload.php';

try {
    $startup = new Startup('nano', 'production', false);
    $boot = new Bootstrap();
    $boot->__invoke();
} catch (Throwable $e) {
    header('Content-type: text/html; charset=UTF-8', true, 500);
    die($e->getMessage());
} catch (Exception $e) {
    header('Content-type: text/html; charset=UTF-8', true, 500);
    die($e->getMessage());
}