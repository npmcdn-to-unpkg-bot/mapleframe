<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html class="Mi_scroll" lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= Html::encode($this->title) ?></title>
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
    <link rel="stylesheet" href="<?php echo Yii::getAlias('@web/css/angular.css'); ?>">
   <?php /*<script src="<?php echo Yii::getAlias('@web/js/angular/1.5.5/angular.min.js'); ?>"></script>
   <script src="<?php echo Yii::getAlias('@web/js/angular/1.5.5/angular-route.min.js'); ?>"></script> */?>
</head>
<body class="Mi_body Mia_body">
<?php $this->beginBody() ?>
    <header class="Mi_header Mia_header Gi_text_align_center">
        <ul id="navi" class="Mia_navi Gi_clear">
            <li data-index="0" class="Mia_navi__elem active"></li><!--
            --><li data-index="1" class="Mia_navi__elem"></li><!--
            --><li id="qwerty" class="Mia_navi__elem emblem"></li><!--
            --><li data-index="2" class="Mia_navi__elem"></li><!--
            --><li data-index="3" class="Mia_navi__elem"></li>
        </ul>
    </header>
    <div id="wrapper" class="Mi_wrapper Mia_wrapper Gi_clear">
        <div style="width:400%;height:100%;">
            <table style="width:100%;">
                <tr>
                    <td style="width:25%;">
                        <div class="Mi_container Mia_container">
                            <h2>Angular page one</h2>
                            <h4 style="margin:0 0 30px;">description</h4>
                            <ul style="list-style:none;">
                                <li><a id="_piw" href="" class="">Отправить сообщение Worker</a></li>
                                <li><a class="">Отправить Worker</a></li>
                                <li><a class="">Cообщение Worker</a></li>
                                <li><a class="">Отправить</a></li>
                                <li><a class="">Cообщение</a></li>
                            </ul>
                            <?//= $content ?>
                        </div>
                    </td>
                    <td style="width:25%;">
                        <div class="Mi_container Mia_container">
                            <h2>Angular page two</h2>
                            <h4>description</h4>
                        </div>
                    </td>
                    <td style="width:25%;">
                        <div class="Mi_container Mia_container">
                            <h2>Angular page three</h2>
                            <h4>description</h4>
                        </div>
                    </td>
                    <td style="width:25%;">
                        <div class="Mi_container Mia_container">
                            <h2>Angular page four</h2>
                            <h4>description</h4>
                        </div>
                    </td>
                </tr>
            </table>
        <div>
        <!-- 
        <div class="Mi_container Mia_container">
            <h2>Angular page two</h2>
            <h4>description</h4>
        </div>
        <div class="Mi_container Mia_container">
            <h2>Angular page tree</h2>
            <h4>description</h4>
        </div>
        <div class="Mi_container Mia_container">
            <h2>Angular page four</h2>
            <h4>description</h4>
        </div>-->
        
    </div>
    <footer style="display:none;" class="Mi_footer"></footer>
<?php $this->endBody() ?>
<script src="<?php echo Yii::getAlias('@web/js/mia.js'); ?>"></script>
</body>
</html>
<?php $this->endPage() ?>