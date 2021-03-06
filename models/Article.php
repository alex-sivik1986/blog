<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $content
 * @property string|null $date
 * @property string|null $image
 * @property int|null $viewed
 * @property int|null $user_id
 * @property int|null $status
 * @property int|null $category_id
 *
 * @property ArticleTag[] $articleTags
 * @property Tag[] $tags
 * @property Comment[] $comments
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }
	

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
			[['title','description', 'content'], 'string'],
			[['date'], 'date', 'format'=>'php:Y-m-d'],
			[['date'], 'default', 'value' => date('Y-m-d')],
			[['title'], 'string', 'max' => 255],
			[['category_id', 'status', 'user_id'], 'integer']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'content' => 'Content',
            'date' => 'Date',
            'image' => 'Image',
            'viewed' => 'Viewed',
            'user_id' => 'User ID',
            'status' => 'Public article?',
            'category_id' => 'Category ID',
        ];
    }
	
	public function getImage()
	{
		if($this->image)
		{
			return '/uploads/' . $this->image;
		}
		
		return '/uploads/no-image.png';
		
	}

	
	public function getCategory()
	{		
		return $this->hasOne(Category::className(), ['id' => 'category_id']);		
	}
	
	public function saveImage($filename)
	{		
		$this->image = $filename;
		return $this->save('false');		
	}
	
	public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])
            ->viaTable('article_tag', ['article_id' => 'id']);
    }
	
    public function	getSelectedTags()
	{
		return $this->getTags()->select('id')->asArray()->all();
	}
	
	public function saveTags($tags)
	{   
		if(is_array($tags)) 
		{

			ArticleTag::deleteAll(['article_id' => $this->id]);

			foreach($tags as $tag_id)
			{				
				$tag = Tag::findOne($tag_id); 
				if($tag) {
					$this->link('tags', $tag);
				}
			}			
			
		}
		
	}
	
	public static function getFeatured() 
	{
		return Article::find()->where(['status' => 1])->andWhere(['!=','category_id',0])->orderBy('viewed desc')->limit(3)->with('category')->all();
	}
	
	public function getViewed($article_id)
	{
		
		$view = Article::findOne($article_id);
		$view->viewed = $view->viewed + 1;
		return	$view->save(false);
		
	}
	
	public function getComments()
	{
		return $this->hasMany(Comment::className(),['article_id' => 'id']);
	}
	
	public function saveArticle() 
	{
		$this->user_id = Yii::$app->user->id;
		return $this->save();
	}
	
/*	public function saveCategory($id)
	{   
		$category = Category::findOne($id);
		
		if($category != Null) 
		{
		$this->link('category',$category);
		return true;
		}
		
	}
*/	

}
