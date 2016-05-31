<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EnWords */

$this->title = 'Create En Words';
$this->params['breadcrumbs'][] = ['label' => 'En Words', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="en-words-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
