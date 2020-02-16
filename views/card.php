<?php
/**
 * @var \app\models\Products $product
 */

?>
<h2><?=$product->name?></h2>
<img width="200" src="/img/<?=$product->img?>"><br>
<p><?=$product->description?></p>
<p>Цена: <?=$product->price?></p>
