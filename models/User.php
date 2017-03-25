<?php
namespace app\models;
use app\services\Auth;
//информация о пользователе

class User
{
    protected $id;
    protected $login;
    protected $password;
    protected $email;
    protected $sessionId;

    public function getId()
    {
        return $this->id;
    }

    /** @return static */
    public function getCurrent()
    {
        $userId = $this->getUserId();
        if($userId){
            return (new UserRep())->getById($userId);
        }
        return null;
    }

    protected function getUserId()
    {
        $sid = (new Auth())->getSessionId();
        if(!is_null($sid)){
            return (new SessionsRep())->getUidBySid($sid);
        }
        return null;
    }
}