<?php

namespace frontend\models;

use common\models\Companies;
use yii\data\ActiveDataProvider;

class CompaniesSearch extends Companies
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['updated_at', 'created_at'], 'safe'],
            [['name', 'website', 'email', 'name'], 'string', 'max' => 300],
        ];
    }

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

        $query
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
        ;

        return $dataProvider;
    }
}