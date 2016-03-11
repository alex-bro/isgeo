<?php
/* @var $this AreaController */
/* @var $model Area */

$this->breadcrumbs=array(
	'Areas'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Изменить',
);

$this->menu=array(
	array('label'=>'Список Area', 'url'=>array('index')),
	array('label'=>'Создать Area', 'url'=>array('create')),
	array('label'=>'Просмотреть Area', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление Area', 'url'=>array('admin')),
);
?>

<h1>Изменить Area <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>