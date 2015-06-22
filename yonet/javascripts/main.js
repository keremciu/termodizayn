$('document').ready(function(){

    // DataTable
    /*
    $('.dataTable').dataTable({
        //paginate: false,
        //scrollY: 20,
        //"pageLength": 1,
        //"order": [[ 2, "desc" ]],
        "ajax": 'js/plugin/datatables/test-ajax.txt',
        "dom": '<"dataTable-top"lf>rt<"dataTable-bottom"p>',
        "language": {
            "url": "js/plugin/datatables/lang/tr.json"
        }
    });
*/  

    $(document).on('click', '.sort-link', function(e){
        var target = $( e.target );
        target.parent().toggle();
    });

    $(".form-actions").appendTo(".site-nav .isActive .site-sub-nav").wrap('<li class="action-buttons"></li>').bind( "click", function() {
        form = $(this).find('button').attr('data-form');
        $("#"+form).submit();
    });

    $('.menu-tabs_item').on('shown.bs.tab', function (e) {
        $(this).siblings('.menu-tabs_item').removeClass("isActive");
        $(e.target).addClass("isActive");
    })
    
    // Product Page Gallery Upload
    $('#product-gallery-upload').fileapi({
        autoUpload: true,
        multiple: true,
        data: { type: "extras" },
        maxFiles: 5,
        accept: 'image/jpeg,image/png,image/jpg',
        elements: {
            ctrl: { upload: '.files-buttons_upload' },
            emptyQueue: { hide: '.files-buttons_upload' },
            list: '.files-list',
            progress: '.files-template-progress',
            file: {
                tpl: '.files-template',
                preview: {
                    el: '.files-template-preview',
                    width: 150,
                    height: 150
                },
                upload: { show: '.progress', hide: '.b-thumb__rotate' },
                complete: { hide: '.progress'},
                progress: '.progress-bar'
            }
        },
        onFileComplete: function (evt, ui) {
            console.log(evt);
            console.log(ui);
            var uploaded_img = ui.result.images.filedata.name;
            api = evt.widget.__fileId;
            $(this).find("[data-id="+api+"]").append('<input name="images[]" type="hidden" value="'+uploaded_img+'" />');
        }
    });

    // Product Page Image Upload
    $('#product-image-upload').fileapi({
        autoUpload: true,
        multiple: false,
        accept: 'image/jpeg,image/png,image/jpg',
        maxFiles: 1,
        elements: {
            ctrl: { upload: '.files-buttons_upload' },
            emptyQueue: { hide: '.files-buttons_upload', show: '.files-buttons_browse' },
            list: '.files-list',
            progress: '.files-template-progress',
            file: {
                tpl: '.files-template',
                preview: {
                    el: '.files-template-preview',
                    width: 140,
                    height: 140
                },
                complete: { hide: '.progress'},
                upload: { show: '.progress', hide: '.b-thumb__rotate' },
                progress: '.progress-bar'
            }
        },
        onSelect: function(evt, ui) {
            var input = $(this).attr('data-trigger-input');
            inputval = $("#"+input).val();
            maxfiles = evt.widget.options.maxFiles;

            if ((maxfiles < 2) && inputval.length) {
                alert("Bu alana sadece bir resim eklenebilir. Dilerseniz daha once eklenen fotografi silerek tekrar ekleme yapabilirsiniz.");
                return false;
            }
        },
        onFileComplete: function (evt, ui){
            var input = $(this).attr('data-trigger-input');
            var uploaded_img = ui.result.images.filedata.name;

            // set uploaded image name as input value
            $("#"+input).val(uploaded_img);
        }
    });

    // Proforma Invoice Page Logo Upload
    $('#proforma-company-logo').fileapi({
        url: 'ctrl-mini.php',
        multiple: true,
        maxFiles: 1,
        accept: 'image/jpeg,image/png,image/jpg',
        progress: '.files-template-progress',
        elements: {
            ctrl: { upload: '.files-buttons_upload' },
            emptyQueue: { hide: '.files-buttons_upload' },
            list: '.files-list-mini',
            file: {
                tpl: '.files-template',
                preview: {
                    el: '.files-template-preview',
                    width: 70,
                    height: 38
                }
            }
        }
    });

    // Product Document Upload
    $('#sortable-document-upload').fileapi({
        multiple: true,
        autoUpload: true,
        maxFiles: 5,
        accept: '.pdf',
        elements: {
            ctrl: { upload: '.files-buttons_upload' },
            emptyQueue: { hide: '.files-buttons_upload' },
            list: '.files-list',
            file: {
                tpl: '.files-template',
                preview: {
                    el: '.files-template-preview',
                    width: 150,
                    height: 150
                },
                upload: { show: '.progress', hide: '.b-thumb__rotate' },
                complete: { hide: '.progress'},
                progress: '.progress-bar'
            }
        },
        onSelect: function(evt, ui) {

        },
        onFileComplete: function (evt, ui){
            console.log(ui);
            var uploaded_doc = ui.result.images.filedata.name;
            api = evt.widget.__fileId;
            $(this).find("[data-id="+api+"]").append('<input name="files[]" type="hidden" value="'+uploaded_doc+'" />');
        }
    });

    $(".files-container.has-image").each(function(key, value){
        var el = $(this);
        var item = $(this).attr('data-img');
        var id = $(this).attr('data-id');
        var delete_url = $(this).attr('data-delete-url');
        var data_input = $(this).attr('data-input');

        FileAPI.Image(item).preview(140, 140).get(function (err, img){
            var element = '<div class="files-template files-template-thumb">';
            element += '<div class="files-template-delete delete-image" data-id="'+id+'" data-url="'+delete_url+'" data-input="'+ data_input +'"><svg class="td-icon td-icon-cancel"><use xlink:href="#icon-cancel"></use></svg></div>';
            element += '<div class="files-template-progress progress"><div class="files-template_progress-bar progress-bar"></div></div><div class="files-template-preview"><div id="get-main-photo" class="files-template-preview_img"></div></div></div>';

            el.prepend(element);
            $("#get-main-photo").append(img);
        });
    });

    $(".old-images").each(function(key, value){
        var el = $(this);
        var item = $(this).attr('data-img');
        var id = $(this).attr('data-id');
        var delete_url = $(this).attr('data-delete-url');
        var container = $(".extra-images .files-list");

        FileAPI.Image(item).preview(140, 140).get(function (err, img){
            var element = '<div class="files-template files-template-thumb">';
            element += '<div class="files-template-delete delete-image" data-id="'+id+'" data-url="'+delete_url+'"><svg class="td-icon td-icon-cancel"><use xlink:href="#icon-cancel"></use></svg></div>';
            element += '<div class="files-template-progress progress"><div class="files-template_progress-bar progress-bar"></div></div>';
            element += '<div class="files-template-preview"><div id="get-main-photo'+key+'" class="files-template-preview_img"></div></div></div>';

            container.prepend(element);
            $("#get-main-photo"+key).append(img);
        });
    });

    $(".old-files").each(function(key, value){
        var el = $(this);
        var item = $(this).attr('data-file');
        var id = $(this).attr('data-id');
        var delete_url = $(this).attr('data-delete-url');
        var container = $(".extra-files .files-list");

            var element = '<div class="files-template files-template-thumb">';
            element += '<div class="files-template-delete delete-image" data-id="'+id+'" data-url="'+delete_url+'"><svg class="td-icon td-icon-cancel"><use xlink:href="#icon-cancel"></use></svg></div>';
            element += '<div class="files-template-progress progress"><div class="files-template_progress-bar progress-bar"></div></div>';
            element += '<div class="files-template-preview"><div id="get-main-file'+key+'" class="files-template-preview_doc"><div class="files-template-preview_doc-name">'+item+'</div><div class="files-template-preview_doc-size">99.02 KB</div></div></div></div>';

            container.prepend(element);
    });

    $(document).on('click', '.delete-image', function(e){
        var r=confirm("Bu ürün icerigini silmek istediğini emin misiniz?");
        
        if (r==true) {
            link = $(this).attr('data-url');
            id = $(this).attr('data-id');
            input = $(this).attr('data-input');
            parent = $(this).parents('.files-template');
            $.ajax({
                'type':'GET',
                'url':link,
                'data':{'id':id},
                'cache':false,
                'success':function(html){
                    $("#"+input).val("");
                    parent.fadeOut("slow",function() {
                        parent.remove();
                    });
                }
            });
            return false;
        } else {
            return false;
        }
    });

    /*
    function readURL(input) {
        var file = input.files[0];
        var fr = new FileReader();
        fr.onload = createImage;   // onload fires after reading is complete
        fr.readAsDataURL(file);

        function createImage() {
            img = new Image();
            img.onload = imageLoaded;
            img.src = fr.result;
        }

        function imageLoaded() {
            var canvas = document.getElementById("main-photo-preview");
            var ctx = canvas.getContext("2d");
            ctx.drawImage(img, 0, 0);

            var MAX_WIDTH = 140;
            var MAX_HEIGHT = 140;
            var width = img.width;
            var height = img.height;

            if (width > height) {
              if (width > MAX_WIDTH) {
                height *= MAX_WIDTH / width;
                width = MAX_WIDTH;
              }
            } else {
              if (height > MAX_HEIGHT) {
                width *= MAX_HEIGHT / height;
                height = MAX_HEIGHT;
              }
            }
            canvas.width = width;
            canvas.height = height;
            var ctx = canvas.getContext("2d");
            ctx.drawImage(img, 0, 0, width, height);

            //alert(canvas.toDataURL("image/png"));
            $('.files-buttons_browse').hide();
            $('#product-image-upload .files-template').show();
        }
    }
    */

    // var choose = document.getElementById('files-browse');
    //     FileAPI.event.on(choose, 'change', function (evt){
    //         var files = FileAPI.getFiles(evt); // Retrieve file list
    //         var thumbnails = document.getElementById('files-template-preview');
    //         var url = thumbnails.getAttribute("data-url");
    //         FileAPI.filterFiles(files, function (file, info/**Object*/){
    //             if( /^image/.test(file.type) ){
    //                 return  info.width >= 140 && info.height >= 140;
    //             }
    //             return  false;
    //         }, function (files/**Array*/, rejected/**Array*/){
    //             if( files.length ){
    //                 $('.files-buttons_browse').hide();
    //                 $('#product-image-upload .files-template').show();
    //                 // Make preview 140x140
    //                 FileAPI.each(files, function (file){
    //                     FileAPI.Image(file).preview(140).get(function (err, img){
    //                         thumbnails.appendChild(img);
    //                     });
    //                 });

    //                 // Uploading Files
    //                 FileAPI.upload({
    //                     url: url,
    //                     files: { images: files },
    //                     progress: function (evt){ /* ... */ },
    //                     complete: function (err, xhr){ /* ... */ }
    //                 });
    //             }
    //         });
    //     });

    /*
    $(".form-section").on('change','.main-photo' , function(){ 
        readURL(this);
    });
    */


    // //var el = $('.main-photo');
    // var choose = document.getElementById('files-browse');
    //     FileAPI.event.on(choose, 'change', function (evt){
    //         var files = FileAPI.getFiles(evt); // Retrieve file list
    //         var thumbnails = document.getElementById('main-photo-preview');

    //         FileAPI.filterFiles(files, function (file, info/**Object*/){
    //             if( /^image/.test(file.type) ){
    //                 return  info.width >= 320 && info.height >= 240;
    //             }
    //             return  false;
    //         }, function (files/**Array*/, rejected/**Array*/){
    //             if( files.length ){
    //                 // Make preview 100x100
    //                 FileAPI.each(files, function (file){
    //                     FileAPI.Image(file).preview(140).get(function (err, img){
    //                         <div class="files-template files-template-thumb" data-fileapi-id=
    // "fileapi14346828543762" data-id="fileapi14346828543762" title=
    // "apple-touch-startup-image.png, 682.74 KB">
    //     <div class="files-template-delete" data-fileapi="file.remove"></div>

    //     <div class="files-template-progress progress">
    //         <div class="files-template_progress-bar progress-bar"></div>
    //     </div>

    //     <div class="files-template-preview">
    //         <canvas height="140" width="140"></canvas>
    //     </div>
    // </div>
    //                        thumbnails.appendChild(img);
    //                     });
    //                 });
    //             }
    //         });

    //     });
    // */

    // Sticky
    $("[data-sticky_column]").stick_in_parent({
        sticky_class: "isSticky",
        offset_top: 90,
        parent: "[data-sticky_parent]"
    }).on("sticky_kit:stick", function(e) {
        $(e.target).css({
            marginLeft: $(".invoice-section").width() + 25
        });
    });

    // Sub Nav Hover
    $('.site-sub-nav').hover(function(){
        var getNavHeight = $('.site-nav').height();
        $('.site-nav').css("height", getNavHeight);
    }, function(){
        $('.site-nav').css("height", "");
    });

    // FastClick
    FastClick.attach(document.body);

    // Attribute Select Change
    $('.sortable').on('change', '.attrib-select', function(e) {
        prefix = $("option:selected", this).attr('data-prefix');
        getitem = $(this).parents(".aspecification").find(".aspecification-value");
        if (prefix.length > 1) {
            if (getitem.parent().hasClass("input-group")) {
                getitem.siblings(".input-group-addon").html(prefix);
            } else {
                getitem.wrap('<div class="input-group"></div>').after('<span class="input-group-addon">'+prefix+'</span>');    
            }
        } else {
            if (getitem.parent().hasClass("input-group")) {
                getitem.unwrap().siblings(".input-group-addon").remove();
            }
        }
    });

    $('.sortable').on('click', '.savedattrdelete a', function(e) {
        var r=confirm("Bu ürün özelliğini silmek istediğini emin misiniz?");
        
        if (r==true) {
            link = $(this).attr('href');
            dataid = $(this).attr('rel');
            parent = $(this).parents('.aspecification');
            $.ajax({
                'type':'GET',
                'url':link,
                'data':{'id':dataid},
                'cache':false,
                'success':function(html){
                    parent.fadeOut("slow",function() {
                        parent.remove();
                    });
                }
            });
            return false;
        } else {
            return false;
        }
    });

    // Sortable List
    $(".sortable").sortable({
        handle: '.sortable-button_drag',
        animation: 150,
        ghostClass: "sortable-ghost-item",
        onSort: function (/**Event*/evt) {
            //console.log(evt);
            var itemEl = $(evt.item);
            //console.log(evt.from);

            if (evt.oldIndex > evt.newIndex) {
                itemEl.find(".aspecification-order").val(evt.newIndex--);
            } else {
                itemEl.find(".aspecification-order").val(evt.newIndex++);
            }
        },
    });

    // Sortable Gallery
    $(".sortable-gallery").sortable({
        handle: '.files-template-thumb',
        animation: 150,
        ghostClass: "sortable-ghost-item"
    });

    // Remove Sortable Row
    $('.sortable').on('click', '.sortable-button_remove', function(){
        $(this).parents('.form-group').remove();
    });

    // Window Scroll
    $(window).scroll(function(){

        // Selectors
        var windowScrollTop    = $(window).scrollTop(),
            stickyNavTopHeight = $('.site-sub-nav').offset().top;

        // Fixed Navigation
        if(windowScrollTop >= stickyNavTopHeight){
            $("[data-sticky-nav]").addClass('navSticky');
        }else {
            $("[data-sticky-nav]").removeClass('navSticky');
        }

    });

    // Proforma Invoice Page
    // Whom Form Click Action
    $('#add-company-button').on('click', function(){
        $('#popup-company-add').fadeIn(200);
        $('#whom-form-popup input:first').focus();
    });

    $('#cancel-company-button').on('click', function(){
        $('#popup-company-add').fadeOut(200);
    });

    $('#save-company-button').on('click', function(){
        $('#whom-form input, #whom-form textarea, #whom-form-popup input, #whom-form-popup textarea').val('');
        $('.files-template-delete').trigger('click');
        $('#cancel-company-button').trigger('click');
    });

    // Add Specifications
    $('button').on('click', function(){

        // Get Data Attribute
        var buttonDataAttr = $(this).data('template');

        // Templates Varaibles
        var videoContainer          = $("#sortable-video-link"),
            templateVideos          = $("#template-videos").html(),
            specsContainer          = $("#sortable-tecnical-info"),
            templateSpecifications  = $("#template-specifications").html(),
            templateInvoiceTable    = $("#template-table").html();

        // Handlebars
        if (buttonDataAttr == "videos"){
            if (videoContainer.find(".new-video").length > 0) {
                count = videoContainer.find(".new-video").length +1;
            } else {
                count = 1;
            }
            template = Handlebars.compile(templateVideos);
            videoContainer.append(template({key:count}));
        } else if (buttonDataAttr == "specifications") {
            if (specsContainer.find(".new-specification").length > 0) {
                count = specsContainer.find(".new-specification").length +1;
            } else {
                count = 1;
            }
            template = Handlebars.compile(templateSpecifications);
            specsContainer.append(template({key:count}));
        } //else if (buttonDataAttr == "invoice-table") {

        //    var invoiceTableTemplate        = Handlebars.compile(templateInvoiceTable),
        //        invoiceTableGetProductName  = $("[name='select-invoice-product-name'] option:selected").text(),
        //        invoiceTableGetModelName    = $("[name='select-invoice-model-name'] option:selected").text();
        //
        //    $('.product-table tbody').append(invoiceTableTemplate({
        //        productName: invoiceTableGetProductName,
        //        productModel: invoiceTableGetModelName
        //    }));
        //}

    });

    // Select2
    $('#select2').select2({
        placeholder: 'Bir firma seçin'
    });
    // Select2 Add Custom Class
    $('.select2-selection').addClass('form-control select2-custom');

    // Masked Inputs
    //$("#filter-textbox").mask("9999", {placeholder:""});
    //$("#user-gsm").mask("9999 999 99 99", {placeholder:""});

});

$(document).on('click', 'a[href=""], a[href^="#"]', function (e) {
    e.preventDefault();
});