<?php

use yii\db\Migration;

/**
 * Class m181004_112543_createBasketTable
 */
class m181004_112543_createBasketTable extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('basket', [
            'user_id' => $this->integer(11)->notNull(),
            'item_id' => $this->integer(11)->notNull(),
            'item_quantity' => $this->integer(11)->notNull(),
            'created_at' => $this->date()->notNull(),
            'updated_at' => $this->date()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('basket');
    }

}
