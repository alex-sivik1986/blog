<?php
use yii\widgets\ListView;
use sjaakp\loadmore\LoadMorePager;
?>		
</header>
		<!-- /Header -->
		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-8">
						<div class="row">
							<!-- post -->
<?php

echo ListView::widget([
    'dataProvider' => $dataProvider,
	'pager' => [
        'class' => LoadMorePager::class,
		'label' => 'LOAD MORE', 
		'options' => ['class' => 'btn btn-primary'],
    ],
	'summary' => '',
    'itemView' => function ($data, $key, $index, $widget) {
        return $this->render('_list',['index' => $index, 'article' => $data]);
    },
]);
 ?>

						</div>
					</div>
					
			<?=$this->render('_right-sidebar',
						[
						'featured' => $featured,
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
