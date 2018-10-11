<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "employers".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property int $company_id
 * @property string $updated_at
 * @property string $created_at
 *
 * @property Companies $company
 */
class Employers extends ActiveRecord
{

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'email', 'phone', 'company_id'], 'required'],
            [['company_id'], 'integer'],
            [['updated_at', 'created_at'], 'safe'],
            [['first_name', 'last_name'], 'string', 'max' => 300],
            [['email'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 20],
            [['email'], 'unique'],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::className(), 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'company_id' => 'Company ID',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Companies::className(), ['id' => 'company_id']);
    }
}
