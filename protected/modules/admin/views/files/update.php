<?php
/* @var $this FilesController */
/* @var $model Files */

$this->breadcrumbs=array(
	'Files'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Изменить',
);

$this->menu=array(
	array('label'=>'Список Files', 'url'=>array('index')),
	array('label'=>'Создать Files', 'url'=>array('create')),
	array('label'=>'Просмотреть Files', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление Files', 'url'=>array('admin')),
);
?>

<h1>Изменить Files <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>