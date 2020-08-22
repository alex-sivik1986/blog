<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Article;
use app\models\ArticleTag;
use app\models\ArticleSearch;
use app\models\ImageUpload;
use app\models\Category;
use app\models\Tag;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\helpers\Json;
/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    /**
     * {@inheritdoc}
     */
	
	
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();
		$image = new ImageUpload;
		$tags = ArrayHelper::map(Tag::find()->all(),'id','title');
		$categories = ArrayHelper::map(Category::find()->all(), 'id', 'title');		
        
		
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			
            if(Yii::$app->request->isPost) {
				
				$article = $this->findModel($model->id);
				
				$file = UploadedFile::getInstance($image, 'image');
				
				if(!empty($file)) {
					$article->saveImage($image->uploadFile($file, $article->image));
				}
				
				$tags = Yii::$app->request->post('tags');
				
				$model->saveTags($tags);

				
		
			}

            return $this->redirect(['view', 'id' => $model->id]);
        } 

        return $this->render('create', [
            'model' => $model,
			'image' => $image,
			'tags' => $tags,
			'categories' => $categories
        ]);
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$image = new ImageUpload;
		$tags = ArrayHelper::map(Tag::find()->all(),'id','title');
		$selectedTags = $model->getSelectedTags();
		
		
		$selectedCategory = $model->category_id; // Тоже самое что и getCategory
		$categories = ArrayHelper::map(Category::find()->all(), 'id', 'title');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

			
			$article = $this->findModel($id);
			
			$file = UploadedFile::getInstance($image, 'image');
				if(!empty($file)) {
					$article->saveImage($image->uploadFile($file, $article->image));
				} 
				
			$tags = Yii::$app->request->post('tags');
			
			$model->saveTags($tags);
				
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
			'selected' => $selectedCategory,
			'tags' => $tags,
			'selectedTags' => $selectedTags,
			'image' => $image,
			'categories' => $categories
        ]);
    }
	
	

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {   
	    $image = new ImageUpload();
		$article_image = $this->findModel($id);
		$image->deleteImage($article_image->image);
		
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	public function actionUploadImage($id) 
	{
		$model = new ImageUpload;
		
		if(Yii::$app->request->isPost) {
			
			$article = $this->findModel($id);
			
			$file = UploadedFile::getInstance($model, 'image');
			
			if($article->saveImage($model->uploadFile($file, $article->image))) {
				
				return $this->redirect(['view', 'id' => $article->id]);
			}
		
		}
		
		return $this->render('image', ['model' => $model]);
		
	}
	
/*	public function actionSetCategory($id)
	{
		$article = $this->findModel($id);
		$selectedCategory = $article->category->id; // Тоже самое что и getCategory
		$categories = ArrayHelper::map(Category::find()->all(), 'id', 'title');
		
		if(Yii::$app->request->isPost)
		{ 
			$category = Yii::$app->request->post('category');
			
			if($article->saveCategory($category))
			{
				return $this->redirect(['view', 'id'=>$article->id]);
			}
					
		}
		
		return $this->render('category', 
		[
		'artucle' => $article,
		'selected' => $selectedCategory,
		'categories' => $categories
		]
		);
	}*/
}
