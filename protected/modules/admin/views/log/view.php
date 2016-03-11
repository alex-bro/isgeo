<?php
/* @var $this LogController */
/* @var $model Log */

$this->breadcrumbs=array(
	'Logs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Список Log', 'url'=>array('index')),
	array('label'=>'Создать Log', 'url'=>array('create')),
	array('label'=>'Изменить Log', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить Log', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управление Log', 'url'=>array('admin')),
);
?>

<h1>View Log #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'action',
		'user_id',
		'post_id',
		'date',
	),
)); ?>
