<?php
/**
 * @var $dataProvider \yii\data\ActiveDataProvider
 */

use frontend\models\CompaniesSearch;
use yii\grid\GridView;
use yii\helpers\Html;
echo \common\widgets\Alert::widget();
?>
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
                            'content' => function (CompaniesSearch $model) {
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
                            'content' => function (CompaniesSearch $model) {
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