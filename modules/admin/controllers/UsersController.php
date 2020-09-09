<?php
namespace app\modules\admin\controllers;

use Yii;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class UsersController extends Controller
{
	
	public function actionIndex()
	{   
	    
		$model = new User();
		$this->setViewPath('C:\openserver\OSPanel\domains\blog.com\modules\admin\views\user');
	
		return $this->render('index',[
		'model' => $model
		]);
		
		
	}
	
}


?>