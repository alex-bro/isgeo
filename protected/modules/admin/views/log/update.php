<?php
/* @var $this LogController */
/* @var $model Log */

$this->breadcrumbs=array(
	'Logs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Изменить',
);

$this->menu=array(
	array('label'=>'Список Log', 'url'=>array('index')),
	array('label'=>'Создать Log', 'url'=>array('create')),
	array('label'=>'Просмотреть Log', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление Log', 'url'=>array('admin')),
);
?>

<h1>Изменить Log <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>