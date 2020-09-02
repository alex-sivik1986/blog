<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

<table class="table"><thead>
<tr><td>ID</td><td>Article title</td><td>User</td><td>Comment</td><td>Action</td></tr>
</thead>
<tbody>
<?php foreach($comments as $comment) { ?>
<tr><td><?=$comment->id?></td><td><?=$comment->article->title?></td><td><?=$comment->user->name?></td><td><?=$comment->text?></td>
<td>
<a class="btn btn-danger" href="<?=Url::to(['comment/delete', 'id' => $comment->id])?>" > Delete </a> 
<?php if($comment->status) { ?>
<a class="btn btn-warning" href="<?=Url::to(['comment/disallow', 'id' => $comment->id])?>" > Disallow </a>
<?php } else { ?>
<a class="btn btn-success" href="<?=Url::to(['comment/allow', 'id' => $comment->id])?>" > Allow </a>
<?php } ?>
</td>
</tr>
<?php } ?>
</tbody>
</table>

</div>