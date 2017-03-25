<?php
namespace app\services;

class RequestManager
{
    protected $requestString;
    protected $controllerName;
    protected $actionName;
    protected $params;

    protected $rules = [
        '#(?P<controller>\w+)[/]?(?P<action>\w+)?[/]?(?P<params>.*)#u'
    ];

    /**
     * RequestManager constructor.
     */
    public function __construct()
    {
        $this->parseRequest();
    }

    public function parseRequest()
    {
        $this->requestString = $_SERVER['REQUEST_URI'];

        //переход на парсинг через регулярные выражения
        /*$result = explode("/", $this->requestString);
        $this->controllerName = $result[1];
        $this->actionName = $result[2];
        var_dump($result);
        var_dump($this);*/

        //через регулярные выражения
        foreach($this->rules as $rule) {
            if(preg_match_all($rule, $this->requestString, $matches)){
                $this->controllerName = $matches['controller'][0];
                $this->actionName = $matches['action'][0];
                $this->params = array_merge(explode("/",$matches['params'][0]), $_REQUEST);
                break;
            }
        }//var_dump($this);
    }


    /**
     * @return mixed
     */
    public function getRequestString()
    {
        return $this->requestString;
    }

    /**
     * @return mixed
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * @return mixed
     */
    public function getActionName()
    {
        return $this->actionName;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }


}