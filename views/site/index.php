<?php
use yii\helpers\Url;
?>
</header>
		<!-- /Header -->
		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">	

<?php foreach($first as $post): ?>
					<div class="col-md-6">
						<div class="post post-thumb">
							<a class="post-img" href="<?=Url::to(['article', 'id' => $post->id])?>"><img src="/uploads/<?=$post->image?>" alt=""></a>
							<div class="post-body">
								<div class="post-meta">
									<a class="post-category cat-2" href="<?=Url::to(['category', 'id' => $post->category_id])?>"><?=$post->category->title?></a>
									<span class="post-date"><?=date('F j, Y', strtotime($post->date))?></span>
								</div>
								<h3 class="post-title"><a href="<?=Url::to(['article', 'id' => $post->id])?>"><?=$post->title?></a></h3>
							</div>
						</div>
					</div>
<?php  endforeach; ?>

				</div>
				<!-- /row -->

				<!-- row -->
				<div class="row">
			
<?php foreach($middle as $m_post): ?>
					<!-- post -->
					<div class="col-md-4">
						<div class="post">
							<a class="post-img" href="<?=Url::to(['article', 'id' => $m_post->id])?>"><img src="/uploads/<?=$m_post->image?>" alt=""></a>
							<div class="post-body">
								<div class="post-meta">
									<a class="post-category cat-1" href="<?=Url::to(['category', 'id' => $m_post->category_id])?>"><?=$m_post->category->title?></a>
									<span class="post-date"><?=date('F j, Y', strtotime($m_post->date))?></span>
								</div>
								<h3 class="post-title"><a href="<?=Url::to(['article', 'id' => $m_post->id])?>"><?=$m_post->title?></a></h3>
							</div>
						</div>
					</div>
					<!-- /post -->
<?php  endforeach; ?>
					
				</div>
				<!-- /row -->

				<!-- row -->
				<div class="row">
					<div class="col-md-8">
					<div class="col-md-12">
						<div class="section-title text-center">
							<h2>Most commented</h2>
						</div>
					</div>
						<div class="row">
							<!-- post -->
							<div class="col-md-12">
								<div class="post post-thumb">
								
									<a class="post-img" href="<?=Url::to(['site/article', 'id' => $most_comment->id])?>"><img src="uploads/<?=$most_comment->image?>" alt=""></a>
									<div class="post-body">
										<div class="post-meta">
											<a class="post-category cat-3" href="<?=Url::to(['category', 'id' => $most_comment->category_id])?>"><?=$most_comment->category->title?></a>
											<span class="post-date"><?=date('F j, Y', strtotime($most_comment->date))?></span>
										</div>
										<h3 class="post-title"><a href="<?=Url::to(['site/article', 'id' => $most_comment->id])?>"><?=$most_comment->title?></a></h3>
									</div>
								</div>
							</div>
							<!-- /post -->


					
					
						</div>
					</div>

					<div class="col-md-4">
						<!-- post widget -->
						<!-- catagories -->
						<div class="aside-widget">
							<div class="section-title">
								<h2>Catagories</h2>
							</div>
							<div class="category-widget">
					
								<ul>
								<?php $m = 1; foreach($categories as $category): ?>
							
									<li><a href="<?=Url::to(['category', 'id' => $category->id])?>" class="cat-<?=$m?>"><?=$category->title?><span><?=$category->getArticles()->count()?></span></a></li>

									<? ++$m; endforeach; ?>
								</ul>
							</div>
						</div>
						<!-- /catagories -->
						
						<!-- tags -->
						<div class="aside-widget">
							<div class="tags-widget">
								<ul>
								<?php foreach($tags as $key => $tag) { ?>
									<li><a href="<?=Url::toRoute(['site/tag', 'name' => $tag])?>"><?=$tag?></a></li>
								<?php } ?>
								</ul>
							</div>
						</div>
						<!-- /tags -->
			
	
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->
		
		<!-- section -->
		<div class="section section-grey">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="section-title text-center">
							<h2>Featured Posts</h2>
						</div>
					</div>

			
<? foreach($featured as $article): ?>
					<div class="col-md-4">
						<div class="post">
							<a class="post-img" href="<?=Url::to(['article', 'id' => $article->id])?>"><img src="/uploads/<?=$article->image?>" alt=""></a>
							<div class="post-body">
								<div class="post-meta">
									<a class="post-category cat-2" href="<?=Url::to(['category', 'id' => $article->category_id])?>"><?=$article->category->title?></a>
									<span class="post-date"><?
echo \Yii::$app->formatter->asDate($article->date, 'long');?></span>
								</div>
								<h3 class="post-title"><a href="<?=Url::to(['article', 'id' => $article->id])?>"><?=$article->title?></a></h3>
							</div>
						</div>
					</div>
<? endforeach; ?>

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->

