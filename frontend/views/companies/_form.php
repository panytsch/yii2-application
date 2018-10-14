<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Companies */
/* @var $form ActiveForm */
$this->title = "{$model->name} Company";
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => 'index'];
$this->params['breadcrumbs'][] = $this->title;
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

    <div class="row">
        <h5>Site: <a href="<?=$model->website?>" target="_blank"><?=$model->website?></a></h5>
    </div>
    <?php ActiveForm::end(); ?>

</div>
