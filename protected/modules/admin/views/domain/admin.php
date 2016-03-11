<?php
/* @var $this DomainController */
/* @var $model Domain */

$this->breadcrumbs=array(
	'Domains'=>array('index'),
	'Управление',
);

$this->menu=array(
	array('label'=>'Список Domain', 'url'=>array('index')),
	array('label'=>'Создать Domain', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#domain-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление Domains</h1>


<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'domain-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'koatu',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
