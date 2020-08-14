<?php
use yii\helpers\Url;
?>

							<div class="col-md-12">
								<div class="post post-row">
									<a class="post-img" href="<?=Url::to(['article', 'id'=>$article->id])?>"><img src="/uploads/<?=$article->image?>" alt=""></a>
									<div class="post-body">
										<div class="post-meta">
											<span class="post-category cat-2" ><?=$article->category->title?></span>
											<span class="post-date"><?=date('F j, Y',strtotime($article->date))?></span>
										</div>
										<h3 class="post-title"><a href="<?=Url::to(['article', 'id'=>$article->id])?>" ><?=$article->title?></a></h3>
										<p><?=$article->description?>...</p>
									</div>
								</div>
							</div>
							<!-- /post -->