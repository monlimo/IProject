<?php
namespace app\services;
use app\models\SessionsRep;
use app\models\UserRep;
use app\models\User;

//логика проверки авторизации - фронтовая точка (применяем композицию)
class Auth
{
    protected $sessionKey = 'sid';

    public function login($login, $password)
    {
        $user = (new UserRep())->getByLoginPass($login, $password);
        if(!$user){
            return false;
        }
        return $this->openSession($user);
    }

    public function getSessionId()
    {
        $sid = $_SESSION[$this->sessionKey];
        if(!is_null($sid)){
            (new SessionsRep())->updateLastTime($sid);
        }
        return $sid;
    }

    protected function openSession(User $user)
    {
        $model = new SessionsRep();
        $sid = $this->generateStr(); //генерация токена
        $model->createNew($user->getId(), $sid, date("Y-m-d H:i:s"));
        $_SESSION[$this->sessionKey] = $sid; //запоминию токен в сессию
        return true;
    }
    //метод генерации токена
    private function generateStr($length = 10)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;
        while (strlen($code) < $length)
            $code .= $chars[mt_rand(0, $clen)];
        return $code;
    }
}