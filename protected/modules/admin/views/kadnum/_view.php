<?php
/* @var $this KadnumController */
/* @var $data Kadnum */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kad0')); ?>:</b>
	<?php echo CHtml::encode($data->kad0); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kad1')); ?>:</b>
	<?php echo CHtml::encode($data->kad1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kad2')); ?>:</b>
	<?php echo CHtml::encode($data->kad2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kad3')); ?>:</b>
	<?php echo CHtml::encode($data->kad3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('path')); ?>:</b>
	<?php echo CHtml::encode($data->path); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fio')); ?>:</b>
	<?php echo CHtml::encode($data->fio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('post_id')); ?>:</b>
	<?php echo CHtml::encode($data->post_id); ?>
	<br />

	*/ ?>

</div>