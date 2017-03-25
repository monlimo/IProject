<?php

namespace app\controllers;

use app\models\Product;
use app\services\RequestManager;

class ProductController extends Controller
{
    protected $useLayout = true;

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionCard()
    {
        //$id = $_GET['id'];
        $id = (new RequestManager())->getParams()[0];
        $this->render('card', ['model' => Product::getById($id)]);
    }
}