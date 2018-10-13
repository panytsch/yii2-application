<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Companies */
/* @var $form ActiveForm */
?>
<div class="index">

    <?php $form = ActiveForm::begin([]); ?>

    <?php
    if (!empty($model->logo)){
    ?>
    <div class="row">
        <div class="col-md-6">
            <img src="/<?=$model->logo?>" width="200">
        </div>
    </div>
    <?php
    }
    ?>
    <?= $form->field($model, 'name')->textInput(['readonly' => 'true']) ?>
    <?= $form->field($model, 'email')->textInput(['readonly' => 'true']) ?>
    <?= $form->field($model, 'website')->textInput(['readonly' => 'true']) ?>

    <?php ActiveForm::end(); ?>

</div>
