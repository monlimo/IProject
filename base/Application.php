<?php
namespace app\base;
use app\controllers\Controller;
use app\models\User;
use app\services\Auth;
use app\services\Db;
use app\services\RequestManager;
use app\services\TemplateRenderer;

/**
 * Class Application
 * @package app\base
 * @property Controller mainController
 * @property Db db
 * @property RequestManager request
 * @property TemplateRenderer renderer
 * @property Auth auth
 * @property User user
 *
 */

class Application
{
    protected $config;
    /** @var  Container */
    protected $storage;
    protected static $instance;

    /** @return static */
    public static function call()
    {
        if(is_null(self::$instance)){
            self::$instance = new static;
        }
        return self::$instance;
    }
    // Именно от сюда будет запускаться вся логика
    public function run()
    {
        $this->config = include "../config/main.php";
        $this->autoload();
        $this->storage = new Container();
        //var_dump($this->mainController);exit;
        $this->mainController->run();
    }

    public function autoload(){
        include_once "../services/Autoloader.php";
        include_once "../vendor/autoload.php";
        spl_autoload_register([new \Autoloader(), 'loadClass']);
    }

    public function createComponent($name, $params = [])
    {
        if(isset($this->config['components'][$name])){
            $params = $this->config['components'][$name];
            $class = $params['class'];
            unset($params['class']);
            $reflection = new \ReflectionClass($class);
            return $reflection->newInstanceArgs($params);
        }
    }

    function __get($name)
    {
        return $this->storage->get($name);
    }


}