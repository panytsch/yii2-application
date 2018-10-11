<?php

use yii\db\Migration;

/**
 * Class m181011_170921_add_table_users_roles
 */
class m181011_170921_add_table_users_roles extends Migration
{
    private $table = 'users_roles';
    private $idx = 'idx-user-roles';
    private $fk = 'idx-user-roles';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'role_name' => $this->string(50)->notNull()
        ]);
        $this->addColumn('user', 'role_id', $this->integer(11)->notNull()->after('id'));
        $this->createIndex($this->idx, 'user', 'role_id');
        $this->addForeignKey(
            $this->fk,
            'user',
            'role_id',
            $this->table,
            'id'
        );
        $this->batchInsert(
            $this->table,
            ['role_name'],
            [['Admin'], ['User']]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey($this->fk, 'user');
        $this->dropIndex($this->idx, 'user');
        $this->dropColumn('user', 'role_id');
        $this->dropTable($this->table);
    }
}
