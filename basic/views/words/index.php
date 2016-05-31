<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'En Words';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="en-words-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create En Words', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'created',
            //'updated',
            //'status',
            //'author',
            // 'theme_id',
            'word',
            'translate',
            // 'trancription',
            // 'type',
            'infinitive',
            'past_simple',
            'past_participle',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
