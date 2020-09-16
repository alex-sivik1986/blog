<?php
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;
?>

 <div id="realcomment-container" class="col-md-12" style="display:none">
         <div class="alert alert-info alert-dismissible fade in" role="alert">
       Update role for user
    </div>
    </div>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
	'filterUrl' => Url::to(['users', 'sort' => 'name']),
    'columns' => [
        'id',
        'name',
        'email',
		[
			'class' => 'yii\grid\CheckboxColumn',
			'header' => 'isAdmin',
			'name' => 'isAdmin',
			'checkboxOptions' => function($model) {
				return [
					'value' => $model->getAdmin(),'id' => '#my_'.$model->id,'data-id' => $model->id,'checked' => ($model->getAdmin())?true:false
					   ];
			}		
		],
		
		[   
			'format' => 'text',
			'label' => 'Status',
			'value' => function($data) {
				return $data->getStatus();
			}
		],		
		[
			'label' => 'Action',
			'format' => 'raw',
			'value' => function($data){
				return Html::a(
					$data->textStatus(),
					'users/'.$data->textStatus().'?id='.$data->getId(),
					[
						'class' => 'btn btn-success'
					]
				);
			}
		],
		
		
		
        // ...
    ],
]) ?>

<?php 
$url = Url::to(['users/isadmin']);

$sript = <<< JS
$(document).ready(function(){
	$('input[type="checkbox"]').on('change', function(){
		$(this).each(function(){
			if ($(this).is(':checked')){
				//alert($(this).attr('data-id'));
				//alert('Включен');	
				check = 1;
			} else {
				//alert($(this).attr('data-id'));
				//alert('Выключен');
				check = 0;
			}
			id_user = $(this).attr('data-id');
			$.ajax({	
					url: '$url',
					type: 'POST',
					data: {id_user:id_user, check:check},
					success: function(data){
						 $('#realcomment-container').css('display','block');
						 setTimeout(function(){
							 $('#realcomment-container').css('display','none');
						 }, 5000)
						// $('#realcomment-container').html(data);
					},
					error: function(jqXHR, errMsg) {
						 alert('Error!');
					}
				})
			
		});
	})
})
JS;

$this->registerJs($sript);
?>