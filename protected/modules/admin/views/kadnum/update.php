<?php
/* @var $this KadnumController */
/* @var $model Kadnum */

$this->breadcrumbs=array(
	'Kadnums'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Изменить',
);

$this->menu=array(
	array('label'=>'Список Kadnum', 'url'=>array('index')),
	array('label'=>'Создать Kadnum', 'url'=>array('create')),
	array('label'=>'Просмотреть Kadnum', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление Kadnum', 'url'=>array('admin')),
);
?>

<h1>Изменить Kadnum <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>