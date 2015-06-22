<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('language')); ?>:</b>
	<?php echo CHtml::encode($data->language); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('document_name')); ?>:</b>
	<?php echo CHtml::encode($data->document_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoice_no')); ?>:</b>
	<?php echo CHtml::encode($data->invoice_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('company')); ?>:</b>
	<?php echo CHtml::encode($data->company); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reference')); ?>:</b>
	<?php echo CHtml::encode($data->reference); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('author')); ?>:</b>
	<?php echo CHtml::encode($data->author); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stopage')); ?>:</b>
	<?php echo CHtml::encode($data->stopage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kdv')); ?>:</b>
	<?php echo CHtml::encode($data->kdv); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shipping')); ?>:</b>
	<?php echo CHtml::encode($data->shipping); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('delivery_place')); ?>:</b>
	<?php echo CHtml::encode($data->delivery_place); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('packaged')); ?>:</b>
	<?php echo CHtml::encode($data->packaged); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('insurance')); ?>:</b>
	<?php echo CHtml::encode($data->insurance); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('installation')); ?>:</b>
	<?php echo CHtml::encode($data->installation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payment_type')); ?>:</b>
	<?php echo CHtml::encode($data->payment_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('delivery_time')); ?>:</b>
	<?php echo CHtml::encode($data->delivery_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('warranty')); ?>:</b>
	<?php echo CHtml::encode($data->warranty); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_date')); ?>:</b>
	<?php echo CHtml::encode($data->create_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_published')); ?>:</b>
	<?php echo CHtml::encode($data->is_published); ?>
	<br />

	*/ ?>

</div>
