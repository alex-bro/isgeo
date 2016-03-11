<?php
/* @var $this KadnumController */
/* @var $model Kadnum */

$this->breadcrumbs=array(
	'Kadnums'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список Kadnum', 'url'=>array('index')),
	array('label'=>'Управление Kadnum', 'url'=>array('admin')),
);
?>

<h1>Создать Kadnum</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>