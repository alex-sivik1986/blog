<?php
namespace app\models;

use Yii;
use yii\base\Model;

class CommentForm extends Model
{
	public $comment_text;
	
	public function rules()
	{
	  return [
				[['comment_text'], 'required'],
				[['comment_text'], 'string', 'max' => 250]
			 ];
	}
}