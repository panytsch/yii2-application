<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\Companies;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Employers */
/* @var $form ActiveForm */
$this->title = "{$model->first_name} Employer";
$this->params['breadcrumbs'][] = ['label' => 'Employers', 'url' => 'index'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="index">

    <?php $form = ActiveForm::begin([]); ?>

    <?= $form->field($model, 'first_name')->textInput(['readonly' => 'true']) ?>
    <?= $form->field($model, 'last_name')->textInput(['readonly' => 'true']) ?>
    <?= $form->field($model, 'email')->textInput(['readonly' => 'true']) ?>
    <?= $form->field($model, 'phone')->textInput(['readonly' => 'true']) ?>
    <div class="form-group">
        <label class="control-label">Company</label><br>
        <?= Html::a($model->company->name, ['companies/view', 'id' => $model->company_id], ['class' => 'btn btn-link'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
