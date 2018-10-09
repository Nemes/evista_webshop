<?php

use yii\db\Migration;

/**
 * Class m181008_190255_createBasketTable
 */
class m181008_190255_createBasketTable extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('basket', [
            'user_id' => $this->integer(11)->notNull(),
            'item_id' => $this->integer(11)->notNull(),
            'item_quantity' => $this->integer(11)->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('basket');
    }
}
