<?php 

$this->widget('booster.widgets.TbGridView',array(
'id'=>'product-attrib-grid',
'dataProvider'=>$model->search(),
'columns'=>array(
		'id',
		'prefix',
		'title',
		'container',
		'is_published',
array(
'class'=>'booster.widgets.TbButtonColumn',
),
),
)); ?>
