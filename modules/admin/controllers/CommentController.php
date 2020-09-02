<?php
namespace app\modules\admin\controllers;

use Yii;
use app\models\comment;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class CommentController extends Controller
{
	
	public function actionIndex()
	{
		$comment = Comment::find()->orderBy('id DESC')->all();
		
		
		
		return $this->render('index', [
				'comments' => $comment,
		]);
	}
	
	public function actionAllow($id)
	{
		$model = Comment::findOne($id);
		
		if($model->allow())
		{
			return $this->redirect(['index']);
		}
		
	}
	
	public function actionDisallow($id)
	{
		$model = Comment::findOne($id);
		
		if($model->disallow())
		{
			return $this->redirect(['index']);
		}
		
	}
	
	public function actionDelete($id)
	{
		$model = Comment::findOne($id);
		$model->delete();
		
		return $this->redirect(['index']);
	}
	
}
?>