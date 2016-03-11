<?php
/* @var $this KadnumController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Kadnums',
);

$this->menu=array(
	array('label'=>'Создать Kadnum', 'url'=>array('create')),
	array('label'=>'Управление Kadnum', 'url'=>array('admin')),
);
?>

<h1>Kadnums</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
