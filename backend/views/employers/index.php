<?php
/**
 * @var $dataProvider \yii\data\ActiveDataProvider
 */

use yii\grid\GridView;
use yii\helpers\Html;

echo \common\widgets\Alert::widget();
?>
<div class="row">
    <a href="/admin/employers/add" class="btn btn-success">Add Employer</a>
</div>
<div class="row">
    <div>
        <?php \yii\widgets\Pjax::begin(['id' => 'filters']); ?>
        <div class="panel">
            <div class="table-responsive">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'summary' => false,
                    'layout' => "{summary}\n{items}\n<div align='right'>{pager}</div>",
                    'tableOptions' => [
                        'class' => 'table table-hover manage-u-table'
                    ],
                    'columns' => [
                        'id',
                        'first_name',
                        'last_name',
                        'email',
                        'phone',
                        [
                            'attribute' => 'company_id',
                            'format' => 'raw',
                            'header' => 'Company',
                            'value' => function (\backend\models\EmployersSearch $model) {
                                return Html::a($model->company->name, ['companies/update', 'id' => $model->company_id]);
                            }
                        ],
                        [
                            'header' => 'Actions',
                            'content' => function ($model) {
                                /** @var $model \backend\models\EmployersSearch*/
                                $actions = [
                                    Html::a('Edit', ['update', 'id' => $model->id]),
                                    Html::a('Delete', ['delete', 'id' => $model->id])
                                ];
                                return join('<br>', $actions);
                            }
                        ]
                    ],
                ]); ?>
            </div>
        </div>

        <?php \yii\widgets\Pjax::end(); ?>

    </div>
</div>