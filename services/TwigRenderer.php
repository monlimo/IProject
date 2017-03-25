<?php
namespace app\services;
use app\interfaces\IRenderer;
use Twig_Loader_Filesystem;

class TwigRenderer implements IRenderer
{
    protected $templateDir;
    protected $templater;

    /**
     * TwigRenderer constructor.
     * @param $templateDir
     */
    //инициализация Twig
    public function __construct()
    {
        $this->templateDir = $_SERVER['DOCUMENT_ROOT'] . "/../views";
        $loader = new Twig_Loader_Filesystem($this->templateDir); //путь к шабллонам
        $this->templater = new \Twig_Environment($loader);
    }

    public function render($template, $params)
    {
        $template = "{$template}.php";
        $template = $this->templater->loadTemplate($template);
        return $template->render($params);
    }
}