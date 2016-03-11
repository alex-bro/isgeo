<?php
/* @var $this RegionController */
/* @var $model Region */

$this->breadcrumbs=array(
	'Regions'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список Region', 'url'=>array('index')),
	array('label'=>'Управление Region', 'url'=>array('admin')),
);
?>

<h1>Создать Region</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>