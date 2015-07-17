<div class="admin_content col-md-12 main-content main-content--full hide-action">
	<div class="table-area dataTables_wrapper no-footer">
		<?php
			$this->widget('booster.widgets.TbExtendedGridView', array(
				'dataProvider' => $model->search(),
				'sortableRows'=>true,
				'afterAjaxUpdate'=>'js:function(id, position){alert"a}}',
				'sortableAttribute'=>'ordering',
				'sortableAjaxSave'=>true,
				'sortableAction'=>'product/sortable',
				'afterSortableUpdate' => 'js:function(id, position){window.location.reload()}',
				'updateSelector'=>'.dataTables_wrapper',
				'columns'=>array(
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
					'title',
					array( 'name'=>'category_search', 'value'=>'$data->category0->title'),
					array(
						'class'=>'booster.widgets.TbToggleColumn',
						'toggleAction'=>'product/toggle',
						'name' => 'is_published',
						'header' => 'Aktif'
					),
					array(
						'class'=>'booster.widgets.TbButtonColumn',
						'template'=>'{update}{delete}',
					),
				),
				));
		?>
		<div class="form-actions">
			<a href="<?php echo Yii::app()->createUrl('/product/create'); ?>" class="btn btn-success" >
				<svg class="td-icon td-icon-add"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-add"></use></svg> Yeni Ürün Ekle
			</a>
		</div>
	</div>
</div>