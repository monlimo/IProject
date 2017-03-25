<?php
header("Content-type: text/html;charset=utf-8");
include_once "../services/Autoloader.php"; //подключение файла автозагрузчика - 1 include но будет)) (у нас загружает нужный класс)
include_once "../vendor/autoload.php";
spl_autoload_register([new Autoloader(), 'loadClass']);//загружает автозагрузчики в стек.

(new \app\controllers\FrontController())->run();

//$product = new app\models\Product();
//var_dump($product->getById(3));
//до 4го урока
/*$product = new app\models\Product();
var_dump($product->getById(3));*/

//4й урок
//перенесено во FrontController


/*function test(IModel $object){  //реализация полиморфизма -> один интерфейс - множество реализаций
    $object->getById($id);
}*/

//тест на вывод DB
/*var_dump( \app\services\Db::getInstance());

object(app\services\Db)#4 (2) {
["conn":protected]=>
  NULL
  ["dbConfig":protected]=>
  array(5) {
    ["driver"]=>
    string(5) "mysql"
    ["host"]=>
    string(9) "localhost"
    ["login"]=>
    string(4) "root"
    ["password"]=>
    string(0) ""
    ["database"]=>
    string(8) "shopshop"
  }
}*/

/*echo 'Доступные драйвера:';
print_r(PDO::getAvailableDrivers());
$pdo = new PDO('sqlite:my.db');
echo 'Объект PDO:';
print_r($pdo);*/


