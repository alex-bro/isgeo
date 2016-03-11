<?php
/* @var $this KadnumController */
/* @var $model Kadnum */

$this->breadcrumbs=array(
	'Kadnums'=>array('index'),
	'Управление',
);

$this->menu=array(
	array('label'=>'Список Kadnum', 'url'=>array('index')),
	array('label'=>'Создать Kadnum', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#kadnum-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление Kadnums</h1>



<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'kadnum-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'status',
		'kad0',
		'kad1',
		'kad2',
		'kad3',
		/*
		'date',
		'path',
		'title',
		'fio',
		'post_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
