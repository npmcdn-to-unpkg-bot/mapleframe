<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EnThemes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="en-themes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //echo $form->field($model, 'created')->textInput() ?>
    <?php //echo $form->field($model, 'updated')->textInput() ?>
    <?php //echo $form->field($model, 'status')->textInput() ?>
    <?php //echo $form->field($model, 'author')->textInput() ?>
    <?php echo $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    
    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
