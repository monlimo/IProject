<?php
class Autoloader
{
    //2й вариант
    public function loadClass($className)
    {
        //var_dump($className);
        $className = str_replace("app", "..", $className);
        $className = str_replace('\\', "/", $className . ".php");
        require_once ($className);
        //var_dump($className);
    }

    // 1й варивнт - создаю метод loadClass, используя пространства имен, данный скрываю
   /* public $paths = [
        'models/',
        'services/',
        'traits'
    ];

    public function loadClass($className)
    {
        var_dump($className);
        foreach ($this->paths as $dir){
            $filename = "./{$dir}{$className}.php";
            if(file_exists($filename)){
                require_once ($filename);
                break;
            }
        }
    }*/
}

