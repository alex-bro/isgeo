<?php
/* @var $this KadnumController */
/* @var $model Kadnum */

$this->breadcrumbs=array(
	'Kadnums'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Список Kadnum', 'url'=>array('index')),
	array('label'=>'Создать Kadnum', 'url'=>array('create')),
	array('label'=>'Изменить Kadnum', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить Kadnum', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управление Kadnum', 'url'=>array('admin')),
);
?>

<h1>View Kadnum #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'status',
		'kad0',
		'kad1',
		'kad2',
		'kad3',
		'date',
		'path',
		'title',
		'fio',
		'post_id',
	),
)); ?>
