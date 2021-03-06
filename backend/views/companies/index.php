<?php
/**
 * @var $dataProvider \yii\data\ActiveDataProvider
 * @var $searchModel \backend\models\CompaniesSearch
 */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = "Companies";
$this->params['breadcrumbs'][] = $this->title;

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
                    'filterModel' => $searchModel,
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
                                return $model->logo
                                    ? Html::tag('img', null,['src' => '/'.$model->logo, 'width' => 75])
                                    : '(empty)'
                                ;
                            }
                        ],
                        'name',
                        'email',
                        [
                            'header' => 'Actions',
                            'filter' => Html::a('clear', ['index'], ['class' => 'btn btn-default']),
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