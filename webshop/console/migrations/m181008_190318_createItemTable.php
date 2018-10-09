<?php

use yii\db\Migration;

/**
 * Class m181008_190318_createItemTable
 */
class m181008_190318_createItemTable extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('item', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string()->notNull()->unique(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);

        $this->insert('item', ['name' => 'Poló', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        $this->insert('item', ['name' => 'Nadrág', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        $this->insert('item', ['name' => 'Bluz', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        $this->insert('item', ['name' => 'Pulóver', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        $this->insert('item', ['name' => 'Cipő', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('item');
    }
}
