$(document).ready(function(){
   $('#side-menu').find('li.has-elements').children('a').click(function(e){
       e.preventDefault();
       $(this).parent('li.has-elements').children('ul').toggle(300);
   }); 
    $('#menu-button').click(function(){
       $('#side-menu').addClass('show');
        $(this).children('img').toggleClass('rotateZ45');
    });
    ///////
    $('#instant-medias-chose-and-upload').find('.close').click(function(){
        hideFixedItems('#instant-medias-chose-and-upload');
    });
    $('#side-menu').find('.close').click(function(){
        hideFixedItems('#side-menu');
    });
    $('#medias-item-detalis').find('.close').click(function(){
        hideFixedItems('#medias-item-detalis');
    });
    ////////////
    // Initialise DataTable
    $('table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            { extend: 'copy', text: 'Copie' },
            { extend: 'excel', text: 'Exporter en tant que fichier Excel' },
            { extend: 'csv', text: 'Exporter en tant que fichier CSV' },
            { extend: 'pdf', text: 'Enregistrer en tant que fichier Pdf' },
            { extend: 'print', text: 'Imprimer' }
        ],
        "language": {
            "sProcessing": "Traitement en cours...",
            "sSearch": "Rechercher&nbsp;:",
            "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
            "sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
            "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
            "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
            "sInfoPostFix": "",
            "sLoadingRecords": "Chargement en cours...",
            "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
            "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
            "oPaginate": {
                "sFirst": "Premier",
                "sPrevious": "Pr&eacute;c&eacute;dent",
                "sNext": "Suivant",
                "sLast": "Dernier"
            },
            "oAria": {
                "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
            },
            "select": {
                "rows": {
                    "_": "%d lignes sélectionnées",
                    "0": "Aucune ligne sélectionnée",
                    "1": "1 ligne sélectionnée"
                }
            }
        }
    });
    ////////////
    $('.media-thumbnail').click(function(){
       $(this).toggleClass('selected'); 
    });
    $('.media-grid-thumbnail').click(function(){
        $(this).toggleClass('selected'); 
     });
     $('.media-grid-thumbnail').dblclick(function(){
         let id = $(this).children('img').attr('data-id');
         let name = $(this).children('img').attr('title');
         let type = $(this).children('img').attr('type');
         let time = $(this).children('img').attr('data-time');
         let alt = $(this).children('img').attr('alt');
         let title = $(this).children('img').attr('title');
         let description = $(this).children('img').attr('description');
         let link = $(this).children('img').attr('src');
         let size = (getFileSize(link))/1000;
         let dimensions = '';
            $('#medias-item-detalis').find('#item-id').val(id);
            $('#medias-item-detalis').find('#item-name').text(name);
            $('#medias-item-detalis').find('#item-type').text(type);
            $('#medias-item-detalis').find('#item-time').text(time);
            $('#medias-item-detalis').find('#item-alt').val(alt);
            $('#medias-item-detalis').find('#item-title').text(title);
            $('#medias-item-detalis').find('#item-title-2').val(title);
            $('#medias-item-detalis').find('#item-description').val(description);
            $('#medias-item-detalis').find('#item-image').attr('src',link);
            $('#medias-item-detalis').find('#item-link').val(link);
            $('#medias-item-detalis').find('#item-size').text(size);
            $('#medias-item-detalis').find('#item-dimensions').text(dimensions);

        $(this).addClass('selected'); 

        $('#medias-item-detalis').fadeIn('slow');
        $('#global-fixed-overlay').fadeIn('slow');
     });
    /////////////
    $('#show-upload-form').click(function(){
       $('#upload-file').slideDown();
    });
    $('#upload-file').find('.close').click(function(){
       $(this).parents('#upload-file').slideUp();
    });
    ////////////
    $('#fixed-order-detalis').find('.close').click(function(){
        hideFixedItems('#fixed-order-detalis');
    });
    // Show order details
    $('.show-order-details').click(function(){
        let orderId = $(this).attr('data-id');
        $.get({
            url:'/admin/commandes/details/'+orderId,
            success:function(res){
                let data = JSON.parse(res);
                $('#fixed-order-code').text(data['code']);
                if(data['state'] == '0'){
                    $('#fixed-order-detalis').find('.notDon').show();
                }else{
                    $('#fixed-order-detalis').find('.done').show();
                }
                $('#fixed-order-name').text(data['first_name']+' '+data['laqst_name']);
                $('#fixed-order-adess').text(data['adress']);
                $('#fixed-order-city').text(data['city']);
                $('#fixed-order-phone').text(data['phone']);
                let products = '';
                $.each(data['carts'], function( i, value ) {
                    console.log(value);
                    products += '<tr>';
                        products += '<td>'+value['product']['name']+'</td>';
                        products += '<td>'+value['quantity']+'</td>';
                        /*products += '<td>120Dh</td>';
                        products += '<td>120Dh</td>';*/
                        products += '<td style="color: var(--color-blue);">'+value['total_price']+' Dh</td>';
                    products += '</tr>';
                  });
                $('#fixed-order-products').html(products);
                $('#fixed-order-link').attr('href','/admin/commandes/modifier/'+data['id']);
            }
        })
        showFixedItems('#fixed-order-detalis');
    });

    // Upload medias file
    $('.uploadMedias').find('.fileSelect').click(function(){
        $(this).parents('.uploadMedias').find('.filesInput').click();
    });
    $('.uploadMedias').find('.filesInput').change(function(){
        $('.uploadMedias').submit();
    });

    // ajax media fixed upload
    
    $('#fixed-instent-uploademedia').submit(function(e){
        e.preventDefault();
        var form = $(this)[0]; // You need to use standard javascript object here
        var formData = new FormData(form);

        $.ajax({
            url: '/admin/medias/ajouter-ajax',
            data: formData,
            type: 'POST',
            contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
            processData: false, // NEEDED, DON'T OMIT THIS
            // ... Other options like success and etc
            success : function(res){
                console.log(res);
                chosefileFromMedia();
                $('#tab-1').removeClass('active');
                $('#tab-2').addClass('active');
                $('a[href="#tab-1"]').removeClass('active');
                $('a[href="#tab-2"]').addClass('active');
            }
        });
    });
    // Change order state
    $('#order-state').change(function(){
        let state = $(this).val();
        let orderId = $('#order-id').val();
        window.location.href = '/admin/commandes/modifier-etat/'+state+'/'+orderId;
    });

    // Init Summernot text editor 
    $(document).ready(function() {
        $('.summernote').summernote({
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']],
              ],
              spellCheck: true
        });
    });
    
    // add tag to list
    $('#tag-add-btn').click(function(){
        let tag = $('#tag-input').val();
        tag = tag.trim();
        tag = tag.trim(',');
        let tags = $('#tags').val();
        if(tag == ''){return false;}
        let tagHolder = $('#tags-holder').html();
        console.log(tagHolder);
        if(tagHolder == ''){
            $('#tags').val(tags+tag);
            $('#tags-holder').html(tagHolder+'<a ondblclick="removeThisTag(this)" data-tag="'+tag+'" data-toggle="tooltip" data-placement="top" title="Double click pour supprimer" style="color:var(--color-blue);cursor:pointer;">'+tag+'</a>');
        }else{
            $('#tags').val(tags+', '+tag);
            $('#tags-holder').html(tagHolder+'<a ondblclick="removeThisTag(this)" data-tag=", '+tag+'" data-toggle="tooltip" data-placement="top" title="Double click pour supprimer" style="color:var(--color-blue);cursor:pointer;"><span style="color:black">, </span>'+tag+'</a>');
        }
        $('#tag-input').val('');
        
    });

    $('.thumbnail-input-holder').parent('div').find('.close').click(function(e){
        e.stopPropagation();
        e.stopImmediatePropagation();
        let img  = $(this).parent('div');
        img.find('input[type="text"]').val('');
        img.find('img').attr('src','/assets/admin/img/thumbnail.jpg');
    });
    // run media selector
    $('.thumbnail-input-holder').click(function(e){
        e.stopPropagation();
        e.stopImmediatePropagation();
        img  = $(this);
        let id = '';
        let file = '';
        $.get({
            url:'/admin/medias/getjson',
            success : function(res){
                let data = JSON.parse(res);
                let mediaList = '';
                let absStorageUrl = $('meta[name="site-storage-url"]').attr('content');
                $.each(data, function( i, value ) {
                    mediaList += '<li class="list-inline-item">';
                    mediaList += '<div class="media-grid-thumbnail"><img title="'+value['name']+'" alt="'+value['alt_title']+'" description="'+value['file_desc']+'" data-type="'+value['type']+'" data-id="'+value['id']+'" data-time="'+value['created_at']+'"  class="img-fluid" src="'+absStorageUrl+'/'+value['file']+'" ></div>';
                    mediaList += '</li>';
                });
                $('#instant-medias-chose-and-upload').fadeIn();
                $('#global-fixed-overlay').fadeIn();
                $('.medias-list').html(mediaList);
                $('.media-grid-thumbnail').click(function(){
                    $('.media-grid-thumbnail').removeClass('selected'); 
                    $(this).toggleClass('selected'); 
                    $('#media-grid-selected-item-id').val($(this).children('img').attr('data-id'));
                    $('#media-grid-selected-item-file').val($(this).children('img').attr('src'));
                });
                $(".chose-selected-media").click(function(){
                    console.log(img);
                    id = $('#media-grid-selected-item-id').val(); 
                    file = $('#media-grid-selected-item-file').val(); 
                    $('#instant-medias-chose-and-upload').fadeOut();
                    $('#global-fixed-overlay').fadeOut();
                    img.find('input[type="text"]').val(id);
                    img.find('img').attr('src',file);
                    return false;
                });
            }
        });
    });

    // sub_title for url manager
    $('input[name="title"]').keyup(function(){
        let data = $(this).val();
        data = data.split(' ').join('-');
        data = data.toLowerCase();
       // data = encodeURI(data);
        $('input[name="sub_title"]').val(data);
    });

    $.get({
        url:'https://api.webiframe.com/cod-admin/ads/',
        success : function (res){
            $('.advertissment').find('.advertissment-place').html(res);
            $('.advertissment').show();
        }
    })
    $('.append-new-city-field').click(function(){
        let cityField  = '<div class="form-row" ><div class="col-md-4"><div class="form-group"><label style="line-height: 22px;font-size: 16px;">Titre:</label><input class="form-control" onkeyup="getnerateSlugname(this)" name="title[] "type="text"><input type="hidden" name="id[]"  hidden /></div></div><div class="col-md-4"><div class="form-group"><label style="line-height: 22px;font-size: 16px;">Slug name:</label><input class="form-control" name="sub_title[]"  type="text" /></div></div><div class="col-md-4"><div class="form-group" style="position:relative;"><button onclick="removeThisRow(this)" class="btn btn-primary close" type="button" style="top: 0;right: 0;position: absolute;color: var(--red);background: none;box-shadow: none;"><i class="fa fa-close"></i></button><label style="line-height: 22px;font-size: 16px;">shipping cost:</label><input class="form-control" name="shipping_cost[]"type="text"></div></div></div>';
        $('.city-container').append(cityField);
    });
    
    // init datetime
    $('.form_datetime').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
    });
});