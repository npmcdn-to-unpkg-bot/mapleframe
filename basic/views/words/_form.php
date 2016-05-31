<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\EnThemes;
/* @var $this yii\web\View */
/* @var $model app\models\EnWords */
/* @var $form yii\widgets\ActiveForm */
?>

<div style="width:300px;" class="en-words-form">
    
    <?php $form = ActiveForm::begin(); ?>
    
    <?php //echo $form->field($model, 'created')->textInput(); ?>
    <?php //echo $form->field($model, 'updated')->textInput(); ?>
    <?php //echo $form->field($model, 'status')->textInput(); ?>
    <?php //echo $form->field($model, 'author')->textInput(); dropDownList ?>
    <?php echo $form->field($model, 'theme_id')->dropDownList(ArrayHelper::map(EnThemes::find()->all(), 'id', 'name')); ?>
    <?php echo $form->field($model, 'word')->textInput(['maxlength' => true, 'autocomplete'=>'off']); ?>
    <?php echo $form->field($model, 'translate')->textInput(['maxlength' => true, 'autocomplete'=>'off']); ?>
    <?php echo $form->field($model, 'trancription')->textInput(['maxlength' => true, 'autocomplete'=>'off']); ?>
    <?php echo $form->field($model, 'type')->dropDownList(ArrayHelper::map([['id'=>'0', 'name'=>'Нет']], 'id', 'name')); ?>
    <?php echo $form->field($model, 'infinitive')->textInput(['maxlength' => true, 'autocomplete'=>'off']); ?>
    <?php echo $form->field($model, 'past_simple')->textInput(['maxlength' => true, 'autocomplete'=>'off']); ?>
    <?php echo $form->field($model, 'past_participle')->textInput(['maxlength' => true, 'autocomplete'=>'off']); ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
    <div style="height:100px;width:100px;background:#fff;"></div>

</div>
