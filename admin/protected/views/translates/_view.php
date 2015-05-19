<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lang_id')); ?>:</b>
	<?php echo CHtml::encode($data->lang_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reference_id')); ?>:</b>
	<?php echo CHtml::encode($data->reference_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reference_table')); ?>:</b>
	<?php echo CHtml::encode($data->reference_table); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reference_field')); ?>:</b>
	<?php echo CHtml::encode($data->reference_field); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('value')); ?>:</b>
	<?php echo CHtml::encode($data->value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('original_value')); ?>:</b>
	<?php echo CHtml::encode($data->original_value); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('original_text')); ?>:</b>
	<?php echo CHtml::encode($data->original_text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified')); ?>:</b>
	<?php echo CHtml::encode($data->modified); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_by')); ?>:</b>
	<?php echo CHtml::encode($data->modified_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_published')); ?>:</b>
	<?php echo CHtml::encode($data->is_published); ?>
	<br />

	*/ ?>

</div>