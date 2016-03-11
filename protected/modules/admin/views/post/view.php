<?php
/* @var $this PostController */
/* @var $model Post */

$this->breadcrumbs=array(
	'Posts'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Список Post', 'url'=>array('index')),
	array('label'=>'Создать Post', 'url'=>array('create')),
	array('label'=>'Изменить Post', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить Post', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управление Post', 'url'=>array('admin')),
);
?>

<h1>View Post #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'status',
		'title',
		'fio',
		'date',
		'url',
		'description',
		'square',
		'files_id',
		'domain_id',
		'region_id',
		'area_id',
	),
)); ?>
