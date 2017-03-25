<?php
    /** @var app\models\Product $model */
?>
<p>Карточка продукта:</p>
<img src="#">
<h2>
    <?=$model->name?>
</h2>
<p>
    <?=$model->description?>
</p>
<p>Цена : <?=$model->price?> рублей.</p>
