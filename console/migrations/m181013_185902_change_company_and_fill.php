<?php

use yii\db\Migration;

/**
 * Class m181013_185902_change_company_and_fill
 */
class m181013_185902_change_company_and_fill extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn(
            'companies',
            'logo',
            $this->string(200)->null()
        );
        for ($i = 21; $i < 70; $i++) {
            $this->insert('companies', [
                'id' => $i,
                'name' => Yii::$app->security->generateRandomString(10),
                'email' => Yii::$app->security->generateRandomString(10),
                'website' => Yii::$app->security->generateRandomString(10)
            ]);
            $this->insert('employers', [
                'email' => Yii::$app->security->generateRandomString(10),
                'company_id' => $i,
                'first_name' => Yii::$app->security->generateRandomString(10),
                'last_name' => Yii::$app->security->generateRandomString(10),
                'phone' => Yii::$app->security->generateRandomString(10)
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('employers');
        $this->truncateTable('companies');
        $this->alterColumn(
            'companies',
            'logo',
            $this->string(200)->notNull()
        );
    }
}
