<?php
/* @var $this KadnumController */
/* @var $model Kadnum */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'kadnum-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля с  <span class="required">*</span> должны быть заполнены.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kad0'); ?>
		<?php echo $form->textField($model,'kad0',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'kad0'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kad1'); ?>
		<?php echo $form->textField($model,'kad1',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'kad1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kad2'); ?>
		<?php echo $form->textField($model,'kad2',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'kad2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kad3'); ?>
		<?php echo $form->textField($model,'kad3',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'kad3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'path'); ?>
		<?php echo $form->textField($model,'path',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'path'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fio'); ?>
		<?php echo $form->textField($model,'fio',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'fio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'post_id'); ?>
		<?php echo $form->textField($model,'post_id'); ?>
		<?php echo $form->error($model,'post_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->