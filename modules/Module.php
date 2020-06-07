<?php

namespace Module;

use Model\Loader;
use Clover\Nano\Core\Model;
use Clover\Nano\Core\App;
use Clover\Nano\Exception\InternalError;
use ReflectionClass;
use ReflectionException;

/**
 * Class Module
 * @property Loader $Model
 * @property Mime $Mime
 * @property Settings $Settings
 */
final class Module
{
    /**
     * @var App
     */
    protected $app;

    /**
     * @var array
     */
    protected $components = [];

    /**
     * Module constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
    }

    /**
     * @param $className
     * @return object
     * @throws InternalError
     */
    final public function getModule($className)
    {
        if (!isset($this->components[$className])) {
            if (class_exists($className)) {
                try {
                    $params = [$this->app, $this];
                    $refClass = new ReflectionClass($className);
                    $object = $refClass->newInstanceArgs($params);
                    $this->components[$className] = $object;
                    return $object;
                } catch (ReflectionException $ex) {
                    throw new InternalError($ex->getMessage());
                }
            } else
                throw new InternalError("Module Not Found:{$className}");
        }
        return $this->components[$className];
    }


    /**
     * @param $name
     * @return mixed
     * @throws InternalError
     */
    public function __get($name)
    {
        $className = $name === 'Model' ? "Model\\Loader" : "Module\\{$name}";

        if (!isset($this->components[$name])) {
            if (class_exists($className))
                $this->components[$name] = $this->getModule($className);
            else
                throw new InternalError("Module({$name}) not found.");
        }
        return $this->components[$name];
    }
}