<?php

//namespace app\models; //- или так или

/*use app\models\Model as MyModel; // или так, толькл чтобы все классы подключались
use vendor\new\Model;
class Product extends MyModel*/

namespace app\models;

class Product extends Model
{
    public $id;
    public $name;
    public $description;
    public $price;

    protected static $tableName = 'product';

    static function getTableName()
    {
        return static::$tableName;
    }
}



