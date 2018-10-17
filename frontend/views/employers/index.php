<?php
/**
 * @var $dataProvider \yii\data\ActiveDataProvider
 * @var $searchModel EmployersSearch
 */

use yii\grid\GridView;
use yii\helpers\Html;
use frontend\models\EmployersSearch;
$this->title = "Employers";
$this->params['breadcrumbs'][] = $this->title;
echo \common\widgets\Alert::widget();
?>
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
                        'first_name',
                        'last_name',
                        'email',
                        'phone',
                        [
                            'attribute' => 'company_id',
                            'format' => 'raw',
                            'header' => 'Company',
                            'value' => function (EmployersSearch $model) {
                                return Html::a($model->company->name, ['companies/view', 'id' => $model->company_id]);
                            }
                        ],
                        [
                            'header' => 'Actions',
                            'filter' => Html::a('clear', ['index'], ['class' => 'btn btn-default']),
                            'content' => function (EmployersSearch $model) {
                                $actions = [
                                    Html::a('View', ['view', 'id' => $model->id], ['class' => 'btn btn-info']),
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