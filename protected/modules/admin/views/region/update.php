<?php
/* @var $this RegionController */
/* @var $model Region */

$this->breadcrumbs=array(
	'Regions'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Изменить',
);

$this->menu=array(
	array('label'=>'Список Region', 'url'=>array('index')),
	array('label'=>'Создать Region', 'url'=>array('create')),
	array('label'=>'Просмотреть Region', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление Region', 'url'=>array('admin')),
);
?>

<h1>Изменить Region <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>