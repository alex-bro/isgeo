<?php
/* @var $this FilesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Files',
);

$this->menu=array(
	array('label'=>'Создать Files', 'url'=>array('create')),
	array('label'=>'Управление Files', 'url'=>array('admin')),
);
?>

<h1>Files</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
