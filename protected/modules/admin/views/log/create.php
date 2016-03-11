<?php
/* @var $this LogController */
/* @var $model Log */

$this->breadcrumbs=array(
	'Logs'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список Log', 'url'=>array('index')),
	array('label'=>'Управление Log', 'url'=>array('admin')),
);
?>

<h1>Создать Log</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>