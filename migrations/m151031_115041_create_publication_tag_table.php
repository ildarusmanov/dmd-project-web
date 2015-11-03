<?php
use yii\db\Schema;
use yii\db\Migration;

class m151031_115041_create_publication_tag_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%tag}}', [
            'id' => Schema::TYPE_PK,
            'tag' => Schema::TYPE_STRING . ' NOT NULL',
            'count' => Schema::TYPE_STRING . ' NOT NULL DEFAULT \'0\''
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%tag}}');

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
