<?php

use yii\db\Migration;

/**
 * Class m181011_165232_add_companies_table
 */
class m181011_165232_add_companies_table extends Migration
{
    private $table = '{{%companies}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this
            ->createTable(
                $this->table,
                [
                    'id' => $this->primaryKey(11),
                    'name' => $this->string(300)->notNull(),
                    'email' => $this->string(100)->notNull()->unique(),
                    'website' => $this->string(300)->null(),
                    'logo' => $this->string(200)->notNull(),
                    'updated_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
                    'created_at' => $this->dateTime()->notNull()->defaultExpression('NOW()')
                ]
            );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
