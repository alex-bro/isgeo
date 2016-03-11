<?php
/* @var $this FilesController */
/* @var $model Files */

$this->breadcrumbs=array(
	'Files'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список Files', 'url'=>array('index')),
	array('label'=>'Управление Files', 'url'=>array('admin')),
);
?>

<h1>Создать Files</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>