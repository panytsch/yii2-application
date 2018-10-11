<?php

use yii\db\Migration;

/**
 * Class m181011_165252_add_employers_table
 */
class m181011_165252_add_employers_table extends Migration
{
    private $table = '{{%employers}}';
    private $fk = 'fk-employers-companies';
    private $idx = 'idx-employers-companies';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
                $this->table,
                [
                    'id' => $this->primaryKey(11),
                    'first_name' => $this->string(300)->notNull(),
                    'last_name' => $this->string(300),
                    'email' => $this->string(100)->notNull()->unique(),
                    'phone' => $this->string(20)->notNull(),
                    'company_id' => $this->integer(11)->notNull(),
                    'updated_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
                    'created_at' => $this->dateTime()->notNull()->defaultExpression('NOW()')
                ]
            );

        $this->createIndex($this->idx, $this->table, 'company_id');
        $this->addForeignKey(
            $this->fk,
            $this->table,
            'company_id',
            'companies',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey($this->fk, $this->table);
        $this->dropIndex($this->idx, $this->table);
        $this->dropTable($this->table);
    }
}
