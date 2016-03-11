<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'post-post-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>
    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $this->renderPartial('upload');?>
    </div>
    <hr>
    <div class="col">
        <div class="row">
            <?php echo $form->labelEx($model,'status'); ?>
            <?php echo $form->dropDownList($model,'status', [1 =>'Опубликовать', 2 => 'Черновик']); ?>
            <?php echo $form->error($model,'status'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'domain_id'); ?>
            <?php echo $form->dropDownList($model,'domain_id', Controller::getList('Domain','name')); ?>
            <?php echo $form->error($model,'domain_id'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'region_id'); ?>
            <?php echo $form->dropDownList($model,'region_id', Controller::getList('Region','name')); ?>
            <?php echo $form->error($model,'region_id'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'area_id'); ?>
            <?php echo $form->dropDownList($model,'area_id', Controller::getList('Area','name')); ?>
            <?php echo $form->error($model,'area_id'); ?>
        </div>
    </div>

    <div class="col">
        <div class="row">
            <?php echo $form->labelEx($model,'square'); ?>
            <?php echo $form->textField($model,'square'); ?>
            <?php echo $form->error($model,'square'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'title'); ?>
            <?php echo $form->textField($model,'title',['size'=>50]); ?>
            <?php echo $form->error($model,'title'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'fio'); ?>
            <?php echo $form->textField($model,'fio',['size'=>50]); ?>
            <?php echo $form->error($model,'fio'); ?>
        </div>
    </div>
    <div class="row">

        <?php echo $form->labelEx($model,'archive'). 'Максимальный размер файла '.ini_get('upload_max_filesize'); ?>
        <?php echo $form->error($model,'archive'); ?>
        <?php echo CHtml::activeFileField($model, 'archive'); ?>

    </div>
    <div class="clear"></div>

    <div class="row">
        <?php echo $form->labelEx($model,'description'); ?>
        <?php
        $this->widget('ext.tinymce.TinyMce', array(
            'model' => $model,
            'attribute' => 'description',
            'language'=>"ru",
            'compressorRoute' => 'tinyMce/compressor',
            'htmlOptions' => array(
                'rows' => 6,
                'cols' => 60,
            ),
        ));
        ?>
    </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Записать'); ?>
        <?php echo CHtml::button('Отчистить', array('submit' => array('site/clear'),
            'confirm'=>"Вы уверены, что хотите отчистить ?"));?>
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->