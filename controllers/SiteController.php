<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Article;
use app\models\Category;
use app\models\Tag;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
		$first_post = Article::find()->orderBy('date DESC')->limit(2)->all();
        $second_post = Article::find()->orderBy('date DESC')->offset(2)->limit(6)->all();
		$categories = Category::find()->all();
		$tags = new Tag;
		$tag = $tags->getArticleTags();
		$featured = Article::getFeatured();
		
			return $this->render('index', [
				'first' => $first_post,
				'middle' => $second_post,
				'categories' => $categories,
				'tags' => $tag,
				'featured' => $featured
			]);
    }
	
    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
	
	public function actionArticle($id)
	{
		$article = Article::findOne($id);
		$featured = Article::getFeatured();
		$most_read = Article::find()->orderBy('date DESC')->limit(5)->all();
		$categories = Category::find()->all();
		
		return $this->render('single', 
		[
			'article' => $article,
			'featured' => $featured,
			'categories' => $categories,
			'most_read' => $most_read
		]);
	}
	
	
	public function actionCategory($id) 
	{
		$query = Article::find()->where(['category_id' => $id])->orderBy('date DESC'); 
		$featured = Article::getFeatured();
		$most_read = Article::find()->orderBy('date DESC')->limit(5)->all();
		$categories = Category::find()->all();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,	
			'pagination' => [
				'pageSize' => 3,
			],
		]);
		
		if (Yii::$app->request->isAjax) {
			return $this->renderAjax('_loadmore', [
			 'dataProvider' => $dataProvider,
			]);
		} else {

			return $this->render('category', [
			 'dataProvider' => $dataProvider,
			 'featured' => $featured,
			 'categories' => $categories,
			]);
		}
	}
}
