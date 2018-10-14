<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Companies */
/* @var $form ActiveForm */
$this->title = "{$model->name} Company";
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => 'index'];
$this->params['breadcrumbs'][] = $this->title;
echo \common\widgets\Alert::widget();
?>
<div class="index">

    <?php $form = ActiveForm::begin([
        'action' => \yii\helpers\Url::to([$model->isNewRecord ? 'add' : 'update', 'id' => $model->id]),
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

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
    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'file')->input('file') ?>
    <?= $form->field($model, 'website') ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
