<?php
namespace app\controllers;
use app\models\User;
use app\services\RequestManager;

class FrontController extends Controller
{
    //7
    protected $controllerName;
    protected $actionName;

    public function actionIndex()
    {
        $rm = new RequestManager();
        //exit;
        //this-> //7
        $this->controllerName = $rm->getControllerName();
        $this->actionName = $rm->getActionName();
        $this->checkUser(); //7
        $this->controllerName = sprintf('app\controllers\%sController',ucfirst($this->controllerName));

        //инициализация контроллера с передачей объекта реализации рендера. (либо TemlateRenderer либо TwigRenderer)
        //при создании экземпляра контроллера, в контроллере родителе в конструкторе созндается экземпляр Templaterenderer.
        /** @var Controller $controller */
        $controller = new $this->controllerName(new \app\services\TemplateRenderer());
        //$controller = new $this->controllerName(new \app\services\TwigRenderer());

        $controller->run($this->actionName);
    }

    protected function checkUser()
    {
        session_start();
        //var_dump($this->controllerName);exit;
        if ($this->controllerName != 'auth') {
            $user = (new User())->getCurrent();
            //var_dump($user);
            if (!$user) {
                $this->redirect('auth');
            }
        }
    }
}