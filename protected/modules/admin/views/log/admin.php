<?php
/* @var $this LogController */
/* @var $model Log */

$this->breadcrumbs=array(
	'Logs'=>array('index'),
	'Управление',
);

$this->menu=array(
	array('label'=>'Список Log', 'url'=>array('index')),
	array('label'=>'Создать Log', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#log-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление Logs</h1>



<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'log-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array('name'=>'id',
            'htmlOptions' => array('width' => '10px'),
            ),
		//'action',
        array('name'=>'action',
            'value' => '$data->action_list->name',
            //'filter'=>Controller::getList('UserRole','role'),
            //'htmlOptions'=>array('width'=>'100px',),
        ),
        array('name'=>'user_id',
            'value' => '$data->user->login',
            //'filter'=>Controller::getList('UserRole','role'),
            //'htmlOptions'=>array('width'=>'100px',),
        ),
		'post_id',
        array('name' => 'date',
            "type" => "raw",
            'value'=> 'date("Y-m-d H:i:s",$data->date)',
            'htmlOptions' => array('width' => '120px'),
        ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
