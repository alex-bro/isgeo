<?php
/* @var $this AreaController */
/* @var $model Area */

$this->breadcrumbs=array(
	'Areas'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Список Area', 'url'=>array('index')),
	array('label'=>'Создать Area', 'url'=>array('create')),
	array('label'=>'Изменить Area', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить Area', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управление Area', 'url'=>array('admin')),
);
?>

<h1>View Area #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'koatu',
		'region_id',
	),
)); ?>
