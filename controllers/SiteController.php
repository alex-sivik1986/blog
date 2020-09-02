<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Article;
use app\models\Category;
use app\models\Comment;
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
		$first_post = Article::find()->where(['status' => 1])->andWhere(['!=','category_id',0])->orderBy('date DESC')->limit(2)->all();

        $second_post = Article::find()->where(['status' => 1])->andWhere(['!=','category_id',0])->orderBy('date DESC')->offset(2)->limit(6)->all();
		$categories = Category::find()->all();
		$tags = ArrayHelper::map(Tag::find()->all(), 'id', 'title');
		
		$featured = Article::getFeatured();
		$most_comment = Comment::find()->select('*, COUNT(DISTINCT article_id) AS art')->where(['status' => 1])->all();
		var_dump($most_comment); die;
		
			return $this->render('index', [
				'first' => $first_post,
				'middle' => $second_post,
				'categories' => $categories,
				'tags' => $tags,
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
	
	public function actionSearch()
    {
        $model = new \app\models\ArticleSearch();
		if(Yii::$app->request->isPost)
		{
			
			$search = $model->search([$model->formName()=>Yii::$app->request->post()]);
			$featured = Article::getFeatured();
			$most_read = Article::find()->orderBy('date DESC')->limit(5)->all();
			$categories = Category::find()->all();
			$tags = ArrayHelper::map(Tag::find()->all(), 'id', 'title');
			
			return $this->render('category', [
			 'dataProvider' => $search,
			 'featured' => $featured,
			 'categories' => $categories,
			 'tags' => $tags
			]);
		} else {
			return $this->render('category', [
			 'featured' => $featured,
			 'categories' => $categories,
			 'tags' => $tags
			]);
			
		}
    }
	
	public function actionComment($id)
	{
		$comment = new \app\models\CommentForm();
		
		if(Yii::$app->request->isPost)
		{
			$comment->load(Yii::$app->request->post());
			if($comment->saveComment($id))
			{
				Yii::$app->getSession()->setFlash('comment', 'Your comment well be added 
after checking moderator');
				return $this->redirect(['site/article', 'id' => $id]);
			}
		}
	}
	
	public function actionTag($name)
	{
		$tag = Tag::getTagForName($name);
		$articles = new Article();
		$featured = Article::getFeatured();
		$most_read = Article::find()->where(['status' => 1])->andWhere(['!=','category_id',0])->orderBy('date DESC')->limit(5)->all();
		$categories = Category::find()->all();
		$tags = ArrayHelper::map(Tag::find()->all(), 'id', 'title');
	
		$dataProvider = new ActiveDataProvider([
			'query' => $articles::find()->where(['tag_id' => $tag->id])->joinWith('tags'),	
			'pagination' => [
				'pageSize' => 3,
			],
		]);
		//var_dump($dataProvider); die;
		if (Yii::$app->request->isAjax) {
			return $this->renderAjax('_loadmore', [
			 'dataProvider' => $dataProvider,
			]);
		} else {

			return $this->render('tag', [
			 'dataProvider' => $dataProvider,
			 'featured' => $featured,
			 'categories' => $categories,
			 'tags' => $tags
			]);
		}
		
		
	}
	
	public function actionArticle($id)
	{
		$article = Article::findOne($id);
		$featured = Article::getFeatured();
		$most_read = Article::find()->where(['status' => 1])->andWhere(['!=','category_id',0])->orderBy('date DESC')->limit(5)->all();
		$categories = Category::find()->all();
		$tags = ArrayHelper::map(Tag::find()->all(), 'id', 'title');
		$comments = $article->getComments()->where(['status' => 1])->all();
		$comment_form = new \app\models\CommentForm();
		
		$article->getViewed($id);
		
		return $this->render('single', 
		[
			'article' => $article,
			'featured' => $featured,
			'categories' => $categories,
			'most_read' => $most_read,
			'tags' => $tags,
			'comments' => $comments,
			'comment_form' => $comment_form
		]);
	}
	
	
	public function actionCategory($id) 
	{
		$query = Article::find()->where(['category_id' => $id])->orderBy('date DESC'); 
		$featured = Article::getFeatured();
		$most_read = Article::find()->orderBy('date DESC')->limit(5)->all();
		$categories = Category::find()->all();
		$tags = ArrayHelper::map(Tag::find()->all(), 'id', 'title');
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
			 'tags' => $tags
			]);
		}
	}
}
