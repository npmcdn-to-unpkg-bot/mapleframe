<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EnThemes */

$this->title = 'Create En Themes';
$this->params['breadcrumbs'][] = ['label' => 'En Themes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="en-themes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
