<?php

use yii\db\Schema;
use yii\db\Migration;

class m150626_132458_AddAccountBalanceToUsers extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'account_balance', Schema::TYPE_DECIMAL . ' NOT NULL DEFAULT \'0.00\'');
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'account_balance');
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
