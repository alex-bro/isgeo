<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Изменить',
);

$this->menu=array(
	array('label'=>'Список User', 'url'=>array('index')),
	array('label'=>'Создать User', 'url'=>array('create')),
	array('label'=>'Просмотреть User', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление User', 'url'=>array('admin')),
);
?>

<h1>Изменить User <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>