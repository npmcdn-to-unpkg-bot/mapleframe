<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use app\assets\AppAsset;
//AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html class="Mi_scroll" lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= Html::encode($this->title) ?></title>
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
    <link rel="stylesheet" href="<?php echo Yii::getAlias('@web/css/core.css'); ?>">
    <link rel="stylesheet" href="<?php echo Yii::getAlias('@web/css/angular_only.css'); ?>">
    <script src="<?php echo Yii::getAlias('@web/js/functions.js'); ?>"></script>
    <script src="<?php echo Yii::getAlias('@web/js/angular/1.5.5/angular.min.js'); ?>"></script>
    <?php /*<script src="<?php echo Yii::getAlias('@web/js/angular/1.5.5/angular-route.js'); ?>"></script>*/ ?>
    <script src="<?php echo Yii::getAlias('@web/js/angular_only.js'); ?>"></script>
</head>
<body class="Mi_body Mia_body">
<?php $this->beginBody() ?>
    <header class="Mi_header Mia_header Gi_text_align_center"> </header>
        <div ng-app="App" id="wrapper" class="Mi_wrapper Mia_wrapper Gi_clear">
            <div ng-controller="AppCore" style="padding:20px 40px;">
                {{ _logica }}
            </div>
        </div>
        <?php //echo $content; ?>
    </div>
    <footer style="display:none;" class="Mi_footer"></footer>
<?php $this->endBody(); /*<script src="<?php echo Yii::getAlias('@web/js/mia.js'); ?>"></script>*/ ?>
</body>
</html>
<?php $this->endPage() ?>