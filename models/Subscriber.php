<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subscriber".
 *
 * @property int $id
 * @property string|null $email
 */
class Subscriber extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subscriber';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email'], 'string', 'max' => 64],
			[['email'], 'email']
        ];
    }
	
	public function saveSubscriber()
	{
		 $check = Subscriber::find()->where(['email' => $this->email])->one();
			if(empty($check)) {	
					$this->save();
				return true;
			} else {
					$check->delete();
				return 'unscribe';
			}
	}


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
        ];
    }
}
