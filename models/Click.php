<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "click".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $cookie_id
 * @property string $partner_id
 * @property string $ref_link
 * @property string $ip_address
 * @property integer $created_at
 */
class Click extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'click';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'created_at'], 'integer'],
            [['created_at'], 'required'],
            [['cookie_id', 'partner_id', 'ref_link', 'ip_address'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'cookie_id' => Yii::t('app', 'Cookie ID'),
            'partner_id' => Yii::t('app', 'Partner ID'),
            'ref_link' => Yii::t('app', 'Ref Link'),
            'ip_address' => Yii::t('app', 'Ip Address'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
