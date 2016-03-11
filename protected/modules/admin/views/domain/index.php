<?php
/* @var $this DomainController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Domains',
);

$this->menu=array(
	array('label'=>'Создать Domain', 'url'=>array('create')),
	array('label'=>'Управление Domain', 'url'=>array('admin')),
);
?>

<h1>Domains</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
