<?php
use yii\db\Schema;
use yii\db\Migration;

class m151021_113040_create_clicks_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%click}}', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'cookie_id' => Schema::TYPE_STRING . ' NOT NULL DEFAULT \'\'',
            'partner_id' => Schema::TYPE_STRING . ' NOT NULL DEFAULT \'\'',
            'ref_link' => Schema::TYPE_STRING . ' NOT NULL DEFAULT \'\'',
            'ip_address' => Schema::TYPE_STRING . ' NOT NULL DEFAULT \'\'',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%click}}');

        return true;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
