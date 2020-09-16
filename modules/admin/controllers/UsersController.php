<?php
namespace app\modules\admin\controllers;

use Yii;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;


class UsersController extends Controller
{
	
	public function actionIndex()
	{     
		$model = new User();
		//$this->setViewPath('C:\openserver\OSPanel\domains\blog.com\modules\admin\views\user');
	    $users = $model->find()->all();
		$query = $model::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
		
		return $this->render('/user\index',[
			'model' => $users,
			'dataProvider' => $dataProvider
		]);
			
	}
	
	public function actionIsadmin()
	{
		$model = new User();
		
		if(Yii::$app->request->isAjax) 
		{
			$value = Yii::$app->request->post();
			$user = $model::findOne($value['id_user']);
			$user->isAdmin = $value['check'];
			
			$users = $model->find()->all();
			$query = $model::find();
            $dataProvider = new ActiveDataProvider([
								'query' => $query,
						]);
			if($user->save(false))
			{
				//$update = \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
				return $this->renderAjax('/user\index', 
						[   'model' => $users,
							'dataProvider' => $dataProvider,
							'isAdmin' => ($user->isAdmin==$model::IS_ADMIN)?' is Admin':'is not Admin'
					    ]);
			}
			
			
		}
	}
	
	public function actionActivate()
	{
		$model = new User();
		
		if(Yii::$app->request->isGet)
		{
			$id = Yii::$app->request->get();
			$user = $model::findOne($id['id']);
			$user->status = $model::STATUS_ACTIVE;

			if($user->save(false))
			{
				return $this->redirect('/admin/users');
			}
		}
	}
	
	public function actionDeactivate()
	{
		$model = new User();
		
		if(Yii::$app->request->isGet)
		{
			$id = Yii::$app->request->get();
			$user = $model::findOne($id['id']);
			$user->status = $model::STATUS_INACTIVE;

			if($user->save(false))
			{
				return $this->redirect('/admin/users');
			}
		}
	}
	
}


?>