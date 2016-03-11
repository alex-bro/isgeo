<?php
/* @var $this AreaController */
/* @var $model Area */

$this->breadcrumbs=array(
	'Areas'=>array('index'),
	'Добавить',
);

$this->menu=array(
	array('label'=>'Список Area', 'url'=>array('index')),
	array('label'=>'Управление Area', 'url'=>array('admin')),
);
?>

<h1>Создать Area</h1>

<?php $this->renderPartial('_add', array('model'=>$model)); ?>