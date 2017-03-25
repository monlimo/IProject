<?php
namespace app\models;
use app\services\Db;

//логика получени€ информации о пользователе (User) - проверкка из базы и возвращение его экземпл€ра
class UserRep
{
    /** @var Db */
    private $conn = null;
    protected $nestedClass = 'app\models\User';

    public function __construct()
    {
        $this->conn = Db::getInstance();
    }
    /**
     * @return User
     * */
    //позвол€ет получить пользовател€ по логину и паролю
    public function getByLoginPass($login, $pass)
    {
        //пароль можно указать позже в md5 - если он в базе будет захеширован
        return $this->conn->fetchObject(
            sprintf(
            "SELECT u.* FROM users u
              WHERE login = '%s' AND password = '%s'", $login, $pass
            ), [], $this->nestedClass
        );
    }
    /** @return User */
    public function getById($id)
    {
        return $this->conn->fetchObject(
            "SELECT u.* FROM users u WHERE u.id = ?", [$id], $this->nestedClass
        );
    }
}