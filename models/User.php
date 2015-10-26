<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\base\Security;
use yii\web\IdentityInterface;
use app\components\UserMailer;
use app\models\Message;

class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $_created_at;
    public $password;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'created_at', 'role'], 'required'],
            [['name', 'email'], 'required', 'on' => ['signup', 'update']],
            [['password', 'network_id', 'network_identity', 'network_profile', 'name', 'network_avatar'], 'required', 'on' => ['social_signup']],
            [['password'], 'required', 'on' => ['signup', 'change_password']],
            [['partner_id', 'created_at', 'confirmed_at'], 'integer'],
            [['confirmed_email', 'confirmation_token', 'email', 'password', 'password_reset_token', 'network_avatar', 'network_id', 'network_identity', 'network_profile', 'name'], 'string', 'max' => 255],
            [['email'], 'validateEmailUnique'],
            [['avatar'], 'required', 'on' => 'upload_avatar'],
            [['avatar'], 'file', 'extensions'=> ['jpg', 'png', 'jpeg']],
            [['birthdate'], 'default', 'value' => date('Y-m-d')],
            [['birthdate'], 'date', 'format' => 'yyyy-mm-dd'],
            [['gender'], 'default', 'value' => 'unknown'],
            [['phone'], 'match', 'pattern' => '/^[0-9\)\(\+\-)]\w*$/i'],
            [['phone'], 'string', 'max' => 20, 'min' => 2],
            [['gender'], 'in', 'range' => ['unknown', 'male', 'female']]
        ];
    }

    public function behaviors()
    {
        return [
            [
                 'class' => '\yiidreamteam\upload\ImageUploadBehavior',
                 'attribute' => 'avatar',
                 'thumbs' => ['thumb_avatar' => ['width' => 100, 'height' => 100], ],
                 'filePath' => '@webroot/uploads/users/avatar_[[pk]].[[extension]]',
                 'fileUrl' => '/uploads/users/avatar_[[pk]].[[extension]]',
                 'thumbPath' => '@webroot/uploads/users/avatar_thumbnail_[[pk]].[[extension]]',
                 'thumbUrl' => '/uploads/users/avatar_[[pk]].[[extension]]',
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'partner_id' => Yii::t('app', 'User Partner ID'),
            'scores_count' => Yii::t('app', 'Scores Count'),
            'clicks_count' => Yii::t('app', 'Clicks Count'),
            'friends_count' => Yii::t('app', 'Friends Count'),
            'email' => Yii::t('app', 'Email'),
            'confirmed_email' => Yii::t('app', 'Confirmed Email'),
            'confirmed_at' => Yii::t('app', 'Confirmed At'),
            'confirmation_token' => Yii::t('app', 'Confirmation Token'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'password' => Yii::t('app', 'Password'),
            'network_id' => Yii::t('app', 'Network ID'),
            'network_identity' => Yii::t('app', 'Network Identity'),
            'network_profile' => Yii::t('app', 'Network Profile'),
            'network_avatar' => Yii::t('app', 'Avatar'),
            'avatar' => Yii::t('app', 'Avatar'),
            'name' => Yii::t('app', 'Name'),
            'role' => Yii::t('app', 'Role'),
            'created_at' => Yii::t('app', 'Created At'),
            'phone' => Yii::t('app', 'Phone'),
            'gender' => Yii::t('app', 'Gender'),
            'birthdate' => Yii::t('app', 'Birthdate'),
            'account_balance' => Yii::t('app', 'Account Balance'),
        ];
    }

    /** INCLUDE USER LOGIN VALIDATION FUNCTIONS**/
        /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
/* modified */
    public static function findIdentityByAccessToken($token, $type = null)
    {
          return static::findOne(['access_token' => $token]);
    }

/* removed
    public static function findIdentityByAccessToken($token)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
*/
    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    /**
     * Finds user by password reset token
     *
     * @param  string      $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        return $this->password_hash == Yii::$app->getSecurity()->generatePasswordHash($password);
    }

    public function setPassword($password)
    {
        $this->password = $password;
        $this->password_hash = Yii::$app->getSecurity()->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->getSecurity()->generateRandomKey();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->getSecurity()->generateRandomKey() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    /** EXTENSION MOVIE **/

    public function validateEmailUnique($attribute, $params)
    {
        $user = User::find()->where(['email' => $this->$attribute])->one();
        if($user && ($this->isNewRecord || $this->id != $user->id))
        {
            $this->addError($attribute, 'Эл.почта уже зарегистрирована!');
        }
    }

    public function isAdmin()
    {
        return $this->role == 'admin';
    }

    public function isManager()
    {
        return $this->role == 'manager';
    }

    public function isUser()
    {
        return $this->role == 'user';
    }

    public function isConfirmed()
    {
        return $this->email == $this->confirmed_email;
    }

    public function referal_link($video_id = null)
    {
        $link = 'http://tatarlar.tv/?referal_id=' . $this->id;
        if($video_id != null)
        {
            $link .= '&r=profile/video&id=' . $video_id;
        }
        return $link;
    }

    public function created_at_date()
    {
        if($this->_created_at == null)
        {
            $this->_created_at = date('d.m.Y H:i', $this->created_at);
        }

        return $this->_created_at;
    }

    public function avatar($default_avatar = '/images/noimage.jpg')
    {
        if($this->network_avatar != '')
        {
            $default_avatar = $this->network_avatar;
        }

        return $this->getThumbFileUrl("avatar", "thumb", $default_avatar);
    }

    public function confirm_email()
    {
        $this->confirmed_email = $this->email;
        $this->confirmation_token = md5(time() . $this->email);
        $this->confirmed_at = time();
        $this->save();
    }

    public function generate_confirmation($token  = null, $password = null)
    {
        $this->confirmation_token = $token == null ? md5(time() . $this->email) : $token;
        $this->confirmed_at = 0;

        $mailer = new UserMailer($this);

        if($this->isNewRecord)
        {
          $mailer->registration($password);
        }else{
          $mailer->confirmation();
        }

        $success = $this->save();

        return $success;
    }

    public function generate_password($password  = null)
    {
        $password = $password == null ? md5(time()) : $password;
        $this->setPassword($password);
        $this->generateAuthKey();
        $success = $this->save();
        $mailer = new UserMailer($this);
        $mailer->reset_password($password);

        return $success;
        //send email should be here
    }

    public function gender()
    {
        $list = self::genderList();
        return isset($list[$this->gender]) ? $list[$this->gender] : $list['unknown'];
    }

    public function role()
    {
        $list = self::roleList();
        return isset($list[$this->role]) ? $list[$this->role] : $list['user'];
    }

    static public function roleList()
    {
        return [
            'user' => 'Пользователь',
            'manager' => 'Менеджер',
            'admin' => 'Администратор'
        ];
    }

    static public function genderList()
    {
        return [
            'unknown' => 'Неизвестен',
            'male' => 'Мужчина',
            'female' => 'Женщина'
        ];
    }

    public function updateBalance($sum)
    {
        $this->account_balance += $sum;
        $this->save();
    }

    public function account_balance()
    {
        return number_format($this->account_balance, 2);
    }

    //relations
    public function getMessages()
    {
        return $this->hasMany(Message::className(), ['receiver_user_id' => 'id']);
    }

    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['user_id' => 'id']);
    }

    public function getPartners()
    {
        return $this->hasMany(Partner::className(), ['user_id' => 'id']);
    }

    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['customer_id' => 'id'])->via('customers');
    }

    public function getBills()
    {
        return $this->hasMany(Bill::className(), ['customer_id' => 'id'])->via('customers');
    }

    public function getNameWithEmail()
    {
        return $this->name . '(' . $this->email . ')';
    }
}
