<?php
/* @var $this AreaController */
/* @var $model Area */

$this->breadcrumbs=array(
	'Areas'=>array('index'),
	'Управление',
);

$this->menu=array(
	array('label'=>'Список Area', 'url'=>array('index')),
	array('label'=>'Создать Area', 'url'=>array('create')),
	array('label'=>'Добавить Area', 'url'=>array('add')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#area-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление Areas</h1>


<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'area-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'koatu',
		array('name'=>'region_id',
            'value' => '$data->region->name',
            'filter'=>Controller::getList('Region','name'),
        ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
