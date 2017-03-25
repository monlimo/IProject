<?php
namespace app\controllers;

use app\interfaces\IRenderer;

class Controller
{
    protected $action;
    protected $defaultAction = 'index';
    protected $layout = 'main';
    protected $useLayout = true;

    protected $renderer = null;

    /**
     * Controller constructor.
     * @param null $renderer
     */
    public function __construct(IRenderer $renderer = null)
    {
        $this->renderer = $renderer;
    }
    //предыдущий вариант до инверсии и имплементорвания интерфейса
    /*public function __construct()
    {
        $this->renderer = new TemplateRenderer();
    }*/

    /*public function actionIndex()
    {
        $this->redirect("product");
    }*/

    public function run($action = null)
    {
        $this->action = $action?:$this->defaultAction;
        //$method = 'action' . ucfirst($this->action); //7
        //$this->$method(); // 7
        $action = 'action' . ucfirst($this->action);
        $this->beforeAction();
        //var_dump($action);
        $this->$action();
        $this->afterAction();
    }

    //подготовка данных для отображение шаблонов, а отображение в зависимости от выбранного рендера (указывается в
    // конструкторе контроллера - renderer);

    public function render($template, $params = [])
    {
        $template = lcfirst(str_replace(['Controller', 'app\controllers\\'], '', get_called_class()))."/".$template;
        if($this->useLayout){
            echo $this->renderTemplate('layouts/main', [
                'content' => $this->renderTemplate($template, $params)
            ]);
        } else {
            echo $this->renderTemplate($template, $params);
        }
    }

    public function renderTemplate($template, $params = [])
    {
        return $this->renderer->render($template, $params);
    }

    /**
     * Метод, который будет выполнен непосредственно перед действием
     */
    protected function beforeAction(){}

    /**Метод, который будет выполнен сразу после действия
     *
     */
    protected function afterAction(){}

    public function redirect($url){
        header("Location: /{$url}");
    }
}