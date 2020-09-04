<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\PublicAsset;
use yii\web\View;
use pceuropa\menu\Menu;
PublicAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
	<style>
@media (min-width: 992px) {
.col-md-4 {
    min-height: 349px;
}
}
	</style>
</head>
<body>
<?php $this->beginBody() ?>

		<!-- Header -->
		<header id="header">
			<!-- Nav -->
			<div id="nav">
				<!-- Main Nav -->
				<div id="nav-fixed">
					<div class="container">
						<!-- logo -->
						<div class="nav-logo">
							<a href="/" class="logo"><img src="/frontend/img/logo.png" alt=""></a>
						</div>
						<!-- /logo -->

						<!-- nav -->
<!--	<ul class="nav-menu nav navbar-nav">
							<li><a href="category.html">News</a></li>
							<li><a href="category.html">Popular</a></li>
							<li class="cat-1"><a href="category.html">Web Design</a></li>
							<li class="cat-2"><a href="category.html">JavaScript</a></li>
							<li class="cat-3"><a href="category.html">Css</a></li>
							<li class="cat-4"><a href="category.html">Jquery</a></li>
						</ul>
						<!-- /nav -->					
<?php 
$menu = Menu::NavbarLeft(1);
$t = 0;
foreach($menu as $key=>$li) 
{	
if($t>1) {
	$options['options'] = ['class'=>'cat-'.($t-1)];
	$li += $options;
}
	$menus[$key] = $li;
++$t;	
}
echo Nav::widget([ 'options' => ['class' => 'nav-menu nav navbar-nav'],
					'items' => $menus  // argument is id of menu
				]);	

?>

						
						<?php if(Yii::$app->user->isGuest) {?>
						<div class="nav-btns">
							<a class="btn" href="/auth/register">Register</a>
							<a class="btn" href="/auth/login">Login</a>
						</div>
						<?php } else { ?>
						
			
						<?php echo Html::beginForm(['/auth/logout'], 'post')
								.Html::submitButton(
									'Logout (' . Yii::$app->user->identity->name . ')',
									['class' => 'form-inline', 'style' => 'float:right']
								)
								. Html::endForm() ?>
			
				
						<?php } ?>
						<!-- /nav -->

						<!-- search & aside toggle -->
						<div class="nav-btns">
							<button class="aside-btn"><i class="fa fa-bars"></i></button>
							<button class="search-btn"><i class="fa fa-search"></i></button>
							<div class="search-form">
							<?php echo Html::beginForm(['/site/search'], 'post', ['class' => 'search-input'])
								.Html::input(
									'text',
									'content',
									'',
									[ 'class' => 'search-input', 'placeholder' => 'Enter Your Search ...']
								)
								. Html::endForm() ?>
								<button class="search-close"><i class="fa fa-times"></i></button>
							</div>
						</div>
						<!-- /search & aside toggle -->
					</div>
				</div>
				<!-- /Main Nav -->

				<!-- Aside Nav -->
				<div id="nav-aside">
					<!-- nav -->
					<div class="section-row">
				<?php echo Nav::widget([ 'options' => ['class' => 'nav-aside-menu'],
					'items' => Menu::NavbarRight(2)  // argument is id of menu
				]);	 ?>
					</div>
					<!-- /nav -->

					<!-- widget posts -->
					<div class="section-row">
						<h3>Recent Posts</h3>
<?php
    $article = new \app\models\Article();
	$art = $article->find()->where(['status' => 1])->andWhere(['!=', 'category_id', 0])->orderBy('id desc')->limit(3)->all();
	foreach( $art as $article ){
?>
<div class="post post-widget">
	<a class="post-img" href="<?=Url::to(['site/article', 'id' => $article->id])?>"><img src="uploads/<?=$article->image?>" alt=""></a>
	<div class="post-body">
		<h3 class="post-title"><a href="<?=Url::to(['site/article', 'id' => $article->id])?>"><?=$article->title?></a></h3>
	</div>
</div>
<?php } ?>
					</div>
					<!-- /widget posts -->

					<!-- social links -->
					<div class="section-row">
						<h3>Follow us</h3>
						<ul class="nav-aside-social">
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
						</ul>
					</div>
					<!-- /social links -->

					<!-- aside nav close -->
					<button class="nav-aside-close"><i class="fa fa-times"></i></button>
					<!-- /aside nav close -->
				</div>
				<!-- Aside Nav -->
			</div>
			<!-- /Nav -->
		


<?=$content?>

		<!-- Footer -->
		<footer id="footer">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-5">
						<div class="footer-widget">
							<div class="footer-logo">
								<a href="index.html" class="logo"><img src="frontend/img/logo.png" alt=""></a>
							</div>
							<ul class="footer-nav">
								<li><a href="#">Privacy Policy</a></li>
								<li><a href="#">Advertisement</a></li>
							</ul>
							<div class="footer-copyright">
								<span>&copy; <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></span>
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="row">
							<div class="col-md-6">
								<div class="footer-widget">
									<h3 class="footer-title">About Us</h3>
									<ul class="footer-links">
										<li><a href="about.html">About Us</a></li>
										<li><a href="#">Join Us</a></li>
										<li><a href="contact.html">Contacts</a></li>
									</ul>
								</div>
							</div>
							<div class="col-md-6">
								<div class="footer-widget">
									<h3 class="footer-title">Catagories</h3>
									<ul class="footer-links">
								<?php $category = new \app\models\Category(); 
								$cat = $category->find()->asArray()->all();                  
								foreach($cat as $category) { ?>
								<li><a href="<?=Url::toRoute(['/site/category' , 'id' => $category['id']])?>"><?=$category['title']?></a></li>
								<?php } ?>
										
									</ul>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-3">
						<div class="footer-widget">
							<h3 class="footer-title">Join our Newsletter</h3>
							<div class="footer-newsletter">
<?php $form = \yii\widgets\ActiveForm::begin([
    'id' => 'sub',
    'action' => '/site/subscriber',
    'enableAjaxValidation' => true,
]); ?>
<?= Html::input(
				'email',
				'email',
				'',
				[ 'class' => 'input', 'required' => 'required', 'placeholder' => 'Enter your email']
								); ?>
<?= Html::submitButton('<i class="fa fa-paper-plane"></i>', ['class' => 'newsletter-btn']); ?>
<?php $form->end(); ?>
								
							</div>
							<ul class="footer-social">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
							</ul>
						</div>
					</div>

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</footer>
		<!-- /Footer -->

<?php $this->endBody() ?>
<script>
$('#sub').on('beforeSubmit', function () {
    var $yiiform = $(this);
    $.ajax({
            type: $yiiform.attr('method'),
            url: $yiiform.attr('action'),
            data: $yiiform.serializeArray()
        }
    )
    .done(function(data) {
       if(data.success==true) { 
		  alert('You subscribe');
        } else if(data.success=='unscribe') {
		  alert('You unscribe');
		} else {
		   alert('Error, try again');
        }
    })
    .fail(function () {
		 alert('Error 404')
    })

    return false; 
})
</script>
</body>
</html>
<?php  $this->endPage() ?>
