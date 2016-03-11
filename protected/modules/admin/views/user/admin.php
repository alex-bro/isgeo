<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Управление',
);

$this->menu=array(
	array('label'=>'Список User', 'url'=>array('index')),
	array('label'=>'Создать User', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление Users</h1>


<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'login',
		//'password',
		'realname',
		'email',
		array('name'=>'user_role_id',
            'value' => '$data->userRole->role',
            'filter'=>Controller::getList('UserRole','role'),
            'htmlOptions'=>array('width'=>'100px',),
            ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
