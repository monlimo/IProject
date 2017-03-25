<?php
namespace app\models;
use app\services\Db;

//������ ��������� ���������� � ������������ (User) - ��������� �� ���� � ����������� ��� ����������
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
    //��������� �������� ������������ �� ������ � ������
    public function getByLoginPass($login, $pass)
    {
        //������ ����� ������� ����� � md5 - ���� �� � ���� ����� �����������
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