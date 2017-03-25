<?php
namespace app\controllers;
use app\services\Auth;

//�������� ������ �� ������������� - �� ��������� � �� ����� �� ���� ������
//��� ����������� �������� � ������ Auth
class AuthController extends Controller
{
    //protected $useLayout = false;

    public function actionIndex()
    {
        if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['login'])){
            if((new Auth())->login($_POST['login'], $_POST['pass'])){
               $this->redirect("product");
            }
        }
        $this->render('login'); //render - ���������� ����� ����������� ��������
    }
}