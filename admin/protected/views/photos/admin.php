<?php
$this->breadcrumbs=array('Fotoğraflar'=>array('index'),'Fotoğraf Listesi');
$gallerydata = CHtml::listData(Gallery::model()->findAll(array('order' => 'id')),'id','name');
$criteria=new CDbCriteria;
		$criteria->select='max(ordering) AS ordering';
	$row = $model->find($criteria);
$lastorder = $row['ordering']+1;
?>
<div class="col-md-12 main-content main-content--full">
	<div class="main-content--body">
		<?php 
			// quick photo add form
			$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',
				array(
					'id'=>'photo-form',
					'enableAjaxValidation'=>false,
					'action' => Yii::app()->createUrl('photos/create'),
					'htmlOptions'=>array('class'=>'well quickadd', 'enctype'=>'multipart/form-data'),
				)
			);
			// quick photo head
			// echo '<div class="well-head"><h3 class="panel-title">Hızlı fotoğraf ekleme</h3></div>';
			// name -text input
			echo $form->textFieldRow($model,'name',array('class'=>'span2','maxlength'=>255));
			// image -file input 
			echo $form->fileFieldRow($model,'image',array('class'=>'span2','maxlength'=>255));
			// gallery -select
			echo $form->dropDownListRow($model, 'gallery', $gallerydata, array('empty'=>'Lütfen bir galeri seçiniz', 'class'=>'span3'));
			// ordering -hidden input
			echo $form->hiddenField($model,'ordering',array('value'=>$lastorder));
			// is_published -hidden input
			echo $form->hiddenField($model,'is_published',array('value'=>1));
			// photo -hidden input
			echo $form->hiddenField($model,'photo',array('value'=>0));
			// submit -button
			$this->widget('bootstrap.widgets.TbButton', 
				array(
					'buttonType'=>'submit',
					'type'=>'success',
					'encodeLabel'=>false,
					'label'=>'<svg class="td-icon td-icon-cloud-done"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-cloud-done"></use></svg> Fotoğraf Ekle',
				)
			);
			// end quick photo add form
			$this->endWidget();

			// Quick photo gallery filter
			/*
			$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',
				array(
					'action'=>Yii::app()->createUrl($this->route),
					'method'=>'get',
					'htmlOptions'=>array('class'=>'quickadd', 'enctype'=>'multipart/form-data'),
				)
			);

			// gallery -select
			echo $form->dropDownListRow($model, 'gallery', $gallerydata, array('empty'=>'Lütfen bir galeri seçiniz', 'class'=>'span3'));
			// submit -button
			$this->widget('bootstrap.widgets.TbButton', 
				array(
					'buttonType' => 'submit',
					'type'=>'primary',
					'encodeLabel'=>false,
					'label'=>'Filtrele',
				)
			);

			// end photo gallery filter form
			$this->endWidget();
			*/

			// photo list
			$this->widget('bootstrap.widgets.TbExtendedGridView',
				array(
					'id'=>'photos-grid',
					'dataProvider'=>$model->search(),
					'htmlOptions'=>
						array('class'=>'dataTable table table-hover no-footer'),
					'sortableRows'=>true,
					'sortableAttribute'=>'ordering',
					'sortableAjaxSave'=>true,
					'sortableAction'=>'photos/sortable',
					'afterSortableUpdate' => 'js:function(id, position){window.location.reload()}',
					'columns'=>
						// array merge for custom column
						array_merge(
							array(
								array(
									// custom column
									'class'=>'bootstrap.widgets.TbImageColumn',
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
								'class'=>'bootstrap.widgets.TbButtonColumn',
							),
						)),
			)); 

			// page end
?>
	</div>
</div
<!-- Main Content -->