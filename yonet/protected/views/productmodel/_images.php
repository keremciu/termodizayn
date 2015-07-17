<?php $model_path = Yii::app()->settings->get("photo","model_path"); ?>
<!-- Section - #3 _ Main Photo -->
<div class="form-section">
	<h1 class="form-section_title">MODEL KAPAK FOTOĞRAFI</h1>
	<div class="form-section_content">
		<div id="product-image-upload" action="<?php echo Yii::app()->createUrl("productmodel/fileupload"); ?>" method="POST" enctype="multipart/form-data" data-trigger-input="ProductModel_image" >
			<!-- File Upload -->
			<?php
					// get model image
					if (strlen($model->image) > 0) {
						echo '<div class="files-container has-image" data-id="'.$model->id.'" data-input="ProductModel_image" data-delete-url="'.Yii::app()->createUrl("productmodel/imagedelete").'" data-img="'.Yii::app()->baseUrl.'/../'.$model_path.$model->image.'">';
					} else {
						echo '<div class="files-container">';
						}
					?>
					<!-- File Upload - List -->
					<div class="files-list">
						<div class="files-template files-template-thumb" data-id="<%=uid%>" title="<%-name%>, <%-sizeText%>">
							<div class="files-template-delete" data-fileapi="file.remove">
								<svg class="td-icon td-icon-cancel"><use xlink:href="#icon-cancel"></use></svg>
							</div>
							<div class="files-template-progress progress">
								<div class="files-template_progress-bar progress-bar"></div>
							</div>
							<div class="files-template-preview">
								<div class="files-template-preview_img"></div>
							</div>
						</div>
					</div>
					<!-- File Upload - Buttons -->
					<div class="files-buttons">
						<div class="files-buttons_browse">
							<label for="files-browse">
								<svg class="td-icon td-icon-my-library-add"><use xlink:href="#icon-my-library-add"></use></svg>
							</label>
							<input id="files-browse" type="file" name="filedata">
							<?php echo $form->hiddenField($model,'image'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Section - #4 _ Extra Photos -->
	<div class="form-section">
		<h1 class="form-section_title">FOTOĞRAFLAR</h1>
		<div class="form-section_content">
			<div id="product-gallery-upload" action="<?php echo Yii::app()->createUrl("productmodel/fileupload"); ?>" method="POST" enctype="multipart/form-data">
				<!-- File Upload -->
				<div class="files-container extra-images">
					<?php
						$images = Mimages::model()->findAll(array('condition' => 'type = "image" AND mid = :mid','params'=>array(':mid'=>$model->id)));
						
						// get model image
						foreach ($images as $key => $img) {
							echo '<div class="old-images" data-id="'.$img->id.'" data-delete-url="'.Yii::app()->createUrl("productmodel/extraitemdelete").'"
							data-img="'.Yii::app()->baseUrl.'/../'.$model_path.'extras/'.$img->path.'">';
							?>
							<div class="files-template-input">
								<label for="eximagedesc<?php echo $img->id;?>">#<?php echo $key;?> Açıklaması</label>
								<input maxlength="255" name="Eximagedescs[eximagedesc<?php echo $img->id; ?>]" value="<?php echo $img->name; ?>" id="eximagedesc<?php echo $img->id;?>" />
							</div>
							<?php
							echo '</div>';
						}
					?>
					<!-- File Upload - List -->
					<div class="files-list sortable-gallery">
						<div class="files-template files-template-thumb" data-id="<%=uid%>" title="<%-name%>, <%-sizeText%>">
							<div class="files-template-delete" data-fileapi="file.remove">
								<svg class="td-icon td-icon-cancel"><use xlink:href="#icon-cancel"></use></svg>
							</div>
							<div class="files-template-progress progress">
								<div class="files-template_progress-bar progress-bar"></div>
							</div>
							<div class="files-template-preview">
								<div class="files-template-preview_img"></div>
							</div>
						</div>
					</div>
					<!-- File Upload - Buttons -->
					<div class="files-buttons">
						<div class="files-buttons_browse">
							<label for="files-browse-gallery">
								<svg class="td-icon td-icon-my-library-add"><use xlink:href="#icon-my-library-add"></use></svg>
							</label>
							<input id="files-browse-gallery" type="file" name="filedata">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Section - #5 -->
	<div class="form-section">
		<h1 class="form-section_title">DOKÜMANLAR</h1>
		<div class="form-section_content">
			<div id="sortable-document-upload" action="<?php echo Yii::app()->createUrl("productmodel/fileupload"); ?>" method="POST" enctype="multipart/form-data">
				<!-- File Upload -->
				<div class="files-container extra-files">
					<?php
							$files = Mimages::model()->findAll(array('condition' => 'type = "file" AND mid = :mid','params'=>array(':mid'=>$model->id)));
							
							// get model image
							foreach ($files as $key => $file) {
								echo '<div class="old-files" data-id="'.$file->id.'" data-delete-url="'.Yii::app()->createUrl("productmodel/extraitemdelete").'"
								data-file="'.$file->path.'">';
							?>
							<div class="files-template-input">
								<label for="exfiledesc<?php echo $file->id;?>">#<?php echo $file->ordering;?> açıklaması</label>
								<input maxlength="255" name="Exfiledescs[exfiledesc<?php echo $file->id; ?>]" value="<?php echo $file->name; ?>" id="exfiledesc<?php echo $file->id;?>" type="text">
							</div>
							<?php
							echo '</div>';
							}
					?>
					<!-- File Upload - List -->
					<div class="files-list sortable-gallery">
						<div class="files-template files-template-thumb" data-id="<%=uid%>" title="<%-name%>, <%-sizeText%>">
							<div class="files-template-delete" data-fileapi="file.remove">
								<svg class="td-icon td-icon-cancel"><use xlink:href="#icon-cancel"></use></svg>
							</div>
							<div class="files-template-progress progress">
								<div class="files-template_progress-bar progress-bar"></div>
							</div>
							<div class="files-template-preview">
								<div class="files-template-preview_doc">
									<div class="files-template-preview_doc-name"><%-name%></div>
									<div class="files-template-preview_doc-size"><%-sizeText%></div>
								</div>
							</div>
						</div>
					</div>
					<!-- File Upload - Buttons -->
					<div class="files-buttons">
						<div class="files-buttons_browse">
							<label for="files-browse-document">
								<svg class="td-icon td-icon-my-library-add"><use xlink:href="#icon-my-library-add"></use></svg>
							</label>
							<input id="files-browse-document" type="file" name="filedata">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Section - #6 -->
	<div class="form-section">
		<h1 class="form-section_title">VİDEOLAR</h1>
		<div class="form-section_content">
			<div class="row">
				<div class="col-md-6">
					<label for="">Link</label>
				</div>
				<div class="col-md-6">
					<label for="">Başlık</label>
				</div>
			</div>
			<!-- Sortable -->
			<div id="sortable-video-link" class="sortable">
				<?php
					$videos = Mimages::model()->findAll(array('condition' => 'type = "video" AND mid = :mid','params'=>array(':mid'=>$model->id)));
						
						// get model image
						foreach ($videos as $key => $video) {
				?>
				<div class="form-group bordered old-video files-template">
					<div class="row">
						<div class="col-md-6">
							<input type="text" name="savedvideo[<?php echo $video->id; ?>]" class="form-control" value="<?php echo $video->path; ?>">
						</div>
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-9">
									<input type="text" name="savedvideodesc-<?php echo $video->id; ?>" class="form-control" value="<?php echo $video->name; ?>">
								</div>
								<div class="col-md-1">
									<div class="sortable-button sortable-button_drag">
										<svg class="td-icon td-icon-swap-vert"><use xlink:href="#icon-swap-vert"></use></svg>
									</div>
								</div>
								<div class="col-md-1">
									<div class="sortable-button delete-image" data-id="<?php echo $video->id; ?>" data-url="<?php echo Yii::app()->createUrl("productmodel/extraitemdelete"); ?>">
										<svg class="td-icon td-icon-cancel"><use xlink:href="#icon-cancel"></use></svg>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php
					}
			?>
			<!-- Template - Videos -->
			<script id="template-videos" type="text/x-handlebars-template">
			<div class="form-group bordered new-video">
						<div class="row">
									<div class="col-md-6">
												<input type="text" name="videos[]" class="form-control">
									</div>
									<div class="col-md-6">
												<div class="row">
															<div class="col-md-9">
																		<input type="text" name="exvideodesc{{key}}" class="form-control">
															</div>
															<div class="col-md-1">
																		<div class="sortable-button sortable-button_drag">
																					<svg class="td-icon td-icon-swap-vert"><use xlink:href="#icon-swap-vert"></use></svg>
																		</div>
															</div>
															<div class="col-md-1">
																		<div class="sortable-button sortable-button_remove">
																					<svg class="td-icon td-icon-cancel"><use xlink:href="#icon-cancel"></use></svg>
																		</div>
															</div>
												</div>
									</div>
						</div>
			</div>
			</script>
		</div>
		<div class="form-group bordered button">
			<button type="button" class="btn btn-default" data-template="videos">
			<svg class="td-icon td-icon-control-point-duplicate"><use xlink:href="#icon-control-point-duplicate"></use></svg>
			</button>
		</div>
	</div>
</div>