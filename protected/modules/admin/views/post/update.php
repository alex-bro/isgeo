<?php
/* @var $this PostController */
/* @var $model Post */

$this->breadcrumbs=array(
	'Posts'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Изменить',
);

$this->menu=array(
	array('label'=>'Список Post', 'url'=>array('index')),
	array('label'=>'Создать Post', 'url'=>array('create')),
	array('label'=>'Просмотреть Post', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление Post', 'url'=>array('admin')),
);
?>

<h1>Изменить Post <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>