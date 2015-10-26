<?php

use yii\db\Schema;
use yii\db\Migration;

class m150616_202443_create_messages_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%message}}', [
            'id' => Schema::TYPE_PK,
            'receiver_user_id' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT \'0\'',
            'sender_user_id' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT \'0\'',
            'subject' => Schema::TYPE_STRING . ' NOT NULL DEFAULT \'Subject\'',
            'content' => Schema::TYPE_TEXT . ' NOT NULL  DEFAULT \'\'',
            'receiver_status' => Schema::TYPE_STRING . ' NOT NULL  DEFAULT \'new\'',
            'sender_status' => Schema::TYPE_STRING . ' NOT NULL  DEFAULT \'new\'',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL'
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%message}}');

        return true;
    }
}
