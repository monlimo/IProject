<?php

namespace app\services;
use app\traits\TSingleton;
use \PDO;

class Db
{
    use TSingleton;
    protected $conn;
    protected $dbConfig = [
        /*'class' => 'Db',*/
        'driver' => 'mysql',
        'host' => 'localhost',
        'login' => 'root',
        'password' => '',
        'database' => '111'
    ];

   /* public function __construct()  // скрыт т.к. реализую одно единственное подключение к Db
    {*/
        /*var_dump($this->prepareDnsString());*/
        /*$this->conn = new PDO(
            $this->prepareDnsString(),
            $this->dbConfig['login'],
            $this->dbConfig['password']
        );
    }*/
    //Реализация единственного подключения к базе данных - Singleton

   /* protected static $instance = null;

    protected function __construct(){}
    protected function __clone(){}
    protected function __wakeup(){}

    public static function getInstance(){
        if(is_null(static::$instance)){
            static::$instance = new static;
        }
        return static::$instance;
    }*/
    //end||Реализация единственного подключения к базе данных - Singleton

    public function getConnection()
    {
        if(is_null($this->conn)){
            $this->conn = new PDO(
                $this->prepareDnsString(),
                $this->dbConfig['login'],
                $this->dbConfig['password']
            );
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return $this->conn;
    }

    /**
     * @param $sql
     * @param $params
     * @return PDOStatement
     */

    public function query($sql, $params = [])
    {
        $smtp = $this->getConnection()->prepare($sql);  // prepare() - запрос PDO ->  Подготавливает запрос к выполнению
                                                        // и возвращает ассоциированный с этим запросом объект
                                                        // (-> возвращает PDOStatement)

        $smtp->execute($params);                        // execute() -> запрос PDO -> Запускает подготовленный запрос
                                                        // на выполнение
        return $smtp;
    }

    public function fetchAll($sql, $params = [])
    {
        $smtp = $this->query($sql, $params);            // запрос в метод класса Db
        return $smtp->fetchAll();                       //запрос PDO -> возвращает массив, содержащий все строки
                                                        // результирующего набора (ассоциативный массив)
    }
    public function fetchOne($sql, $params =[])
    {
        return $this->fetchAll($sql, $params)[0];        //запрос в метод класса Db -> возвращает массив, содержащий
                                                         //строку результирующего набора с индексом [0]
    }

    public function fetchObject($sql, $params=[], $class)
    {
        $smtp = $this->query($sql, $params);
        $smtp->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $class); //возвращает объект экземпляра переданного класса
        //var_dump($smtp);exit;
        //echo"<br><br>";var_dump($smtp); exit;
        return $smtp->fetch();
        //var_dump($smtp);exit;
    }

    /**
     * Запрос на исполнение
     * @param $sql
     * @param $params
     * @return int - количество обработанных запросом строк
     */
    public function execute($sql, $params = [])
    {
        $this->query($sql, $params);
        return true;
    }

    protected function prepareDnsString() // метод на основе конфигурации генерирующий стринг
    {
        return sprintf(
            "%s:host=%s;dbname=%s;charset=UTF8",
            $this->dbConfig['driver'],
            $this->dbConfig['host'],
            $this->dbConfig['database']
        );
    }

}
