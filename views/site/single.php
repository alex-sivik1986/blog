<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\Session;
?>
				<!-- Page Header -->
			<div id="post-header" class="page-header">
				<div class="background-img" style="background-image: url('/uploads/<?=$article->image?>');"></div>
				<div class="container">
					<div class="row">
						<div class="col-md-10">
							<div class="post-meta">
								<a class="post-category cat-2" href="<?=Url::toRoute(['site/category', 'id' => $article->category_id])?>"><?=$article->category->title?></a>
								<span class="post-date"><?= \Yii::$app->formatter->asDate($article->date, 'long');?></span>
							</div>
							<h1><?=$article->title?></h1>
						</div>
					</div>
				</div>
			</div>
			<!-- /Page Header -->
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
							
								<?=$article->content?>
								
							</div>
							<div class="post-shares sticky-shares">
								<a href="#" class="share-facebook"><i class="fa fa-facebook"></i></a>
								<a href="#" class="share-twitter"><i class="fa fa-twitter"></i></a>
								<a href="#" class="share-google-plus"><i class="fa fa-google-plus"></i></a>
								<a href="#" class="share-pinterest"><i class="fa fa-pinterest"></i></a>
								<a href="#" class="share-linkedin"><i class="fa fa-linkedin"></i></a>
								<a href="#"><i class="fa fa-envelope"></i></a>
							</div>
						</div>
						
						<!-- author -->
					<!--	<div class="section-row">
							<div class="post-author">
								<div class="media">
									<div class="media-left">
										<img class="media-object" src="./img/author.png" alt="">
									</div>
									<div class="media-body">
										<div class="media-heading">
											<h3>John Doe</h3>
										</div>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
										<ul class="author-social">
											<li><a href="#"><i class="fa fa-facebook"></i></a></li>
											<li><a href="#"><i class="fa fa-twitter"></i></a></li>
											<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
											<li><a href="#"><i class="fa fa-instagram"></i></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>-->
						<!-- /author -->

						<!-- comments -->
						<div class="section-row">
						<? if(!empty($comments)): ?>
							<div class="section-title">
								<h2><?=$comments->count?> Comments</h2>
							</div>
						<? endif; ?>
							<div class="post-comments">

								<!-- comment -->
								<? foreach($comments as $comment): ?>
								<div class="media">
									<div class="media-left">
										<img class="media-object" src="frontend/img/avatar.png" alt="">
									</div>
									<div class="media-body">
										<div class="media-heading">
											<h4><?=$comment->user->name?></h4>
											<span class="time"><?= \Yii::$app->formatter->asDate($comment->date, 'long')?></span>
											<!--<a href="#" class="reply">Reply</a>-->
										</div>
										<p><?=$comment->text?></p>
									</div>
								</div>
								<? endforeach; ?>
								<!-- /comment -->
							</div>
						</div>
						<!-- /comments -->

						<!-- reply -->
						<div class="section-row">
							<div class="section-title">
								<h2>Leave a reply</h2>
								<p>your email address will not be published. required fields are marked *</p>
<?php if(Yii::$app->session->getFlash('comment')) { ?>
<div class="alert alert-success">
	<?=Yii::$app->session->getFlash('comment')?>
</div>
<?php } ?>
							</div>
<?php if(!Yii::$app->user->isGuest) { ?>
					<?php $form = ActiveForm::begin([
									'action' => ['/site/comment', 'id' => $article->id], 
									'options' => ['class'=>'post-reply']
									]); ?>
								<div class="row">
								
									<div class="col-md-12">
										<div class="form-group">
										<?=$form->field($comment_form, 'comment_text')->textarea(['class' => 'input', 'placeholder' => 'Message'])->label('')?>
										</div>
										<?=Html::submitButton('Submit',['class' => 'primary-button'])?>
				
									</div>
								</div>
							
					<?php ActiveForm::end() ?>
<?php } ?>
						</div>
						<!-- /reply -->
					</div>
					<!-- /Post content -->

			<?=$this->render('_right-sidebar',
						[
						'featured' => $featured,
						'most_read' => $most_read,
						'categories' => $categories,
						'tags' => $tags
						]

						)?>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->
