<?php echo $this->renderPartial('_quick_form', array('model'=>$model,'galleries'=>$galleries,'lastorder'=>$lastorder));  ?>
<div class="table-area dataTables_wrapper no-footer">
	<?php
	$this->widget('booster.widgets.TbExtendedGridView',
		array(
			'id'=>'photos-grid',
			'dataProvider'=>$model->search(),
			'htmlOptions'=>array('class'=>''),
			'sortableRows'=>true,
			'sortableAttribute'=>'ordering',
			'summaryText' => '{count} sonuç bulundu.',
			'sortableAjaxSave'=>true,
			'sortableAction'=>'photos/sortable',
			'afterSortableUpdate' => 'js:function(id, position){window.location.reload()}',
			'columns'=>
				// array merge for custom column
				array_merge(
					array(
						array(
							// custom column
							'class'=>'booster.widgets.TbImageColumn',
							// column title
							'header'=>'Fotoğraf',
							// photo width
							'imageOptions'=>array('width'=>50),
							// photo url recognize
							'imagePathExpression'=>function($row,$data) {
								// get photo path for mini photo view
								$photo_path = Yii::app()->settings->get("photo","photo_path");
								// print photo link
								return Yii::app()->baseUrl . '/../'.$photo_path.$data->photo;
							}
						),
					),
					array(
						// ordering column
						array(
							// column title
							'name'=>'ordering_search',
							// column html encode
							'type'=>'raw',
							// column value
							'value'=>
								function($data) {
									return '<div class="sortable-button sortable-button_drag">
													<div class="sortable-count badge">'.$data->ordering.'</div>
													<svg class="td-icon td-icon-swap-vert">
																	<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-swap-vert"></use>
													</svg>
									</div>';
								},
							// column id
							'id'=>'ordering_id'
						),
						'name',
						// gallery column
						array(
							'name'=>'gallery_search',
							'value'=>'$data->gallery0->name'
						),
						'url',
					array(
						'class'=>'booster.widgets.TbButtonColumn',
						'updateButtonUrl' => 'Yii::app()->controller->createUrl("update",array("type"=>$data->gallery0->slug,"id"=>$data->primaryKey))',
					),
				))
	));
	// page end
	?>
</div>
<!-- Main Content -->