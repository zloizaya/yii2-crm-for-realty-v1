<?php

use yii\db\Migration;

/**
 * Class m221125_074946_create_communication_asset
 */
class m221125_074946_create_communication_asset extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%communication_asset}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->date()->notNull(),
            'updated_at' => $this->date()->notNull(),
            'cid' => $this->integer(),
            'oid' => $this->integer(),
        ], $tableOptions);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221125_074946_create_communication_asset cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221125_074946_create_communication_asset cannot be reverted.\n";

        return false;
    }
    */
}
