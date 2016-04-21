<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html class="Mi_scroll" lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="Mi_body">
<?php $this->beginBody() ?>

<div class="Mi_wrapper">
    
    <header class="Mi_header"></header>
    <?php
    /*
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            //'class' => 'navbar-inverse navbar-fixed-top',
            'class' => 'Mi_navi',
        ],
        'innerContainerOptions' => [
            'class' => 'Mi_navi_container',
        ],
        'containerOptions' => [
            'class' => 'Mi_navi_collapse',
        ],
        'brandOptions' => [
            'class' => 'Mi_navi_brand', 
        ]
    ]);
    echo Nav::widget([
        //'options' => ['class' => 'navbar-nav navbar-right'],
        'options' => ['class' => 'Mi_navi_list'],
        'items' => [
            [
                'label' => 'Home',
                'url' => ['/site/index'],
                'linkOptions'=>['class'=>'Mi_navi_link'],
                'options'=>['class'=>'Mi_navi_element']
            ],
            [
                'label' => 'About',
                'url' => ['/site/about'],
                'linkOptions'=>['class'=>'Mi_navi_link'],
                'options'=>['class'=>'Mi_navi_element']
            ],
            [
                'label' => 'Contact',
                'url' => ['/site/contact'],
                'linkOptions'=>['class'=>'Mi_navi_link'],
                'options'=>['class'=>'Mi_navi_element']
            ],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    */
    ?>

    <div class="Mi_container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="Mi_footer">
    <div class="Mi_container">
        <p class="Mi_pph pull-left">&copy; My Company <?= date('Y') ?></p>
        <p class="Mi_pph pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
