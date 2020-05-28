<?php

use Swoole\Runtime;
use Simps\Application;
use Clover\Nano\Startup;

if (php_sapi_name() !== 'cli')
    return;

require __DIR__ . '/../../utils/autoload.php';
$startup = new Startup('nano', 'production', false);

define('IN_SWOOLE', true, true);
define('CONFIG_PATH', APP_PATH . 'configs/server/', true);
Runtime::enableCoroutine(SWOOLE_HOOK_ALL);
Application::run();
