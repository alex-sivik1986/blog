<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $password
 * @property int|null $isAdmin
 * @property string|null $photo
 *
 * @property Comment[] $comments
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
	public const STATUS_ACTIVE = 1;
	public const STATUS_INACTIVE = 0;
	
	public const IS_ADMIN = 1;
	public const NOT_ADMIN = 0;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['isAdmin','status'], 'integer'],
            [['name', 'email', 'password', 'photo'], 'string', 'max' => 255],
			[['status'], 'default', 1]
        ];
    }
	

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'isAdmin' => 'Is Admin',
            'photo' => 'Photo'
        ];
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['user_id' => 'id']);
    }
	
	public function getAdmin()
	{
		return ($this->isAdmin == self::IS_ADMIN) ? self::IS_ADMIN : self::NOT_ADMIN;
	}
	
	public static function findIdentity($id)
	{
		return User::findOne($id);
	}

    public static function findIdentityByAccessToken($token, $type = null) 
	{
		
	}
	
	public function getStatus()
	{
		return ($this->status == self::STATUS_ACTIVE) ? 'active' : 'inactive';
	}
	
	public function textStatus()
	{
		return ($this->status == self::STATUS_ACTIVE) ? 'deactivate' : 'activate';
	}
  
    public function getId()
	{
	    return $this->id;
	}

    public function getAuthKey()
	{
		
	}

    public function validateAuthKey($authKey)
	{
		
	}
	
	public static function findByUsername($username)
	{
		return User::find()->where(['name' => $username])->one();
	}
	
	public function validatePassword($password)
	{
		return ($this->password == $password) ? true : false;
	}
	
	public function create()
	{
		return $this->save(false);
	}
}
