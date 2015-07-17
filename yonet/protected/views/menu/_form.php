<?php
$list = $this->getList();
$criteria=new CDbCriteria;
		$criteria->select='max(ordering) AS ordering';
	$row = $model->find($criteria);
$lastorder = $row['ordering']+1;
$orderdata = CHtml::listData($model->findAll(array('order' => 'ordering')),'ordering','name');
$menulist = CMap::mergeArray(array(0=>'Alt menü değil'),$list);
$typesid = array($model->types_id=>"Daha önce tanımlanmış özel sayfa içeriği");
if ($model->isNewRecord) {
	$model->is_home = 0;
	$model->browsernav = 1;
	$model->ordering = $lastorder;
	$typesid=array();
}
$orderinglist = CMap::mergeArray(array(0=>'0 İlk sırada'),$orderdata,array($lastorder=>$lastorder.' Son sırada'));
$menutypes =
	array(
										'frontpage'		=> 'Anasayfa',
														'link'			=> 'Bağlantı',
										'content'		=> 'Tek Yazı Sayfası',
														'blog'			=> 'Yazı Listesi - Blog',
						'categories'	=> 'Ürün Kategorileri',
						'productlist'	=> 'Ürün Listesi',
						'forgotpass'	=> 'Şifremi Unuttum',
														'login'			=> 'Üye Giriş Sayfası',
										'register'		=> 'Üye Kayıt Sayfası',
										'contact'		=> 'İletişim Sayfası'
	);
	
	$menutype_list = CHtml::listData(Menutypes::model()->findAll(array('order' => 'menutype')),'menutype','menutype');
echo $form->errorSummary($model); ?>
<div class="form-section">
	<h1 class="form-section_title">GENEL BİLGİLER</h1>
	<div class="form-section_content">
		<div class="row">
			<div class="col-md-6">
				<?php
					echo $form->dropDownListGroup($model, 'menutype',array('widgetOptions' => array('data' => $menutype_list)));
				?>
				<div>
					<?php
						echo $form->dropDownListGroup($model, 'parent',array('widgetOptions' => array('data' => $menulist)));
					?>
				</div></div>
				<div class="col-md-6">
					<?php
						echo $form->textFieldGroup($model,'name');
					?>
					<div>
						<?php
							echo $form->textFieldGroup($model,'alias');
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="form-section">
		<h1 class="form-section_title">MENÜ İÇERİĞİ</h1>
		<div class="form-section_content">
			<div class="row">
				<div class="col-md-6">
					<?php
						echo $form->dropDownListGroup($model, 'type',array(
							'widgetOptions' => array(
								'data' => $menutypes,
								'htmlOptions' => array(
						'ajax' => array(
							'type'  => 'GET',
							'url' => Yii::app()->createUrl('menu/fixtypeid'),
							'update' => '#Menu_types_id',
							'data' => array('menutype'=>'js:this.value')
							),
						),
							)
						));
					?>
					<div>
						<?php
							echo $form->dropDownListGroup($model, 'types_id',array('widgetOptions' => array('data' => $typesid)));
						?>
					</div>
				</div>
				<div class="col-md-6">
					<?php
						echo $form->hiddenField($model,'link',array('class'=>'span5'));
						echo $form->dropDownListGroup($model, 'browsernav',array('widgetOptions' =>
						array('data' => array(
							'1'=>'Direkt sayfaya git',
							'2'=>'Sayfayı ayrı bir sekmede görüntüle',
							'3'=>'Sayfayı popup kullanarak görüntüle'
						)
					)));
						//echo $form->textFieldGroup($model,'link',array('labelOptions' => array('class' => "linklabel linkarea","style"=>"display:none"),'class'=>'span5 linkarea','style'=>'display:none','maxlength'=>255));
					?>
					<div>
						<?php echo $form->dropDownListGroup($model, 'ordering',
								array(
									'widgetOptions' => array(
										'data' => $orderinglist,
									)
								)
							);
						?>
					</div>
				</div>
			</div>
			<?php
				echo $form->hiddenField($model,'is_home',array('class'=>'span5'));
				echo $form->switchGroup($model, 'is_published');
			?>
		</div>
	</div>