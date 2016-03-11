<?php
/* @var $this AreaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Areas',
);

$this->menu=array(
	array('label'=>'Создать Area', 'url'=>array('create')),
	array('label'=>'Управление Area', 'url'=>array('admin')),
);
?>

<h1>Areas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
