<?php


namespace app\controllers;


use app\engine\App;
use app\engine\SimpleImage;
use app\models\entities\ProductEntity;

class ProductController extends Controller
{
    public function actionIndex()
    {
        $this->actionCatalog();
    }

    public function actionAdd ()
    {
        $file = $_FILES['file'];
        $imgDir = '../public/img';

        $title = App::call()->request->getParams()['title'];
        $price = App::call()->request->getParams()['price'];
        $description = App::call()->request->getParams()['description'];
        $big = $imgDir . '/big/' .$file["name"];
        $small = $imgDir . '/small/'.$file['name'];

        if (!move_uploaded_file($file["tmp_name"], $big)) {
            $error[] = 'Не удалось сохранить файл';
        }

        $image = new SimpleImage();
        $image->load($big);
        $image->resizeToWidth(150);
        $image->save($small);

        $product = new ProductEntity(
            $title,
            $description,
            (int)$price,
            $file['name']
        );

        App::call()->productRepository->save($product);


        $params = [
            'error' => false,
            'small' => $small,
            'big' => $big,
            'title' => $title,
            'price' => $price,
            'description' => $description
        ];

        header('Content-Type: application/json');
        echo json_encode($params);
    }

    public function actionSearch ()
    {
        $query = App::call()->request->getParams()['query'];

        $items = App::call()->productRepository->getAllWhereLIKE('title', $query);

        $params = [
            'error' => false,
            'items' => $items
        ];
        $this->runRender('card', $params);
    }

    public function actionCard()
    {
        $id = (int)App::call()->request->getParams()['id'];

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