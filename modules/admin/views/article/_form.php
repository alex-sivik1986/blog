<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\select2\Select2
/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
	
	<?= $form->field($model, 'category_id')->dropdownList($categories, ['prompt'=> 'Выбор..','class' => 'form-control', 'options' => [ $selected => ['selected' => true] ]]);	?>

    <?=  $form->field($image, 'image')->widget(FileInput::class, [
    'options'=>[
        'multiple'=>false,
        'accept'=>'web/uploads/*'
    ],
    'pluginOptions' => [
        'initialPreview'=> Yii::getAlias("@web/uploads/".$model->image),
        'initialPreviewAsData'=>true,
        'overwriteInitial'=>true,
        'showUpload' =>false,
        'allowedFileExtensions'=>['jpg', 'png'],
    ],
]); ?>
     
        <?php 
        echo Select2::widget([
            'name' => 'tags',
            'data' => $tags,
            'theme' => Select2::THEME_CLASSIC,
            'options' => ['placeholder' => 'Выберите теги ...', 'multiple' => true, 'autocomplete' => 'off'],
            'pluginOptions' => [
                'allowClear' => true,
				'tags' => true,
				
            ],
        ]);
        ?>
    <?= $form->field($model, 'status')->textInput() ?>
	
	


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
