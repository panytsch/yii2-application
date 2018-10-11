<?php
/**
 * @var $dataProvider \yii\data\ActiveDataProvider
 */

use yii\grid\GridView;

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
                        'first_name',
                        'last_name',
                        'email',
                        'phone',
                        [
                            'attribute' => 'company_id',
                            'format' => 'raw',
                            'header' => 'Company',
                            'value' => function (\backend\models\EmployersSearch $model) {
                                return $model->company->name;
                            }
                        ]
                    ],
                ]); ?>
            </div>
        </div>

        <?php \yii\widgets\Pjax::end(); ?>

    </div>
</div>