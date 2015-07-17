<div class="admin_content col-md-12 main-content main-content--full hide-action">
	<div class="table-area dataTables_wrapper no-footer">
		<?php $this->widget('booster.widgets.TbGridView',array(
		'id'=>'catalog-grid',
		'dataProvider'=>$model->search(),
		'columns'=>array(
				'id',
				'name',
				'intro',
		array(
		'class'=>'booster.widgets.TbButtonColumn',
		'template'=>'{update}{delete}',
		),
		),
		)); ?>
		<div class="form-actions">
			<a href="<?php echo Yii::app()->createUrl('/catalog/create'); ?>" class="btn btn-success" >
				<svg class="td-icon td-icon-add"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-add"></use></svg> Yeni Katalog Ekle
			</a>
		</div>
	</div>
</div>