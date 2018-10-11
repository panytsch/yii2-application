<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "companies".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $website
 * @property string $logo
 * @property string $updated_at
 * @property string $created_at
 *
 * @property Employers[] $employers
 */
class Companies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'companies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'logo'], 'required'],
            [['updated_at', 'created_at'], 'safe'],
            [['name', 'website'], 'string', 'max' => 300],
            [['email'], 'string', 'max' => 100],
            [['logo'], 'string', 'max' => 200],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'website' => 'Website',
            'logo' => 'Logo',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployers()
    {
        return $this->hasMany(Employers::className(), ['company_id' => 'id']);
    }
}
