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
echo \common\widgets\Alert::widget();
?>
<div class="index">

    <?php $form = ActiveForm::begin([
        'action' => \yii\helpers\Url::to([$model->isNewRecord ? 'add' : 'update', 'id' => $model->id]),
    ]); ?>

    <?= $form->field($model, 'first_name') ?>
    <?= $form->field($model, 'last_name') ?>
    <?= $form->field($model, 'email')->input('email') ?>
    <?= $form->field($model, 'phone') ?>
    <?=
        $form
            ->field($model, 'company_id')
            ->dropDownList(
                ArrayHelper::map(
                    Companies::find()->all(),
                    'id',
                    'name'
                )
            )
            ->label('Company')
    ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
