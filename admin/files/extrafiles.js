


$('.addextraimage').click(function() {
	clip = $('.fieldtypes thead');
	if (clip.children(".addimage").length > 0) {
		redclip = clip.children(".addimage").length +1;
	} else {
		redclip = 1;
	}
	redclick = clip.children(".extraimage").length+1;
	output = '<tr class="thisfield addimage extraimage even"><td id="selectedimage" class="selectedimage"></td><th><label for="floatimage'+redclip+'">Ekstra ürün fotoğrafı <em>- #'+redclick+'</em></label><input id="floatimage'+redclip+'" class="inputbox imagelist" multiple="multiple" name="images[]" type="file" /></th><td><label for="eximagedesc'+redclip+'">Eksta ürün fotoğrafı açıklaması</label><input class="span3" maxlength="255" name="eximagedesc'+redclip+'" id="eximagedesc'+redclip+'" type="text"></td><td><a href="javascript:;" class="btn btn-mini btn-danger deletefield">İptal</a></td></tr>';

	clip.append(output);
});



$('.addextradocument').click(function() {
	clip = $('.fieldtypes tbody');
	if (clip.children(".addfile").length > 0) {
		redclip = clip.children(".addfile").length +1;
	} else {
		redclip = 1;
	}
	output = '<tr class="thisfield addfile even"><th><label for="floatfile'+redclip+'">Ürün Dökümanı <em>- #'+redclip+'</em></label><input id="floatfile'+redclip+'" class="inputbox" name="files[]" type="file" /></th><td><label for="exfiledesc'+redclip+'">Döküman açıklaması</label><input class="span3" maxlength="255" name="exfiledesc'+redclip+'" id="exfiledesc'+redclip+'" type="text"></td><td><a href="javascript:;" class="btn btn-mini btn-danger deletefield">İptal</a></td></tr>';

	clip.append(output);
});

$('.addextravideo').click(function() {
	clip = $('.fieldtypes tfoot');
	if (clip.children(".addvideo").length > 0) {
		redclip = clip.children(".addvideo").length +1;
	} else {
		redclip = 1;
	}
	output = '<tr class="thisfield addvideo even"><th><label for="floatvideo'+redclip+'">Ürün Videosu <em>- #'+redclip+'</em></label><input id="floatvideo'+redclip+'" class="inputbox" name="videos[]" type="text" /></th><td><label for="exvideodesc'+redclip+'">Video açıklaması</label><input class="span3" maxlength="255" name="exvideodesc'+redclip+'" id="exvideodesc'+redclip+'" type="text"></td><td><a href="javascript:;" class="btn btn-mini btn-danger deletefield">İptal</a></td></tr>';

	clip.append(output);
});

$(".deletefield").live("click",function() {
	$(this).parents('.thisfield').fadeOut("slow",function() {
		$(this).parents('.thisfield').remove();
	});
});

$(".deletefield").click(function() {
	var r=confirm("Bu dosyayı silmek istediğini emin misiniz?");
	
	if (r==true) {
		link = $(this).attr('href');
		dataid = $(this).attr('rel');
		item = $(this).parents('.thisfield');
		$.ajax({
			'type':'GET',
			'url':link,
			'data':{'id':dataid},
			'cache':false,
			'success':function(html){
				item.fadeOut("slow",function() {
					item.remove();
				});
			}
		});
		return false;
	} else {
		return false;
	}
});