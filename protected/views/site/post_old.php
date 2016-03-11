<?php
/* @var $this PostController */
/* @var $model Post */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'post-post-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // See class documentation of CActiveForm for details on this,
        // you need to use the performAjaxValidation()-method described there.
        'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textField($model,'title'); ?>
        <?php echo $form->error($model,'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'region_id'); ?>
        <?php echo $form->dropDownList($model,'region_id', Controller::getList('Region','name')); ?>
        <?php echo $form->error($model,'region_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'status'); ?>
        <?php echo $form->dropDownList($model,'status', [1 =>'Опубликовать', 2 => 'Черновик']); ?>
        <?php echo $form->error($model,'status'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'url'); ?>
        <?php echo $form->textField($model,'url'); ?>
        <?php echo $form->error($model,'url'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'description'); ?>
        <?php echo $form->textArea($model,'description', array('rows'=>10, 'cols'=>80)); ?>
        <?php echo $form->error($model,'description'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'attachments'); ?>
        <?php  $this->widget('CMultiFileUpload',
            array(
                'model'=>$model,
                'attribute' => 'documents',
                'accept'=> 'jpg,jpeg,gif,png,doc,docx,xls,xlsx,pdf,txt,in4,rar,zip',
                'denied'=>'Разрешаем аттачить только форматы: jpg,jpeg,gif,png,doc,docx,xls,xlsx,pdf,txt,in4,rar,zip',
                'max'=>20,
                'remove'=>'[x]',
                'duplicate'=>'Вы уже прикрепили файл с таким именем. Давайте внимательней!',
            )
        );?>
        <?php echo $form->error($model,'attachments'); ?>
        <div class="hint">Не больше 20-х вложений.</div>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->