<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\Article;
use app\models\Category;
use app\models\SignupForm;
use app\models\LoginForm;

class AuthController extends Controller 
{
/**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
		$featured = Article::getFeatured();
		$most_read = Article::find()->orderBy('date DESC')->limit(5)->all();
		$categories = Category::find()->all();
		
        return $this->render('/auth/login', [
            'model' => $model,
			'featured' => $featured,
			'categories' => $categories,
			'most_read' => $most_read
        ]);
    }
	
	public function actionRegister()
	{
		$model = new SignupForm();
		$featured = Article::getFeatured();
		$most_read = Article::find()->orderBy('date DESC')->limit(5)->all();
		$categories = Category::find()->all();
		
		if(Yii::$app->request->isPost)
		{
			$model->load(Yii::$app->request->post());
			if($model->signup())
			{
				return $this->redirect(['auth/login']);
			}
					
		}
			
		
		return $this->render('register',
		[
			'model' => $model,
			'featured' => $featured,
			'categories' => $categories,
			'most_read' => $most_read
		]);
	}

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
	
	public function actionTest()
	{
		$user = User::findOne(1);
		Yii::$app->user->logout($user); 
		
		if(Yii::$app->user->isGuest) {
			echo 'Гость';
		} else {
			echo 'Авторизован';
		}
		
	}
}
