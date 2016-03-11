<?php
/* @var $this PostController */
/* @var $model Post */

$this->breadcrumbs=array(
	'Posts'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список Post', 'url'=>array('index')),
	array('label'=>'Управление Post', 'url'=>array('admin')),
);
?>

<h1>Создать Post</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>