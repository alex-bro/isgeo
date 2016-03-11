<?php
/* @var $this RegionController */
/* @var $model Region */

$this->breadcrumbs=array(
	'Regions'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Список Region', 'url'=>array('index')),
	array('label'=>'Создать Region', 'url'=>array('create')),
	array('label'=>'Изменить Region', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить Region', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управление Region', 'url'=>array('admin')),
);
?>

<h1>View Region #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'koatu',
		'domain_id',
	),
)); ?>
