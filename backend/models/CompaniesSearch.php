<?php

namespace backend\models;

use common\models\Companies;
use yii\data\ActiveDataProvider;

class CompaniesSearch extends Companies
{
    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params) :ActiveDataProvider
    {
        $query = self::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'name'=> SORT_ASC,
                ]
            ],
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        $this->load($params);
        if (!$this->validate()){
            return $dataProvider;
        }

        return $dataProvider;
    }
}