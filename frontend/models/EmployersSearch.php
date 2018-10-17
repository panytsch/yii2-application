<?php

namespace frontend\models;

use common\models\Companies;
use common\models\Employers;
use yii\data\ActiveDataProvider;

class EmployersSearch extends Employers
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'phone', 'company_id'], 'string'],
            [['updated_at', 'created_at'], 'safe'],
            [['first_name', 'last_name'], 'string', 'max' => 300],
            [['email'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 20],
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
                    'first_name'=> SORT_ASC,
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
            ->andFilterWhere(['like', self::tableName().'.first_name', $this->first_name])
            ->andFilterWhere(['like', self::tableName().'.last_name', $this->last_name])
            ->andFilterWhere(['like', self::tableName().'.phone', $this->phone])
            ->andFilterWhere(['like', self::tableName().'.email', $this->email])
        ;
        if ($this->company_id) {
            $query->joinWith('company')->andFilterWhere(['like', 'companies.name', $this->company_id]);
        }
        return $dataProvider;
    }
}