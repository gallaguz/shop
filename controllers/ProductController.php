<?php


namespace app\controllers;


use app\engine\App;

class ProductController extends Controller
{
    public function actionIndex()
    {
        $this->actionCatalog();
    }

    public function actionCard()
    {
        $id = (int)App::call()->request->getParams()['id'];;

        if($this->isApi()) {
            $product = App::call()->productRepository->getOneArr($id);
        } else {
            $product = App::call()->productRepository->getOne($id);
        }
        $params = [
            'error' => false,
            'card' => $product
        ];
        $this->runRender('card', $params);
    }

    public function actionCatalog()
    {
        $page = (int)App::call()->request->getParams()['page'];
        $catalog = App::call()->productRepository->showLimit(($page + 1) * 2);
        $params = [
            'error' => false,
            'catalog' => $catalog,
            'page' => ++$page
        ];
        $this->runRender('catalog', $params);
    }
}