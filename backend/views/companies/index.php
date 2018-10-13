<?php
/**
 * @var $dataProvider \yii\data\ActiveDataProvider
 */

use yii\grid\GridView;
use yii\helpers\Html;
echo \common\widgets\Alert::widget();
?>
<div class="row">
    <a href="/admin/companies/add" class="btn btn-success">Add Company</a>
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
                        [
                            'attribute' => 'logo',
                            'format' => 'raw',
                            'header' => 'Logo',
                            'content' => function ($model) {
                                /** @var $model \backend\models\CompaniesSearch */
                                return Html::tag('img', null,['src' => '/'.$model->logo, 'width' => 75]);
                            }
                        ],
                        'name',
                        'email',
                        [
                            'header' => 'Actions',
                            'content' => function ($model) {
                                /** @var $model \backend\models\CompaniesSearch */
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