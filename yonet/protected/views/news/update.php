<div class="form-section">
	<?php
	$form=$this->beginWidget('booster.widgets.TbActiveForm',array(
		'id'=>$model->tableName().'-form',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array('class'=>'', 'enctype'=>'multipart/form-data'),
	));
	$this->renderPartial('/layouts/getlanguages');
	?>
	<div class="main-area col-md-12 main-content main-content--full">
		<div class="form-section margin-reset">
			<h1 class="form-section_title">GENEL BİLGİLER</h1>
			<div class="form-section_content">
				<?php
				echo $this->renderPartial('_form', array('model'=>$model,'form'=>$form,'categories'=>$categories,'orderinglist'=>$orderinglist), true);
			echo "</div></div></div></div>";
			echo $this->renderPartial('/layouts/translate', array('model'=>$model,'form'=>$form), true);
			?>
			<div class="form-actions">
				<?php $this->widget('booster.widgets.TbButton', array(
					'buttonType'=>'submit',
					'encodeLabel'=>false,
					'context'=>'success',
					'htmlOptions'=>array(
						'data-form'=>$model->tableName().'-form'
					),
					'label'=> '<svg class="td-icon td-icon-done"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-done"></use></svg> Haberi Kaydet'
				)); ?>
			</div>
			<?php
			$this->endWidget();
			?>
		</div>