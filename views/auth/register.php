<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
	</header>
		<!-- /Header -->
	<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- Post content -->
					<div class="col-md-8">
						<div class="section-row sticky-container">
							<div class="main-post">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2'],
        ],
    ]); ?>

        <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
		
		<?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

       
        <div class="form-group">
            <div class="col-lg-11">
                <?= Html::submitButton('Register', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

 	
							</div>
</div>
</div>
					<!-- /Post content -->

			<?=$this->render('../site/_right-sidebar',
						[
						'featured' => $featured,
						'most_read' => $most_read,
						'categories' => $categories
						]

						)?>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->
