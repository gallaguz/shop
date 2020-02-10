<?php


namespace app\controllers;


use app\engine\App;
use app\engine\Request;
use app\models\repositories\ProductRepository;

class ProductController extends Controller
{

    public function actionIndex() {
        echo $this->render('index');
    }

    public function actionCatalog()
    {
        $page = (int)App::call()->request->getParams()['page'];

        $catalog = App::call()->productRepository->showLimit(($page + 1) * 2);

        echo $this->render('catalog', [
            'catalog' => $catalog,
            'page' => ++$page
        ]);
    }

    public function actionApiCatalog()
    {
        $catalog = App::call()->productRepository->getAll();
        echo json_encode($catalog, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function actionCard()
    {
        $id = (int)App::call()->request->getParams()['id'];;
        $product = App::call()->productRepository->getOne($id);
        echo $this->render('card', ['product' => $product]);
    }



}