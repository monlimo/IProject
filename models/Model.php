<?php
/*interface IModel
{
    public static function getById($id);
    public static function getAll();
}

interface Ilog
{
    public static function log($message);
}
*/
/*abstract class Model implements IModel*/

namespace app\models;
use app\services\Db;

abstract class Model
{
    protected static $db;

    abstract static function getTableName();

    /*public static function getById($id)
    {
        $table = static::getTableName();
        $sql = "SELECT * FROM {$table} WHERE id = {$id}";
        $res = Db::getInstance()->query($sql);
        return new Product($res);
    }*/
    // через PDO:

    public static function getById($id)
    {
        $table = static::getTableName();
        /*$sql = "SELECT * FROM {$table} WHERE id = :id AND name = :name";
        return Db::getInstance()->fetchOne($sql, [":id" => $id, ":name" => 'Яблоко']);*/

        $sql = "SELECT * FROM {$table} WHERE id = :id";
        //echo"<br><br>";var_dump(get_called_class()); exit;
        return Db::getInstance()->fetchObject($sql, [":id" => $id], get_called_class());
    }

    public static function getAll()
    {
        $table = static::getTableName();
        $sql = "SELECT * FROM {$table}";
        return Db::getInstance()->fetchAll($sql);
    }

}