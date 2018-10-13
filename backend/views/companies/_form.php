<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Companies */
/* @var $form ActiveForm */
?>
<div class="index">

    <?php $form = ActiveForm::begin([
        'action' => \yii\helpers\Url::to(['companies/update', 'id' => $model->id]),
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <div class="row">
        <div class="col-md-6">
            <img src="<?=$model->logo?>" alt="">
        </div>
    </div>
    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'logo') ?>
    <?= $form->field($model, 'file')->input('file') ?>
    <?= $form->field($model, 'updated_at') ?>
    <?= $form->field($model, 'created_at') ?>
    <?= $form->field($model, 'website') ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
