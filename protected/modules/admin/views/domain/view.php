<?php
/* @var $this DomainController */
/* @var $model Domain */

$this->breadcrumbs=array(
	'Domains'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Список Domain', 'url'=>array('index')),
	array('label'=>'Создать Domain', 'url'=>array('create')),
	array('label'=>'Изменить Domain', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить Domain', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управление Domain', 'url'=>array('admin')),
);
?>

<h1>View Domain #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'koatu',
	),
)); ?>
