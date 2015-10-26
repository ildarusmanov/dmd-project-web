<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property integer $id
 * @property integer $receiver_user_id
 * @property integer $sender_user_id
 * @property string $subject
 * @property string $content
 * @property string $receiver_status
 * @property string $sender_status
 * @property integer $created_at
 */
class Message extends \yii\db\ActiveRecord
{
    public $_created_at = null;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['receiver_user_id', 'sender_user_id', 'created_at'], 'integer'],
            [['subject','content', 'created_at', 'receiver_user_id', 'sender_user_id', 'receiver_status', 'sender_status'], 'required'],
            [['content'], 'string'],
            [['subject', 'receiver_status', 'sender_status'], 'string', 'max' => 255, 'min' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'receiver_user_id' => Yii::t('app', 'Message Receiver'),
            'sender_user_id' => Yii::t('app', 'Message Sender'),
            'subject' => Yii::t('app', 'Message Subject'),
            'content' => Yii::t('app', 'Message Content'),
            'receiver_status' => Yii::t('app', 'Message Status'),
            'sender_status' => Yii::t('app', 'Message Status'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    public function getSenderUser()
    {
        return $this->hasOne(User::className(), ['id' => 'sender_user_id']);
    }

    public function getReceiverUser()
    {
        return $this->hasOne(User::className(), ['id' => 'receiver_user_id']);
    }


    static public function statusList()
    {
        return [
            'new' => Yii::t('app', 'Message Status New'),
            'read' => Yii::t('app', 'Message Status Read'),
            'spam' => Yii::t('app', 'Message Status Spam'),
            'deleted' => Yii::t('app', 'Message Status Deleted'),
        ];
    }

    public function sender_status()
    {
        $statusList = self::statusList();
        return $statusList[$this->sender_status];
    }

    public function receiver_status()
    {
        $statusList = self::statusList();
        return $statusList[$this->receiver_status];
    }


    public function sender_data()
    {
        $user = ['id' => 0, 'name' => Yii::t('app', 'Message System User')];
        if($this->senderUser)
        {
            $user = $this->senderUser->attributes;
        }
        return $user;
    }

    public function receiver_data()
    {
        $user = ['id' => 0, 'name' => Yii::t('app', 'Message System User')];
        if($this->receiverUser)
        {
            $user = $this->receiverUser->attributes;
        }
        return $user;
    }



    public function created_at_date()
    {
        if($this->_created_at == null)
        {
            $this->_created_at = date('d.m.Y H:i', $this->created_at);
        }

        return $this->_created_at;
    }

    public function set_status_by($user_id, $status)
    {
        if($this->receiver_user_id == $user_id)
        {
            $this->receiver_status = $status;
            return;
        }

        if($this->sender_user_id == $user_id)
        {
            $this->sender_status_id = $status;
            return;
        }
    }

    public function short_content()
    {
        return mb_substr($this->content, 0, 140, 'utf-8');
    }

}
