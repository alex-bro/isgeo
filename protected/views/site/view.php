<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'post-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'title',
        'fio',
        array('name' => 'date',
            "type" => "raw",
            'value'=> 'date("Y-m-d H:i:s",$data->date)',
            'htmlOptions' => array('width' => '120px'),
            'header'=>'Дата',
        ),
        array('name'=>'url',
            "type" => "html",
            'value'=> 'CHtml::link($data->url,$data->url)',
            ),
        array('name'=>'square',
            'htmlOptions' => array('width' => '20px'),
            ),
        array(
            'class'=>'CButtonColumn',
            'viewButtonUrl' => 'Yii::app()->createUrl("site/index", array("id"=>$data->id))',
            'updateButtonUrl' => 'Yii::app()->createUrl("site/post", array("id"=>$data->id))',
        ),
    ),
)); 