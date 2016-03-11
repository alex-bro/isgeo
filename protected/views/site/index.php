<?php
$this->pageTitle=Yii::app()->name;
?>

<?php if(isset($model)) { ?> <!-- if -->
    <div class="row">
        <?php
        $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array(
                'id',
                array('name'=>'date',
                    'value'=> date("Y-m-d H:i:s",$model->date),
                ),
                'title',
                'fio',
                'url',
                'square',
                array('name'=>'domain.name',
                    'label'=>'Область',),
                array('name'=>'region.name',
                    'label'=>'Район',),
                array('name'=>'area.name',
                    'label'=>'Населенный пункт/совет',),
                array('name'=>'kadnums.path',
                    'type'=>'html',
                    'label'=>'Обменный кадастровый файл xml',
                    'value'=>function($data){return '<a href="'.Yii::app()->request->hostInfo.'/site/sendxml/'.$data->kadnums[0]->id.'">'.$data->kadnums[0]->path.'</a>';}
                    ),
                array('name'=>'description',
                    'type'=>'html',
                ),
            ),
        ));
        ?>
    </div>
    <div class="row">
        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'files-grid',
            'dataProvider'=>$dataFile,
            'columns'=>array(
                array('name' => 'path',
                    'type'=>'html',
                    'value'=>'CHtml::link($data->path,"/site/sendfile/".$data->id)',
                    'header'=>'Файлы',
                    ),
                array('name' => 'date',
                    "type" => "raw",
                    'value'=> 'date("Y-m-d H:i:s",$data->date)',
                    'htmlOptions' => array('width' => '120px'),
                    'header'=>'Дата',
                ),
            ),
        )); ?>
    </div>
<?php }else{ ?> <!-- else -->
    <h3>Начните работу с выбора меню</h3>
<?php }?> <!-- endif -->

