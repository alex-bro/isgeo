<?php
/* @var $this DomainController */
/* @var $model Domain */

$this->breadcrumbs=array(
	'Domains'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список Domain', 'url'=>array('index')),
	array('label'=>'Управление Domain', 'url'=>array('admin')),
);
?>

<h1>Создать Domain</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>