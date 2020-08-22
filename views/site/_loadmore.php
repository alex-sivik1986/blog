<?php
use yii\widgets\ListView;
use sjaakp\loadmore\LoadMorePager;


echo ListView::widget([
    'dataProvider' => $dataProvider,
	'pager' => [
        'class' => LoadMorePager::class,
		'label' => 'LOAD MORE', 
		'options' => ['class' => 'btn btn-primary'],
    ],
	'summary' => '',
    'itemView' => function ($data, $key, $index, $widget) {
        return $this->render('_load',['index' => $index, 'article' => $data]);

        // or just do some echo
 //return $model->title . ' posted by ' . $model->author;
    },
]);
 ?>

