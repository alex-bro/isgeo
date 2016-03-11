<?php
/* @var $this DomainController */
/* @var $model Domain */

$this->breadcrumbs=array(
	'Domains'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Изменить',
);

$this->menu=array(
	array('label'=>'Список Domain', 'url'=>array('index')),
	array('label'=>'Создать Domain', 'url'=>array('create')),
	array('label'=>'Просмотреть Domain', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление Domain', 'url'=>array('admin')),
);
?>

<h1>Изменить Domain <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>