<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EnWords */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'En Words', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="en-words-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created',
            'updated',
            'status',
            'author',
            'theme_id',
            'word',
            'translate',
            'trancription',
            'type',
            'infinitive',
            'past_simple',
            'past_participle',
        ],
    ]) ?>

</div>
