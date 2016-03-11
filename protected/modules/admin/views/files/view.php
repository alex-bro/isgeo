<?php
/* @var $this FilesController */
/* @var $model Files */

$this->breadcrumbs=array(
	'Files'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Список Files', 'url'=>array('index')),
	array('label'=>'Создать Files', 'url'=>array('create')),
	array('label'=>'Изменить Files', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить Files', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управление Files', 'url'=>array('admin')),
);
?>

<h1>View Files #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'status',
		'type',
		'path',
		'date',
		'post_id',
	),
)); ?>
