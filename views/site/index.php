<?php

use yii\helpers\Url;

?>

<div class="page">
    <p class="number"><?= $model->number ?? 0 ?></p>
    <form action="<?=Url::to('/site/index')?>" method="GET">
        <input type="hidden" value="1" name="increment">
        <button class="btn" type="submit">+1</button>
    </form>
</div>