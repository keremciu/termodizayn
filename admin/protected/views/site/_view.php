	<div class="well">
	<span class="pull-left">
	<b><?php echo CHtml::encode($data->getAttributeLabel('user')); ?>:</b>
	<?php
	$user = User::model()->findByPk($data->user);
	 echo CHtml::encode($user->name . ' ' . $user->lastname); ?>
	</span>
	<span class="pull-right">
	<b><?php echo CHtml::encode($data->getAttributeLabel('datime')); ?>:</b>
	<?php echo Yii::app()->dateFormatter->format('dd MMMM yyyy HH:mm:ss',$data->datime); ?>
	</span>
	<br>
	<b><?php echo CHtml::encode($data->getAttributeLabel('message')); ?>:</b>
	<?php echo CHtml::encode($data->message); ?>
	</div>
