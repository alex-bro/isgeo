<?php
/* @var $this AreaController */
/* @var $model Area */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'area-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation'=>false,
    )); ?>

    <p class="note">Поля с  <span class="required">*</span> должны быть заполнены.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textArea($model,'name', array('rows'=>20, 'cols'=>50)); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>



    <div class="row">
        <?php echo $form->labelEx($model,'region_id'); ?>
        <?php echo $form->dropDownList($model,'region_id', Controller::getList('Region','name')); ?>
        <?php echo $form->error($model,'region_id'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->