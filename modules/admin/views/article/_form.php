<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

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
        'showUpload' =>true,
        'allowedFileExtensions'=>['jpg', 'png'],
		'initialPreviewConfig' => [
            ['caption' => $model->image],

        ],
    ],
	
]); ?>
     
        <?php 

echo Select2::widget([
    'name' => 'tags',
    'value' => ($selectedTags)?ArrayHelper::getColumn($selectedTags,'id'):'', // initial value
    'data' => $tags,
    'maintainOrder' => true,
    'options' => ['placeholder' => 'Выберите теги ...', 'multiple' => true],
    'pluginOptions' => [
        'tags' => true,
        'maximumInputLength' => 10
    ],
]);
        ?>
    <?= $form->field($model, 'status')->textInput() ?>
	
	


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
