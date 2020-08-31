<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Comment;

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
	
	public function saveComment($article_id)
	{
		$model = new Comment;
		
		$model->user_id = Yii::$app->user->id;
		$model->text = $this->comment_text;
		$model->article_id = $article_id;
		$model->status = 0;
		$model->date = date('Y-m-d');
		return $model->save();
		
		
	}
}