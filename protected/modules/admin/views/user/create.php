<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список User', 'url'=>array('index')),
	array('label'=>'Управление User', 'url'=>array('admin')),
);
?>

<h1>Создать User</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>