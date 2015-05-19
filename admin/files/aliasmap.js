$(".copyalias").submit(function(event){
  var id = $(this).attr('id');
  var getitem = id.split("-");
  slug(capitalize(getitem[0]));
  $(this).submit();
});

function slug(title) {
  var getslug = slugify($("#"+title+"_title").val());
  $("#"+title+"_slug").val(getslug);
  return true;
}

function capitalize(text) {
    return text.replace(/\b\w/g , function(m){ return m.toUpperCase(); } );
}

TURKCE_MAP = {
    "ÅŸ" : "s", "Ä±" : "i", "Ã¼" : "u", "ÄŸ" : "g", "Ã§" : "c", "ş" : "s", "ğ" : "g", "ı" : "i", "ü" : "u", "ö" : "o", "ç" : "c"
}

function slugify(text) {
    text = text.toLowerCase();
    for (var key in TURKCE_MAP) { text = text.replace(new RegExp(key, "g"), TURKCE_MAP[key]); }
    return text.replace(/\s+/g,"-").replace(/[^a-zA-Z0-9\-]/g,"");
}
$("#Product_title").attr("disabled","disabled").keyup(
    function(){
        cur_val = slugify($(this).val());
        $("#Product_slug").val(cur_val);
    }
).removeAttr("disabled");