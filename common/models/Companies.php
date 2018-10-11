<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\UploadedFile;

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
class Companies extends ActiveRecord
{

    /**
     * @var UploadedFile
     */
    public $file;

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
        return 'companies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            [['name', 'email', 'logo'], 'required'],
            [['name', 'email'], 'required'],
            [['updated_at', 'created_at'], 'safe'],
            [['file'], 'file'],
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
