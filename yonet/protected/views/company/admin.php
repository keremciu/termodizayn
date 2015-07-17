<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'company-grid',
'dataProvider'=>$model->search(),
'columns'=>array(
		'id',
		'name',
		'logo',
		'author',
		'address',
		'phone',
		/*
		'fax',
		'email',
		'web',
		'sicilno',
		'offer_count',
		'is_published',
		*/
array(
'class'=>'booster.widgets.TbButtonColumn',
),
),
)); ?>
